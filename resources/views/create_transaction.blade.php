@extends('templates/index')
@section('title', 'Create new transaction')
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
                        <h1 class="m-0">Create New Transaction</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create New Transaction</li>
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
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="{{ route('create_transactionact') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">Item</label><br>
                                        <select class="custom-select rounded-0 col-2" id="exampleSelectRounded0"
                                            name="id_inventory">
                                            @foreach ($inventory as $i)
                                                <option value="{{ $i->id }}">{{ $i->item }} (Rp
                                                    {{ $i->price }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Quantity</label>
                                        <input type="number" name="quantity" class="form-control col-2"
                                            id="exampleInputPassword1" placeholder="Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Discount</label>
                                        <input type="number" name="discount" class="form-control col-2"
                                            id="exampleInputPassword1" placeholder="Discount">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
