@extends('layouts.master') 
@section('title', 'Home')
@section('content')

    <div class="container-fluid p-5" align="center">
        @livewire('shop-grid-view')
    </div>

@endsection
