<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Edit Product
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
                                    Edit Product
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.product') }}" class="btn btn-success float-end">All Products</a>
                                </div>
                                </div>
                           </div>
                           <div class="card-body">
                               @if (Session::has('message'))
                                   <div class="alert alert-success" role="alert">
                                       {{ Session::get('message') }}
                                   </div>
                               @endif
                               <form wire:submit.prevent="updateProduct">
                                   <div class="mb-3 mt-3">
                                       <label for="name" class="form-label">Name</label>
                                       <input type="text" name="name" id="name" class="form-control" placeholder="Enter Category Name..." wire:model="name" wire:keyup="generateSlug">
                                       @error('name')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="slug" class="form-label">Slug</label>
                                       <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter Category Slug..." wire:model="slug">
                                       @error('slug')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="short_description" class="form-label">Short Description</label>
                                       <textarea name="short_description" class="form-control" placeholder="Enter Short Description..." wire:model="short_description"></textarea>
                                       @error('short_description')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="description" class="form-label">Description</label>
                                       <textarea name="description" class="form-control" id="description" placeholder="Enter Description..." wire:model="description"></textarea>
                                       @error('description')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="regular_price" class="form-label">Regular Price</label>
                                       <input type="number" name="regular_price" id="regular_price" class="form-control" placeholder="Enter regular price..." wire:model="regular_price">
                                       @error('regular_price')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                    <label for="sale_price" class="form-label">Sale Price</label>
                                    <input type="text" name="sale_price" id="sale_price" class="form-control" placeholder="Enter regular price..." wire:model="sale_price">
                                    @error('sale_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                   <div class="mb-3 mt-3">
                                       <label for="SKU" class="form-label">SKU</label>
                                       <input type="text" name="SKU" id="SKU" class="form-control" placeholder="Enter SKU..." wire:model="SKU">
                                       @error('SKU')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="stock_status" class="form-label" >Stock Status</label>
                                       <select name="stock_status" id="stock_status" class="form-select" wire:model="stock_status">
                                           <option value="instock">In Stock</option>
                                           <option value="outofstock">Out At Stock</option>
                                       </select>
                                       @error('stock_status')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="featured" class="form-label" >Featured</label>
                                       <select name="featured" id="featured" class="form-select" wire:model="featured">
                                           <option value="0">No</option>
                                           <option value="1">Yes</option>
                                       </select>
                                       @error('featured')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="quantity" class="form-label">Quantity</label>
                                       <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter Product quantity..." wire:model="quantity">
                                       @error('quantity')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="image" class="form-label">Image</label>
                                       <input type="file" name="image" id="image" class="form-control" wire:model="newImage">
                                        @if ($newImage)
                                            <img src="{{ $newImage->temporaryUrl() }}" width="120">
                                        @else
                                            <img src="{{ asset('assets/imgs/products') }}/{{ $image }}" width="120">
                                       @endif
                                       @error('newImage')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="mb-3 mt-3">
                                       <label for="category_id" class="form-label">Category</label>
                                       <select name="category_id" id="category_id" class="form-select" wire:model="category_id">
                                           <option value="">Select Category</option>
                                           @foreach ($categories as $category)
                                               <option value="{{ $category->id }}">{{ $category->name }}</option>
                                           @endforeach
                                       </select>
                                       @error('category_id')
                                           <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>

                                   <button type="submit" class="btn btn-primary float-end">Update</button>
                               </form>
                           </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</div>