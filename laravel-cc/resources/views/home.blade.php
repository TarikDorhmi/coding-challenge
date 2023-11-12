@extends('layouts.layout')

@section('content')
<h1 class="mb-4">Welcome to coding Challenge !</h1>
<p>You can pick the type of rendering wanted </p>
<div>
    <a href="{{ route('products') }}" class="btn btn-danger algin-right ">WEB</a>
    <a href="{{ route('products-spa') }}" class="btn btn-success algin-right ">SPA</a>
</div>
@endsection
