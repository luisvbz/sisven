<!DOCTYPE html>
<html>
<head>
<title>Venta {{ $sale->number}}</title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;width:100%;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-xbpl{background-color:#efefef;font-size:12px;font-weight:bold;text-align:right;vertical-align:top}
.tg .tg-hzho{background-color:#efefef;font-size:12px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-eq3i{background-color:#efefef;font-size:12px;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-lqy6{text-align:right;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}
.numero {
    font-size: 20px;
    text-align: right;
    margin-bottom: 20px;
    border-bottom: 1px dashed #ccc;
    margin-bottom: 20px;
}
</style>
</head>
<body>
    <div class="numero">Venta <strong>#{{ $sale->number}}</strong></div>
    <p><strong>Estado: </strong>
        @if($sale->status == 'proccesed')
            <span style="color: green;"><strong>PROCESADA</strong></span>
        @else
            <span style="color: red;"><strong>CANCELADA</strong></span>
        @endif
    </p>
    <p><strong>Cliente: </strong>{{ $sale->client->name }}</p>
    <p><strong>Fecha: </strong>{{ $sale->created_at->format('d/m/Y') }}</p>
    <p><strong>Tienda: </strong>{{ $sale->store->name }}</p>
    <p><strong>Vendedor: </strong>{{ $sale->user->name }}</p>
    <div style="width: 100%;">
        <table class="tg">
        <thead>
            <tr>
                <th class="tg-eq3i">CANT.</th>
                <th class="tg-eq3i">UM</th>
                <th class="tg-eq3i">TU</th>
                <th class="tg-hzho">PRODUCTO</th>
                <th class="tg-xbpl">PRECIO</th>
                <th class="tg-xbpl">TOTAL</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sale->products as $item)
            <tr>
                <td style="width: 10%;" class="tg-baqh">{{ $item->quantity_type }}</td>
                <td style="width: 10%;"class="tg-baqh">
                    {{ $item->type->alias }}
                </td>
                <td style="width: 10%;" class="tg-baqh">
                {{ $item->quantity_type*$item->type->quantity }}
                </td>
                <td  class="tg-0lax">
                 {{ $item->product->full_name }}
                </td>
                <td class="tg-lqy6">
                {{ "S/ ".number_format($item->unit_price, 2,".", ",") }}
                </td>
                <td class="tg-lqy6">
                {{ "S/ ".number_format($item->total, 2,".", ",") }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="tg-lqy6" colspan="4"></td>
            <td class="tg-lqy6">
            <strong>Total</strong>
            </td>
            <td class="tg-lqy6">
             <strong>{{ $sale->total_formated }}</strong>
             </td>
        </tr>
        </tbody>
        </table>
    </div>
    @if($sale->justification != null)
        <div style="margin-top: 15px; padding: 10px; background-color: #efefef; border-radius: 5px;">
            <div style="margin-bottom: 10px; font-size: 12px;">
                Venta cancelada por <strong>{{ $sale->justification->user->name }}</strong> el <span style="color: red;">{{ $sale->justification->created_at->format('d/m/Y h:i a') }}</span>
            </div>
            <div>
                {{ $sale->justification->justification }}
            </div>
        </div>
    @endif

</body>
</html>
