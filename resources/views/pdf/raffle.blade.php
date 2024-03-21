<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raffle</title>
    <style>
        * {
            font-display: sans-serif !important;
            text-align: center;
            margin: 0;
            padding: 0;
            box-sizing: border-box; 
        }

        td {
            border: 2px solid black;
            text-align: center;
            padding: 20px
        }
        
        table {
            border-collapse: collapse
        }
        
        .name {
            font-size: 24px;
            font-display: sans-serif !important;
        }
        .raffle-ticket{
            width: 450px;
        }
        body{
            padding: 1cm;
            font-display: sans-serif !important;
        }
        </style>
</head>

<body>
    @php
        $numbers = explode(',', $ticket['numbers']);
        $colsNumber = 5;
        $cols = array_chunk($numbers, $colsNumber);
        $awards = $ticket['raffle']['awards'];
        $name = $ticket['owner']['name'];
    @endphp


    <section class="raffle-ticket">
        <table>
            <tbody>
                <tr>
                    <td colspan="{{ $colsNumber }}">
                        <h4>Con la compra colaboras con la escuela de taekwondo americano</h4>
                        @foreach ($awards as $index => $award)
                            @if (property_exists($award, 'status'))
                                <h4>{{ $index + 1 }}# Premio: {{ $award->raffle }} - {{ $award->award }}</h4>
                            @endif
                        @endforeach
                    </td>
                </tr>
                @foreach ($cols as $col)
                    <tr>
                        @foreach ($col as $number)
                            <td>{{ str_pad($number, 3, '0', STR_PAD_LEFT) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Con la venta de este carton aseguro mi participacion</h5>
        <h1 class="name">{{ $name }}</h1>
    </section>

</body>

</html>
