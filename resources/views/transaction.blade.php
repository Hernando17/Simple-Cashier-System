@extends('templates/index')
@section('title', 'Transaction')
@section('content')

    <?php
    $page = 'transaction';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transaction Data</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Transaction</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('create_transaction') }}"
                                    class="btn btn-success float-left ion-plus"></a>
                                <a href="{{ route('transaction') }}"
                                    class="btn btn-primary float-left ml-1 ion-refresh"></a>
                                <a href="{{ route('print_transaction') }}" class="btn btn-info float-right">Paid</a>
                            </div>

                            <!-- /.card-header -->
                            <div class="
                            card-body">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $t)
                                            <tr>
                                                <td>{{ !empty($i) ? ++$i : ($i = 1) }}</td>
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
                                                        $number_format = 'Rp ' . number_format($multiply, 2, ',', '.');
                                                        echo $number_format;
                                                    @endphp

                                                </td>
                                                <td>
                                                    <a href="{{ route('edit_user', $t->id) }}"
                                                        class="btn btn-primary ion-edit"></a>
                                                    <form action="{{ route('delete_transaction', $t->id) }}" method="GET"
                                                        class="d-inline">
                                                        <button type="button" class="btn btn-danger ion-trash-a"
                                                            data-toggle="modal"
                                                            data-target="#modal-default{{ $t->id }}">
                                                        </button>
                                                        <div class="modal fade" id="modal-default{{ $t->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Delete User
                                                                            ({{ $t->name }})
                                                                        </h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure?</p>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->

@endsection
