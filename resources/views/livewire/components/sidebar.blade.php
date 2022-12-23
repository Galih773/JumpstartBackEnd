<div>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href={{ route('dashboard')}}><i class
                            ="menu-icon fa fa-laptop"></i>Dashboard</a>
                    </li>
                    <li class="menu-title">Product</li><!-- /.menu-title -->
                    <li class="">
                        <a href={{ route('products.index') }}> <i class="menu-icon fa fa-list"></i>View Product</a>
                    </li>
                    <li class="">
                        <a href={{ route('products.create')}}> <i class="menu-icon fa fa-plus"></i>Add Product</a>
                    </li>

                    <li class="menu-title">Product Photo</li><!-- /.menu-title -->
                    <li class="">
                        <a href="{{ route('product-galleries.index') }}"> <i class="menu-icon fa fa-list"></i>View Product Photos</a>
                    </li>
                    <li class="">
                        <a href="{{ route('product-galleries.create') }}"> <i class="menu-icon fa fa-plus"></i>Add Product Photos</a>
                    </li>

                    <li class="menu-title">Orders</li><!-- /.menu-title -->
                    <li class="">
                        <a href="{{ route('orders.index') }}"> <i class="menu-icon fa fa-list"></i>View Orders</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
</div>
