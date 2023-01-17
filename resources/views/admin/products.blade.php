@extends('layouts.master') 
@section('title', 'Manage Products')
@section('content')

    <div class="container p-5">
        <div class="row pb-5 d-flex align-items-left justify-content-between">
            <div class="col">
                <a href="{{ route('productform') }}" class="btn btn-primary">Add Product</a>
            </div>
        </div>
        <div class="container table-responsive py-5">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <img height="100px" width="100px" src="{{$product['image']}}" />
                            </td>
                            <td>{{$product['name']}}</td>
                            <td>{{$product['category_name']}}</td>
                            <td>{{$product['price']}} AED</td>
                            <td>Active</td>
                            <td><a href="{{ route('editproductform', $product['id']) }}"><button type="button" class="btn btn-primary">Edit Product</button></td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>

    <!-- push additional js -->
    @push('script')

    @endpush
@endsection
