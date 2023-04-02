<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Models\Supplier;
use App\Exports\Inventory;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

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

    public function exportGeneral()
    {
        $document = new Spreadsheet();
        $start = 7;

        $document->getProperties()
            ->setCreator("FENASIS 1.0")
            ->setTitle('Reporte General')
            ->setCategory('Reportes');

            $image = new Drawing();
            $image->setName('logo');
            $image->setDescription('logo_marlenys');
            $image->setPath(public_path('images/logo.png'));
            $image->setOffsetX(10);
            $image->setHeight(30);
            $image->setWidth(150);
            $image->setCoordinates('A2');
            $image->setWorksheet($document->getActiveSheet());


            $sheet = $document->getActiveSheet();

            //Titulo del reporte
            $sheet->setCellValue('D1', 'REPORTE GENERAL');
            $sheet->getStyle('D1')->getFont()->setSize(13.0)->setBold(true);

            //Nombre de la persona que lo ha generado
            $user = auth()->user()->name;
            $sheet->setCellValue('D2', "Generado por: $user");
            //Criterios de Busqueda
            // $sheet->setCellValue('C2', strlen($criterios) != 0 ? "Criterios de busqueda: $criterios" : 'Criterios de busqueda: Ninguno');
            //Fecha y hora en que fue generado
            $sheet->setCellValue('D3', date('d/m/Y  - h:i:s a'));


            //Agregan el top ten de mas vendidos




            $styleBody = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000'),
                    ),
                ),
            );

            $colorHeader = new Color('E3E3E3');

            $styleHeaderCells = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000'),
                    ),
                ),
                'fill' => array(
                    'type' => Fill::FILL_SOLID,
                    'color' => array('argb' => 'DEDEDE')
                )
            );

            $styleBodyCells = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('rgb' => '000000'),
                    ),
                )
            );

            $getTopTenSold = $this->getTopTenSold();

            $headerTopTen  = ['TOP','TIPO DE PRODUCTO', 'CODIGO', 'DESCRIPCIÓN', 'UNIDADES/PARES VENIDAS', 'MONTO DE VENTAS','COSTO','MARGEN'];
            $sheet->fromArray([$headerTopTen], NULL, "A{$start}");
            $sheet->getStyle("A$start:H$start")->getAlignment()->setHorizontal('center');
            //aplicar estilos a la cabecera
            $sheet->getStyle("A$start:H$start")->applyFromArray($styleHeaderCells);

            $i = 1;
            $aux = $start + 1;
            $sheet->mergeCells('A6:H6');
            $sheet->setCellValue('A6', 'Top 10 de productos mas vendidos.');
            foreach ($getTopTenSold as $top) {
                // $fecha_afilicacion = \DateTime::createFromFormat('Y-m-d', $value->fecha_afiliacion);
                $sheet->setCellValue("A$aux", $i);
                $sheet->setCellValue("B$aux", $top['type']);
                $sheet->setCellValue("C$aux", $top['code']);
                $sheet->setCellValue("D$aux", $top['description']);
                $sheet->setCellValue("E$aux", $top['unit_sold']);
                $sheet->setCellValue("F$aux", $top['sales_amount']);
                $sheet->setCellValue("G$aux", $top['cost_amount']);
                $sheet->setCellValue("H$aux", $top['margin']);

                //aplicando estilos al body
                $sheet->getStyle("A$aux:h$aux")->applyFromArray($styleBody);

                //Alineando las columnas
                //Tipo Documento
                $sheet->getStyle("B$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("C$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("D$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("E$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("F$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("G$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("H$aux")->getAlignment()->setHorizontal('center');
                ++$aux;
                ++$i;
                $start++;
            }
            //2DO REPORTE
            $headerTopTenMargin  = ['TOP','TIPO DE PRODUCTO', 'CODIGO', 'DESCRIPCIÓN', 'UNIDADES/PARES VENIDAS', 'MONTO DE VENTAS','COSTO','MARGEN'];
            $start = $start + 3;
            $sheet->fromArray([$headerTopTenMargin], NULL, "A{$start}");
            $sheet->getStyle("A$start:H$start")->getAlignment()->setHorizontal('center');
            //aplicar estilos a la cabecera
            $sheet->getStyle("A$start:H$start")->applyFromArray($styleHeaderCells);
            $i = 1;
            $aux = $start + 1;
            $title = $start - 1;
            $sheet->mergeCells("A$title:H$title");
            $sheet->setCellValue("A$title", 'Top 10 productos vendiso con mayor margen.');
            $getTopTenMargin = $this->getTopTenSoldMargin();
            foreach ($getTopTenMargin as $top) {
                // $fecha_afilicacion = \DateTime::createFromFormat('Y-m-d', $value->fecha_afiliacion);
                $sheet->setCellValue("A$aux", $i);
                $sheet->setCellValue("B$aux", $top['type']);
                $sheet->setCellValue("C$aux", $top['code']);
                $sheet->setCellValue("D$aux", $top['description']);
                $sheet->setCellValue("E$aux", $top['unit_sold']);
                $sheet->setCellValue("F$aux", $top['sales_amount']);
                $sheet->setCellValue("G$aux", $top['cost_amount']);
                $sheet->setCellValue("H$aux", $top['margin']);

                //aplicando estilos al body
                $sheet->getStyle("A$aux:h$aux")->applyFromArray($styleBody);

                //Alineando las columnas
                //Tipo Documento
                $sheet->getStyle("B$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("C$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("D$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("E$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("F$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("G$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("H$aux")->getAlignment()->setHorizontal('center');
                ++$aux;
                ++$i;
                $start++;
            }

            //3er reporte

            $topTenClients = $this->top10Clients();
            $headerTopTenMargin  = ['TOP','DNI', 'NOMBRE', 'MONTO DE VENTAS'];
            $start = $start + 3;
            $sheet->fromArray([$headerTopTenMargin], NULL, "A{$start}");
            $sheet->getStyle("A$start:D$start")->getAlignment()->setHorizontal('center');
            //aplicar estilos a la cabecera
            $sheet->getStyle("A$start:D$start")->applyFromArray($styleHeaderCells);
            $i = 1;
            $aux = $start + 1;
            $title = $start - 1;
            $sheet->mergeCells("A$title:D$title");
            $sheet->setCellValue("A$title", 'Top 10 de clientes que compran mas.');
            $getTopTenMargin = $this->getTopTenSoldMargin();
            foreach ($topTenClients as $top) {
                // $fecha_afilicacion = \DateTime::createFromFormat('Y-m-d', $value->fecha_afiliacion);
                $sheet->setCellValue("A$aux", $i);
                $sheet->setCellValue("B$aux", $top->document);
                $sheet->setCellValue("C$aux", $top->name);
                $sheet->setCellValue("D$aux", $top->total_sales);
                //aplicando estilos al body
                $sheet->getStyle("A$aux:D$aux")->applyFromArray($styleBody);

                //Alineando las columnas
                //Tipo Documento
                $sheet->getStyle("B$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("C$aux")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("D$aux")->getAlignment()->setHorizontal('center');
                ++$aux;
                ++$i;
            }

            $writer = IOFactory::createWriter($document, 'Xlsx');
            return response()->streamDownload(function() use ($writer){
                $writer->save('php://output');
            }, 'REPORTE GENERAL.xlsx');
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

    public function top10Clients()
    {
        return Client::withSum('sales', 'total')
        ->whereHas('sales')
        ->orderByDesc('sales_sum_total')
        ->get()
        ->transform(function($client) {
            $item = new stdClass();
            $item->document = $client->document_number;
            $item->name = $client->name;
            $item->total_sales = $client->sales->sum('total');

            return $item;
        })
        ->sortByDesc('total_sales')
        ->take(10)
        ->values()
        ->toArray();
    }
}
