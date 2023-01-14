@extends('layouts.master') 
{{-- @section('title', 'Product') --}}
@section('content')
    <!-- push additional head elements to head -->
    @push('head')
        <title>{{$name}} | STAXO</title>
    @endpush

        <section class="container pt-5">
            <div class="container p-5 border-2 rounded-3 border-primary">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{$image}}" alt="{{$name}}" /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">{{$category}}</div>
                        <h1 class="display-5 fw-bolder">{{$name}}</h1>
                        <div class="fs-5 mb-5">
                            <span class="fw-bold text-primary">{{$price}} AED</span>
                        </div>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="shopping-bag"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(!$related->isEmpty())
        <section class="py-5 mt-5 bg-primary">
            <div class="container px-4 px-lg-5 mt-5">
                <h1 class="fw-bolder mb-4 text-light">Related products</h1>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
                    @foreach($related as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="/product/{{$product['id']}}"><img class="card-img-top" src="{{$product['image']}}" alt="{{$product['name']}}" /></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <a href="/product/{{$product['id']}}"><h5 class="fw-bolder text-primary">{{$product['name']}}</h5></a>
                                    <!-- Product price-->
                                    <strong>{{$product['price']}} AED</strong>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-primary" href="/product/{{$product['id']}}">VIEW</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
    
                </div>
            </div>
            
        </section>
        @endif
        

    <!-- push additional js -->
    @push('script')

    @endpush
@endsection
