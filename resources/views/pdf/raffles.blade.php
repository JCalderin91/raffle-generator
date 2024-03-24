<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="https://i.ibb.co/rd1Kwpc/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cartones</title>
    <style>
        * {
            font-family: sans-serif !important;
            text-align: center;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }





        .raffle-ticket {
            width: 373px;
            border: 2px dotted black;
            padding: 10px;
            display: inline-block;
            float: left;
        }

        body {
            padding: 0.3cm;
            font-family: sans-serif !important;
        }

        .table {
            position: relative;
            width: 100%;
        }

        .header {
            padding: 5px 10px;
            border: 2px solid black;
        }

        .main-text {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .award {
            font-size: 14px;
        }

        .bg-logo {
            position: absolute;
            left: 50%;
            top: 110px;
            transform: translateX(-50%);
            opacity: 0.25;
            width: 60%;
        }

        .number {
            font-size: 16px;
            font-weight: bold;
            padding: 20px;
            border: 2px solid black;
        }

        .date {
            font-size: 14px;
        }

        .price {
            font-size: 14px;
            text-align: left
        }

        .name {
            font-size: 14px;
            font-family: sans-serif !important;
            text-align: right;
        }

        .bottom-text {
            margin-top: 4px;
            display: block;
            font-style: italic
        }

        .table-bottom {
            margin-top: 8px;
        }

        .table-bottom td {
            vertical-align: bottom
        }

        .page-break {
            page-break-before: always
        }

        .hide-break {
            display: block;
            color: transparent;
            font-size: 1px;
        }
    </style>
</head>

<body>
    @php
        $count = 0;
    @endphp

    @foreach ($tickets as $key => $ticket)
        @php
            $numbers = explode(',', $ticket['numbers']);
            $colsNumber = 4;
            $cols = array_chunk($numbers, $colsNumber);
            $awards = $ticket['raffle']['awards'];
            $name = $ticket['owner']['name'];
            $price = $ticket['raffle']['price'];
            $date = $ticket['raffle']['draw_date'];
            $count += 1;
        @endphp

        <section class="raffle-ticket">
            <div class="table">
                <img class="bg-logo" src="https://i.ibb.co/cX5H3MP/logo-atin-bw.png" alt="atim logo blanco y negro">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="{{ $colsNumber }}" class="header">
                                <h4 class="main-text">Con la compra colaboras con la escuela de Taekwondo Americano</h4>
                                @foreach ($awards as $index => $award)
                                    @if (property_exists($award, 'status'))
                                        <h4 class="award">{{ $index + 1 }}# {{ $award->raffle }} -
                                            {{ $award->award }}</h4>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        @foreach ($cols as $col)
                            <tr>
                                @foreach ($col as $number)
                                    <td class="number">{{ str_pad($number, 3, '0', STR_PAD_LEFT) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <h5 class="bottom-text">Con la venta de este carton aseguro mi participación en los eventos programados.</h5>
            <table class="table-bottom">
                <th>
                <td>
                    <h3 class="price">Precio: ${{ number_format($price) }}</h3>
                </td>
                <td>
                    <h3 class="date">Fecha: {{ Carbon\Carbon::parse($date)->format('d-m-Y') }}</h3>
                </td>
                <td>
                    <h2 class="name">{{ $name }}</h2>
                </td>
                </th>
            </table>

        </section>

        @if ($count == 2)
            <div class="hide-break">hide</div>
        @endif

        @if ($count == 4 && ($key + 1) < count($tickets) )
            @php
                $count = 0;
            @endphp
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>
