
    <div class="card h-85 p-4" style="width: 25rem;">
        <div class="card-header text-center">
            {{$name}}
        </div>
        
      
        <div class="card-body text-center">
            <img class="card-img-top" src={{$image}}>
            <h5 class="card-title text-primary">{{$name}}</h5>
            <p class="card-text pb-2">
            <strong>PRICE</strong> {{$price}}AED
            </p>
           
        </div>

        <div class="card-footer text-center">
            <a href="javascript:void(0)" class="btn btn-outline-primary">Add to Cart</a>
        </div>
    </div>
  