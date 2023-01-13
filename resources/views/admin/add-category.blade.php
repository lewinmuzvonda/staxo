@extends('layouts.master') 
@section('title', 'Create Category')
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
                <a href="{{ route('categories') }}" class="btn btn-primary">View Categories</a>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('savecategory') }}" method="POST">
                @CSRF
                <div class="form-group pb-4">
                  <label for="category_name" class="pb-2">Category Name</label>
                  <input type="text" class="form-control" id="category_name" name="category_name">
                </div>

                <div class="form-group pb-4">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>

              </form>
        </div>
    </div>

    <!-- push additional js -->
    @push('script')
   

    @endpush
@endsection
