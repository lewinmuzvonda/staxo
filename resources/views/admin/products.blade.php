@extends('layouts.master') 
@section('title', 'Manage Products')

@push('head')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
@endpush

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
                            <td>
                                <a href="{{ route('editproductform', $product['id']) }}">
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </a>

                                <button type="button" class="btn" style="background-color: rgb(205, 19, 19);color:white" onClick="modal({{$product['id']}})" data-toggle="modal" data-target="#myModal">
                                    Delete
                                </button>
                                
                                <div class="modal fade" id="myModal{{$product['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content align-items-center">
                                        <div class="modal-header">
                                        <h4 class="modal-title fw-bold" id="myModalLabel">You are about to delete {{$product['name']}}</h4>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to continue?
                                        </div>
                                        <div class="modal-footer">
                                        <button onClick="cancel({{$product['id']}})" type="button" class="btn btn-primary" data-dismiss="modal">NO, DON'T DELETE</button>
                                        
                                        <a href="{{ route('deleteproduct', $product['id']) }}">
                                            <button type="button" style="background-color: rgb(205, 19, 19);color:white" class="btn">YES, DELETE</button>
                                        </a>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>

          


        </div>
    </div>

@endsection
@push('script')
<script>

    function modal(id){
        $('#myModal'+id).modal('toggle');
        $('#myModal'+id).modal('show');

        $('#myModal'+id).on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
    }

    function cancel(id){
        $('#myModal'+id).modal('hide');
    }
   

</script>
@endpush
