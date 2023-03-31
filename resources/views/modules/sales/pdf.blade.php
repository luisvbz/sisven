<!DOCTYPE html>
<html>
<head>
<title>Venta {{ $sale->number}}</title>
<style type="text/css">
body {
    font-family: "Courier New";
    margin: 0;
    padding: 0;
    font-size: 10px;
}
.numero {
    font-size: 20px;
    text-align: right;
    margin-bottom: 20px;
    border-bottom: 1px dashed #ccc;
    margin-bottom: 20px;
}

.logo {
    text-align: center;
    width:100%;
    margin-bottom: 10px;
}
</style>
</head>
<body>
    <div class="logo">
        <img width="180" src="{{ asset('images/logo.png')}}"/>
    </div>
    <div style="margin-bottom: 10px; border-bottom: 1px dashed #000000; padding-bottom:10px;">
        <div style="text-align: center;"><strong>Comercializadora Marleny's</strong></div>
        <div style="text-align: center;">RUC: <strong>000000000000</strong></div>
        <div style="text-align: center;">Av. Francisco Bolognesi - Chiclayo</div>
        <div style="text-align: center;">Telf: <strong>01-1234567</strong></div>
        <div style="text-align: center;">Nro Pedido: <strong>{{ $sale->number }}</strong></div>
    </div>
    <div style="margin-bottom: 10px; border-bottom: 1px dashed #000000; padding-bottom:10px;">
        <div style="text-align: left;">
            @if($sale->status == 'proccesed')
                Estado: <span style="color: green;"><strong>PROCESADA</strong></span>
            @else
                Estado:  <span style="color: red;"><strong>CANCELADA</strong></span>
            @endif
        </div>
        <div style="text-align: left;"><strong>Cliente: </strong>{{ $sale->client->name }}</div>
        <div style="text-align: left;"><strong>Fecha: </strong>{{ $sale->created_at->format('d/m/Y') }}</div>
        <div style="text-align: left;"><strong>Tienda: </strong>{{ $sale->store->name }}</div>
        <div style="text-align: left;"><strong>Vendedor: </strong>{{ $sale->user->name }}</div>
    </div>
    <div style="margin-bottom: 10px; border-bottom: 1px dashed #000000; padding-bottom:10px;">
        <div style="text-align: center;letter-spacing: 2px;"><strong>DETALLE DE LA VENTA</strong></div>
    </div>
    <div style="width: 100%;">
        <table class="tg">
        <thead>
            <tr>
                <th class="tg-eq3i">CANT.</th>
                <th class="tg-eq3i">UM</th>
                <th class="tg-eq3i">TU</th>
                <th class="tg-hzho">PRODUCTO</th>
                <th style="text-align: right;">PRECIO</th>
                <th style="text-align: right;">TOTAL</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($sale->products as $item)
            <tr>
                <td style="width: 10%; text-align: center;">{{ $item->quantity_type }}</td>
                <td style="width: 10%; text-align: center;">
                    {{ $item->type->alias }}
                </td>
                <td style="width: 10%;text-align: center;">
                {{ $item->quantity_type*$item->type->quantity }}
                </td>
                <td  class="tg-0lax">
                 {{ $item->product->full_name }}
                </td>
                <td style="text-align: right;">
                {{  number_format($item->unit_price, 2,".", ",") }}
                </td>
                <td style="text-align: right;">
                {{  number_format($item->total, 2,".", ",") }}
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
