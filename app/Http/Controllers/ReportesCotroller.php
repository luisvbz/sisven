<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Models\Supplier;
use App\Exports\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportesCotroller extends Controller
{
    public function index()
    {
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
}
