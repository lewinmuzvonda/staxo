@extends('layouts.master') 
@section('title', 'Manage Categories')
@section('content')
    <!-- push additional head elements to head -->
    @push('head')

    @endpush
    <div class="container p-5">
        <div class="row pb-5 d-flex align-items-left justify-content-between">
            <div class="col">
                <a style="width:auto" href="{{ route('categoryform') }}" class="btn btn-primary">Add Category</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Category Name</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category['name']}}</td>
                            <td><button type="button" class="btn btn-primary">Edit Category</button></td>
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
