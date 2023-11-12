@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-start mb-3">
    <a href="{{ route('application') }}" class="btn btn-secondary btn-sm algin-right ">Home</a>
</div>
<h2>Products</h2>
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary algin-right ">Create New Product</a>
</div>
<form class="mb-2" action="{{ route('products') }}">
    <select class="mr-3" name="category_id">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <select class="mr-3" name="sort">
        <option value="">None</option>
        <option value="price">price</option>
    </select>
    <select class="mr-3" name="order">
        <option value="asc">asc</option>
        <option value="desc">desc</option>
    </select>
    <button class="btn btn-secondary btn-sm" type="submit">Filter</button>
</form>

@if ($products->count())
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Categories</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>
                @foreach ($product->categories as $category)
                {{ $category->name }}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No products found.</p>
@endif

@endsection
