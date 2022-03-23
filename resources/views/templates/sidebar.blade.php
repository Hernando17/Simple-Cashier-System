<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        {{-- <img src="{{ asset('adminlte') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">SCS tool</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link @if ($page == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->level == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('user') }}"
                            class="nav-link @if ($page == 'user') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('inventory') }}"
                        class="nav-link @if ($page == 'inventory') active @endif">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Inventory</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaction') }}"
                        class="nav-link @if ($page == 'transaction') active @endif">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Transaction</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('transaction') }}"
                        class="nav-link @if ($page == 'history') active @endif">
                        <i class="nav-icon fas fa-history"></i>
                        <p>History</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
