@extends('layouts.app');
@section('content');
    <div class="d-flex align items-center justify-content-between">
        <h1 class="mb-0">List Product</h1>
        <a href="{{route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="align-middle">{{$product->title }}</td>
                    <td class="align-middle">{{$product->price }}</td>
                    <td class="align-middle">{{$product->product_code }}</td>
                    <td class="align-middle">{{$product->description }}</td>
                    <td>
                        <a href="{{route('products.edit',  $product->id)}}" class="btn btn-primary mr-3">Edit</a>
                        <form action="{{route('products.destroy', $product->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-secondary" type="submit"> Delete </button>
                        </form>
                    </td>
                </tr>
            @endforeach
       </tbody>
    </table>
@endsection;
