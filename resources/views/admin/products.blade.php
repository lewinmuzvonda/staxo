@extends('layouts.master') 
@section('title', 'Manage Products')
@section('content')
    <!-- push additional head elements to head -->
    @push('head')

    @endpush
    <div class="container p-5">
        <div class="row pb-5">
            <div class="col">
                <a href="{{ route('productform') }}" class="btn btn-primary">Create Product</a>
                <a href="{{ route('categories') }}" class="btn btn-primary">Manage Categories</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
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
                            <td>{{$product['price']}}</td>
                            <td>Active</td>
                            <td><button type="button" class="btn btn-primary">Edit Product</button></td>
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
