@extends('layouts.layout')

@section('content')
@if ($errors->any())

<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="d-flex justify-content-start mb-3">
    <a href="{{ route('products') }}" class="btn btn-secondary btn-sm algin-right ">back</a>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>

                <div class="card-body">
                    <form action="{{ route('products') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" id="name" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description:</label>
                            <textarea id="description" class="form-control" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Product Price:</label>
                            <input type="number" id="price" step="0.01" class="form-control" name="price">
                        </div>

                        <div class="form-group">
                            <label for="image">Product Image:</label>
                            <input type="file" id="image" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label for="categories" class="form-label">Categories</label>
                            <select class="form-control" id="categories" name="categories[]">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
