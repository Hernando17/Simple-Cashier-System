<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 3</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">

    <div class="container mt-5">
        <h1 class="text-center">Payment</h1>
        <table class="table table-bordered">
            <th>Item</th>
            <th>Quantity</th>
            <th>Discount</th>
            <th>Total</th>

            @foreach ($transaction as $t)
                <tbody>
                    <td>
                        {{ $t->inventory->item }}
                        (@php
                            $number_format = 'Rp ' . number_format($t->inventory->price, 2, ',', '.');
                            echo $number_format;
                        @endphp)
                    </td>
                    <td>{{ $t->quantity }}</td>
                    <td>{{ $t->discount }}</td>
                    <td>
                        @php
                            $multiply = $t->inventory->price * $t->quantity - $t->discount;
                            $number_format = 'Rp ' . number_format($t->total, 2, ',', '.');
                            echo $number_format;
                        @endphp
                    </td>
                </tbody>
            @endforeach
            <hr>
            <p class="float-right">
                @php
                    $total = $transaction->sum('total');
                    $date = date('Y-m-d H:i:s');
                    $timezone = date_default_timezone_get();
                    $timestamp = strtotime($date);
                    
                    echo 'Code : SC' . $timestamp . '<br>';
                    echo 'Total : Rp ' . number_format($total, 2, ',', '.');
                @endphp
            </p>
        </table>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('adminlte') }}/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte') }}/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminlte') }}/js/pages/dashboard3.js"></script>

    <script>
        window.print();
    </script>
</body>

</html>
