@extends('layouts.master') 
@section('title', 'Home')
@section('content')
    <!-- push additional head elements to head -->
    @push('head')
        
    @endpush
    <div align="center">
        @livewire('shop-grid-view')
    </div>

    <!-- push additional js -->
    @push('script')

    @endpush
@endsection
