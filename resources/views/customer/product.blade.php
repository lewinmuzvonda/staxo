<form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card h-85 p-4" style="width: auto;">
        <div class="card-header text-center" style="background-color: black">
            <a href="/product/{{$id}}" class="btn btn-outline-light"> {{$name}}</a>
        </div>
        
      
        <div class="card-body text-center">
            <a href="/product/{{$id}}"><img class="card-img-top" src={{$image}}></a>
            <p class="card-text pb-2">
            <strong class="card-title" style="color: black">AED {{number_format($price, 2)}}</strong>
            </p>
           
        </div>

        <input type="hidden" value="{{ $id}}" name="id">
        <input type="hidden" value="{{ $name }}" name="name">
        <input type="hidden" value="{{ $price }}" name="price">
        <input type="hidden" value="{{ $image }}"  name="image">
        <input type="hidden" value="1" name="quantity" hidden>

        <div class="card-footer text-center">
            <button class="btn btn-primary">Add To Cart</button>
        </div>
           


    </div>
</form>
  