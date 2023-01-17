@extends('layouts.master') 
@section('title', 'Home')
@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('content')
    
    <div class="container-fluid p-5" align="center">
        @livewire('shop-grid-view')
    </div>

@endsection

@push('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endpush
