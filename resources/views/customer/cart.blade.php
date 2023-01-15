@extends('layouts.master') 
@section('title', 'Cart')
@section('content')

            <main class="my-8">
              <div class="container px-6 mx-auto">
                  <div class="flex justify-center my-6">
                      <div class="border rounded-4 flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                        @if ($message = Session::get('success'))
                            <div class="p-4 mb-3 bg-primary rounded">
                                <p class="text-white">{{ $message }}</p>
                            </div>
                        @endif
                        <h3 style="color: black" class="text-3xl font-bold">Cart</h3>
                        <div class="flex-1">
                            <table class="w-full text-sm lg:text-base" cellspacing="0">
                                <thead>
                                <tr class="h-12 uppercase">
                                    <th class="text-left"></th>
                                    <th class="hidden md:table-cell"></th>
                                    <th class="text-left lg:text-right">
                                    <span class="hidden lg:inline text-primary">Quantity</span>
                                    </th>
                                    <th class="hidden text-right md:table-cell text-primary"> Price</th>
                                    <th class="hidden text-right md:table-cell text-primary"> Remove </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                <tr>
                                    <td>
                                        <a href="/product/{{ $item->id}}">
                                        <p class="mb-2 md:ml-4 text-primary font-bold">{{ $item->name }}</p>
                                        
                                        </a>
                                    </td>

                                    <td class="hidden pb-4 md:table-cell">
                                    <a href="/product/{{ $item->id}}">
                                        <img src="{{ $item->attributes->image }}" class="w-20 rounded" alt="Thumbnail">
                                    </a>
                                    </td>
                                    
                                    <td class="align-items-center justify-center mt-6 md:justify-end md:flex">
                                    <div class="h-10 w-28">
                                        <div class="relative flex flex-row w-full h-8">
                                        
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id}}" >
                                        <input type="text" name="quantity" value="{{ $item->quantity }}" class="w-16 text-center h-6 text-dark outline-none rounded border border-primary" />
                                        <button class="px-4 mt-1 py-1.5 text-sm rounded rounded shadow text-light bg-primary">Update</button>
                                        </form>
                                        </div>
                                    </div>
                                    </td>
                                    <td class="hidden text-right md:table-cell">
                                    <span class="fw-bold text-sm font-medium lg:text-base">
                                        AED {{ number_format($item->price, 2) }}
                                    </span>
                                    </td>
                                    <td class="hidden text-right md:table-cell">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="px-4 py-2 text-white bg-red-700 shadow rounded-2">x</button>
                                    </form>
                                    
                                    </td>
                                </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                            <div style="background-color: black" class="mt-5 display-block border rounded-3 p-3 text-light text-right align-items-right fw-bold">
                                TOTAL: AED {{ number_format(Cart::getTotal(), 2) }}
                            </div>
                            <div class="align-items-right text-right pt-4">
                                @csrf
                                <button class="px-6 py-2 text-sm rounded shadow text-light bg-primary">PAY</button>
                            </div>


                        </div>
                      </div>
                    </div>
              </div>
          </main>
    <!-- push additional js -->
    @push('script')

    @endpush
@endsection