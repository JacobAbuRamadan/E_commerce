@extends('admin.master')

@section('title', 'Admin Dashboard')
@section('content')

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3  text-gray-800">All Products</h1>
        <a class="btn btn-outline-dark" href="{{ route('admin.products.create') }}">Add New Product</a>
    </div>

    @if (session('msg'))
<div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
    {{session('msg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif

    <table class=" table table-hover table-striped table-bordered">
        <thead>
            <tr class="bg-dark text-white">
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category id</th>
                <th>Created At</th>
                <th>Actions</th>

            </tr>

        </thead>
        <tbody>

            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td> <img width="80" src="{{asset('uploads/images/products/'.$product->image)}}" alt=""> </td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->created_at ->diffForHumans() }}</td>
                    <td> <a class="btn btn-sm btn-primary" href="{{route('admin.categories.edit',$product->id)}}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{route('admin.products.destroy',$product->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure')"> <i class="fas fa-trash" ></i> </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="9"> No Data Found</td>
                </tr>
            @endforelse
        </tbody>

    </table>


@stop
