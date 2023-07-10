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
                    <span></span> All Categories
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
                                    Categories
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.category.add') }}" class="btn btn-success float-end">Add New Category</a>
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
                                            <th>Slug</th>
                                            <th>Popular</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/imgs/categories/'.$category->image) }}" alt="">
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->is_popular == 1 ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.category.edit', ['category_id'=>$category->id]) }}" class=" btn btn-sm btn-edit btn-success">Edit</a>
                                                    <a href="#" onclick="deleteConfirmation({{ $category->id }})" class="btn btn-sm text-white btn-delete">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $categories->links() }}
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
                        <button type="button" class="btn btn-danger" onclick="deleteCategory()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id){
            @this.set('category_id', id);
            $('#deleteConfirmation').modal('show');
        }
        function deleteCategory(){

            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush