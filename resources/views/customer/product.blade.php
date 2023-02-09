
    <div class="card h-85 p-4" style="width: auto;">
        <div class="card-header text-center" style="background-color: black">
            <a href="/product/{{$id}}" class="btn btn-outline-light">{{$name}}</a>
        </div>
        
      
        <div class="card-body text-center">
            <a href="/product/{{$id}}"><img class="card-img-top" src={{$image}}></a>
            <p class="card-text pb-2">
            <strong class="card-title" style="color: black">USD {{number_format($price, 2)}}</strong>
            </p>
           
        </div>

        <div class="card-footer text-center">
            {{-- <a href="/product/{{$id}}"><button class="btn btn-primary">BUY NOW</button></a> --}}
            <a href="https://api.whatsapp.com/send?phone=971529667536&text=Hi%2C%20I%20would%20like%20to%20inquire%20about:%20%0A{{$name}}"><button class="btn btn-primary">INQUIRE</button></a>
        </div>
           
    </div>
  