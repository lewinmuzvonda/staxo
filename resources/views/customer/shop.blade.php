@extends('layouts.master') 
@section('title', 'Home')
@section('content')
    <!-- push additional head elements to head -->
    @push('head')
        
    @endpush
    <div class="container-fluid p-5" align="center">
        @livewire('shop-grid-view')
    </div>

    <!-- push additional js -->
    @push('script')

    @endpush
@endsection
