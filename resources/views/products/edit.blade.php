@extends('layouts.app')

@section('content')
    <h1 class="mb-0">Edit Product</h1>

    <hr />

    <form action="{{ route('products.edit', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col">
                <input type="text" name='title' class="form-control" placeholder="Title" value="{{ $product->title }}">
            </div>
            <div class="col">
                <input type="text" name='price' class="form-control" placeholder="Price" value="{{ $product->price }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="text" name='product_code' class="form-control" placeholder="Product Code"
                    value="{{ $product->product_code }}">
            </div>
            <div class="col">
                <textarea class="form-control" name="description" placeholder="Description">{{ $product->description }}</textarea>
            </div>
        </div>

        <div class="row">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
