@extends('layouts.master') 
@section('title', 'Manage Products')
@section('content')
    <!-- push additional head elements to head -->
    @push('head')
        <style>
            label{
                font-weight: bold;
            }
        </style>
    @endpush
    <div class="container p-5">
        <div class="row pb-5">
            <div class="col">
                <button type="button" class="btn btn-primary">View Products</button>
            </div>
        </div>
        <div class="row">
            <form>
                @CSRF
                <div class="form-group pb-4">
                  <label for="product_name" class="pb-2">Product Name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name">
                </div>

                <div class="form-group pb-4">
                  <label for="category" class="pb-2">Category</label>
                  <select class="form-control" id="category" name="category">
                    <option>Laptops</option>
                    <option>Smartphones</option>
                  </select>
                </div>

                <div class="form-group pb-4">
                    <label for="product_name" class="pb-2">Price (AED)</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>

                <div class="form-group pb-4">
                    <label for="image" class="pb-2">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png">
                </div>

                <div class="form-group pb-4">
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>

              </form>
        </div>
    </div>

    <!-- push additional js -->
    @push('script')

    @endpush
@endsection
