<div>
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">List of Product</h4>
                    </div>

                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Color</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Discount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->color }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->stock }} piece</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>
                                        <a href="{{ route('products.gallery', $product->id) }}" class="btn btn-info btn-sm">
                                        {{-- <a href="#" class="btn btn-info btn-sm"> --}}
                                        <i class="fa fa-picture-o"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                        </a>
                                        {{-- <form action="{{ route('products.destroy', $product->id) }}" 
                                            method="post" 
                                            class="d-inline">
                                        @csrf
                                        @method('delete') --}}
                                        <div class="d-inline">
                                            <button wire:click="destroy({{$product->id}})" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        
                                        {{-- </form> --}}
                                    </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center p-5">
                                            No data available
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
