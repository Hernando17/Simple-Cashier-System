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

    <div class="container">
        <h1 class="text-center">Tax</h1>
        <table class="table table-bordered">
            <th>ID Inventory</th>
            <th>Quantity</th>
            <th>Discount</th>
            <th>Total</th>

            @foreach ($transaction as $t)
                <tbody>
                    <td>{{ $t->id_inventory }}</td>
                    <td>{{ $t->quantity }}</td>
                    <td>{{ $t->discount }}</td>
                    <td>
                        {{ $t->inventory->price - $t->discount }}
                    </td>
                </tbody>
            @endforeach
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
