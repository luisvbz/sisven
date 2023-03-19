<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportesCotroller extends Controller
{
    public function index()
    {
        $totalVentas = Sale::where('status', 'proccesed')->count();
        $totalProductos = Product::where('status', true)->count();
        $totalCliente = Client::count();
        $totalProveedores = Supplier::count();

        $totalVendido = Sale::where('status', 'proccesed')->get()->sum('total');

        return view('modules.reportes.index',[
            'total_ventas' => $totalVentas,
            'total_productos' => $totalVentas,
            'total_clientes' => $totalCliente,
            'total_proveedores' => $totalProveedores,
            'total_vendido' => $totalVendido
        ]);
    }
}
