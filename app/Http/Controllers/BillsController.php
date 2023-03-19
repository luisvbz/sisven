<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Tables\Bills;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreBillRequest;
use Illuminate\Support\Facades\Storage;

class BillsController extends Controller
{
    public function new()
    {
        $docs = [
            'FACT' => 'Factura',
            'BOL' => 'Boleta',
            'NDC' => 'Nota de Crédito',
            'NDD' => 'Nota de D¿ebito',
        ];

        return view('modules.bills.new', [
            'types' => SaleType::all(),
            'docs' => $docs
        ]);
    }

    public function index()
    {
        $bills = Bills::class;
        return view('modules.bills.index', ['bills' => $bills]);
    }

    public function store(StoreBillRequest $request)
    {

        try{

            DB::beginTransaction();
            $bill = Bill::create([
                'client_id' => $request->client_id,
                'type' => $request->document_type,
                'serie' => strtoupper($request->serie),
                'number' => $request->number,
                'currency' => 'S',
                'igv_percent' => 18.00,
                'total_grabada' => $request->total_gravada,
                'total_inafecta' => $request->total_inafecta,
                'total_exonerada' => 0,
                'total_igv' => $request->total_igv,
                'total' => $request->total,
                'observations' => $request->observations ?? '',
                'emition_date' => $request->emition_date,
            ]);


            foreach($request->products as $producto)
            {
                $bill->items()->create([
                    'product_id' => $producto['product_id'],
                    'quantity' => $producto['cant'],
                    'measure' => $producto['measure'],
                    'unit_price' => $producto['unit_price'],
                    'discount' => 0,
                    'total' => $producto['total_price'],
                ]);
            }

            if($request->has('file'))
            {
                $file = $request->file('file');
                $name = "{$bill->serie}-{$bill->number}".".".$file->getClientOriginalExtension();
                $file->storeAs("public/bills/", $name);

                if(Storage::exists("public/bills/".$name))
                {
                    $bill->addMedia(storage_path("app/public/bills/".$name))->toMediaCollection('bills');
                }
            }

            DB::commit();

            Toast::title('Exito!')
            ->center('El documento se ha registrado con éxito')
            ->success()
            ->backdrop()
            ->autoDismiss(15);

            return redirect()->route('de.index');

        } catch (QueryException $e) {
            DB::rollback();
            dd($e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage().$e->getLine());
        }
    }



    public function getClients(Request $request)
    {
        $query = $request->get('query');
        if($query == '') return;
        $clients = Client::where('document_number','like', "%{$query}%")
                            ->orWhere('name','like', "%{$query}%")
                            ->get();

        return response()->json(['clients' => $clients]);
    }


    public function getProducts(Request $request)
    {
        $query = $request->get('query');
        $products = Product::get()
            ->transform(function($product) {
                $item = [];
                $item['id'] = $product->id;
                $item['full_name'] = "($product->code) - {$product->type->name} {$product->description} ";
                $item['measure'] = $product->measure->name;
                $item['price'] = $product->price;
                return $item;
            });

        $products = $products->filter(function($item) use ($query) {
            return strpos($item['full_name'], strtoupper($query)) !== false;
        })->values();

        return response()->json(['products' => $products]);
    }
}
