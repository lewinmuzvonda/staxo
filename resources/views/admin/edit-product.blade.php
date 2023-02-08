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
        <div class="row pb-5 d-flex align-items-left justify-content-between">
            <div class="col">
                <a href="{{ route('admin') }}" class="btn btn-primary">View Products</a>
            </div>
            <div class="col">
                <a href="{{ route('categories') }}" class="btn btn-primary">Manage Categories</a>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('editproduct') }}" method="POST" enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="form-group pb-4">
                  <label for="product_name" class="pb-2">Product Name</label>
                  <input type="hidden" name="id" value="{{$product->id}}"/>
                  <input type="text" class="form-control" id="product_name" name="product_name" value="{{$product->name}}" required>
                </div>

                <div class="form-group pb-4">
                  <label for="category" class="pb-2">Category</label>
                  <select class="form-control" id="category" name="category" required>

                    @foreach($categories as $category)
                        @if($category['id'] == $product->category )
                        <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                        @else
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @endif
                    @endforeach

                  </select>
                </div>

                <div class="form-group pb-4">
                    <label for="price" class="pb-2">Price (USD)</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" required>
                </div>

                <div class="form-group pb-4">
                    <label for="image" class="pb-2">Change Image</label>
                    <input type="file" id="image" max-size="500" class="form-control" accept=".jpg,.jpeg,.png">
                </div>

                <input type="text" name="image_data" id="image_data" hidden>

                <div class="form-group pb-4">
                    <button type="submit" id="file-submit" class="btn btn-primary">Update Product</button>
                    <a id="cancel" style="background-color: rgb(205, 19, 19);color:white" class="btn" href="{{ route('admin') }}">Cancel</a>
                </div>

                <p id="file-result"></p>

              </form>
        </div>
    </div>

    <!-- push additional js -->
    @push('script')
    <script>
        const fileInput = document.getElementById("image");
        let fileResult = document.getElementById("file-result");
        let fileSubmit = document.getElementById("file-submit");

        fileInput.addEventListener("change", e => {

            if (fileInput.files.length > 0) {

                const fileSize = fileInput.files.item(0).size;
                const fileMb = fileSize / 1024 ** 2;

                if (fileMb >= 0.6) {

                fileResult.innerHTML = "Please select a file less than 500KB";
                fileSubmit.disabled = true;

                } else if( fileMb < 0.6 ) {

                fileSubmit.disabled = false;
                }
            }

            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                // Base64 Data URL
                console.log(reader.result);
                document.getElementById("image_data").value = reader.result;
            });

            reader.readAsDataURL(file);
        });
        
    </script>

    @endpush
@endsection
