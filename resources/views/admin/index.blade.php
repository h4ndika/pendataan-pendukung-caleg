@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ url('') }}/assets/vendor/toastify-js/src/toastify.css">
@endpush

@section('content')
@include('admin.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{config('app.name', 'Laravel')}}</h1>
    </div><!-- End Page Title -->

    <section class="section">

    </section>
</main>
@endsection

@push('script')
<script src="{{ url('') }}/assets/vendor/toastify-js/src/toastify.js"></script>
@endpush
