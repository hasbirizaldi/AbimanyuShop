<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
        .btn-edit{
            background: green;
            color: #fff;
            border: none;
        }
        .btn-edit:hover{
            background: rgb(11, 65, 15)
        }
        .btn-delete{
            background: red;
            color: #fff;
            border: none;
        }
        .btn-delete:hover{
            background: rgb(75, 3, 3)
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> All Products
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                   All Products
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.product.add') }}" class="btn btn-success float-end">Add New Product</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                                                <td>
                                                    <img src="{{asset('assets/imgs/products')}}/{{ $product->image }}" width="60" height="60" alt="{{ $product->name }}">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->stock_status }}</td>
                                                <td>Rp. {{ number_format($product->regular_price) }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.product.edit', ['product_id'=>$product->id]) }}" class=" btn btn-sm btn-edit btn-success">Edit</a>
                                                    <a href="#" onclick="deleteConfirmation({{ $product->id }})" class="btn btn-sm text-white btn-delete">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-3 pt-3">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Do you want to delete this record?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id){
            @this.set('product_id', id);
            $('#deleteConfirmation').modal('show');
        }
        function deleteProduct(){

            @this.call('deleteProduct');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush