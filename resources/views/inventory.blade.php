@extends('templates/index')
@section('title', 'Inventory')
@section('content')

    <?php
    $page = 'inventory';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Inventory Data</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Inventory</li>
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
                                <a href="{{ route('create_inventory') }}" class="btn btn-success float-left ion-plus"></a>
                                <a href="{{ route('inventory') }}"
                                    class="btn btn-primary float-left ml-1 ion-refresh"></a>
                            </div>

                            <!-- /.card-header -->
                            <div class="
                            card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventorys as $u)
                                            <tr>
                                                <td>{{ !empty($i) ? ++$i : ($i = 1) }}</td>
                                                <td>{{ $u->item }}</td>
                                                <td>{{ $u->price }}</td>
                                                <td>
                                                    <a href="{{ route('edit_inventory', $u->id) }}"
                                                        class="btn btn-primary ion-edit"></a>
                                                    <form action="{{ route('delete_inventory', $u->id) }}" method="GET"
                                                        class="d-inline">
                                                        <button type="button" class="btn btn-danger ion-trash-a"
                                                            data-toggle="modal"
                                                            data-target="#modal-default{{ $u->id }}">
                                                        </button>
                                                        <div class="modal fade" id="modal-default{{ $u->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Delete Item
                                                                            ({{ $u->item }})
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
