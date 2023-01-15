@extends('layouts.master') 
@section('title', 'Order Cancelled')
@section('content')

            <main class="my-8">
              <div class="container px-6 mx-auto">
                  <div class="flex justify-center my-6">
                      <div class="border rounded-4 flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                        
                        <h3 style="color: black" class="text-3xl font-bold">Order Cancelled</h3>
                        <div class="flex-1">
                           
                            Your order wasn't processed.

                        </div>
                      </div>
                    </div>
              </div>
          </main>
    <!-- push additional js -->
    @push('script')

    @endpush
@endsection