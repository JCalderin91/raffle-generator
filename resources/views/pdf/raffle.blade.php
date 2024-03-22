<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $ticket['owner']['name'] }} - Carton</title>
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

        .name {
            font-size: 20px;
            font-family: sans-serif !important;
            text-align: right;
        }

        .price {
            text-align: left
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
            font-size: 20px;
            font-weight: bold;
            padding: 20px;
            border: 2px solid black;
        }

        .bottom-text {
            margin-top: 8px;
            display: block;
        }

        .table-bottom {
            margin-top: 4px;
        }

        .table-bottom td {
            vertical-align: bottom
        }
    </style>
</head>

<body>
    @php
        $numbers = explode(',', $ticket['numbers']);
        $colsNumber = 4;
        $cols = array_chunk($numbers, $colsNumber);
        $awards = $ticket['raffle']['awards'];
        $price = $ticket['raffle']['price'];
        $name = $ticket['owner']['name'];
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
                                <h4 class="award">{{ $index + 1 }}# Premio: {{ $award->raffle }} -
                                    {{ $award->award }}</h4>
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


        <h5 class="bottom-text">Con la venta de este carton aseguro mi participacion</h5>
        <table class="table-bottom">
            <th>
            <td>
                <h3 class="price">${{ $price }}</h3>
            </td>
            <td>
                <h2 class="name">{{ $name }}</h2>
            </td>
            </th>
        </table>

    </section>

</body>

</html>
