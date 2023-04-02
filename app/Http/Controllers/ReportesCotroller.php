<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Models\Supplier;
use App\Exports\Inventory;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportesCotroller extends Controller
{
    public function index()
    {
       // dd($this->topTenByType());
        $totalVentas = Sale::where('status', 'proccesed')->count();
        $totalProductos = Product::where('status', true)->count();
        $totalCliente = Client::count();
        $totalProveedores = Supplier::count();

        $totalVendido = Sale::where('status', 'proccesed')->get()->sum('total');
        $topClients = Client::withSum('sales', 'total')
        ->whereHas('sales')
        ->orderByDesc('sales_sum_total')
        ->take(10)
        ->get();

        $topProducts = Product::withCount(['saleItems as ventas_count' => function($query) {
            $query->select(DB::raw('sum(quantity_total)'))
            ->whereHas('sale', function($q) {
                $q->where('status', 'proccesed');
            });;
        }])
        ->whereHas('saleItems', function($q) {
            $q->whereHas('sale', function($q) {
                $q->where('status', 'proccesed');
            });
        })
        ->orderByDesc('ventas_count')
        ->take(10)
        ->get();

        //dd($topProducts);

        return view('modules.reportes.index',[
            'total_ventas' => $totalVentas,
            'total_productos' => $totalProductos,
            'total_clientes' => $totalCliente,
            'total_proveedores' => $totalProveedores,
            'total_vendido' => $totalVendido,
            'top_clientes' => $topClients,
            'top_productos' => $topProducts,
        ]);
    }

    public function export()
    {
        $data = collect([
            'title' => 'hello'
        ]);
        return Excel::download(new Inventory($data), 'Inventario.xlsx');
    }

    private function getTopTenSold()
    {
        $top_products = SaleProduct::select('product_id',
                      DB::raw('SUM(quantity_total) as total_quantity'),
                      DB::raw('SUM(total) as total_sales'))
                 ->groupBy('product_id')
                 ->orderByDesc('total_quantity')
                 ->take(10)
                 ->get();

            $results = [];

            foreach ($top_products as $product) {
                $p = Product::find($product->product_id);
                $cost = $p->cost * $product->total_quantity;
                $margin = $product->total_sales - $cost;
                $results[] = [
                    'type' => $p->type->name,
                    'code' => $p->code,
                    'description' => $p->description,
                    'unit_sold' => $product->total_quantity,
                    'sales_amount' => $product->total_sales,
                    'cost_amount' => $cost,
                    'margin' => $margin
                ];
            }


            return $results;
    }

    private function getTopTenSoldMargin()
    {
        $top_products = SaleProduct::select('product_id',
                      DB::raw('SUM(quantity_total) as total_quantity'),
                      DB::raw('SUM(total) as total_sales'))
                 ->groupBy('product_id')
                 ->orderByDesc('total_quantity')
                 ->get();

            $results = [];

            foreach ($top_products as $product) {
                $p = Product::find($product->product_id);
                $cost = $p->cost * $product->total_quantity;
                $margin = $product->total_sales - $cost;
                $results[] = [
                    'type' => $p->type->name,
                    'code' => $p->code,
                    'description' => $p->description,
                    'unit_sold' => $product->total_quantity,
                    'sales_amount' => $product->total_sales,
                    'cost_amount' => $cost,
                    'margin' => $margin
                ];
            }

        return collect($results)->sortByDesc('margin')->take(10)->values()->toArray();
    }

    private function topTenByType()
    {
        $topProductsByType = SaleProduct::select('product_id', 'type_id')
            ->with(['product' => function ($query) {
                $query->select('id', 'code', 'description', 'cost');
            }])
            ->groupBy('type_id', 'product_id')
            ->withCount('product')
            ->orderByDesc('product_count')
            ->take(10)
            ->get()
            ->groupBy('type_id');


            return $topProductsByType;
    }
}
