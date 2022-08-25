@extends('admin.master')

@section('title', 'Admin Dashboard')
@section('content')

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3  text-gray-800">Edit Products</h1>
        <a class="btn btn-outline-dark" href="{{ route('admin.products.index') }}"> All Product</a>
    </div>


    <form action="{{ route('admin.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label> Name </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror  " placeholder="Name"
                value="{{ old('name' ,$product->name) }}">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


            <div class="mb-3">
                <label> image </label>
                <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror  "><img width="80" src="{{asset('uploads/images/categories/'.$product->image)}}" alt="">
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label> Description </label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror  " placeholder="description"
                    value="{{ old('description' ,$product->description) }}">
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label> Price </label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror  " placeholder="price"
                    value="{{ old('price',$product->price) }}">
                @error('price')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label> Quantity </label>
                <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror  " placeholder="quantity"
                    value="{{ old('quantity',$product->quantity) }}">
                @error('quantity')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label> Category </label>
                <select name="category_id"
                    class="form-control @error('category_id') is-invalid" @enderror">
                @foreach ($categories as $category)
                <option {{$product->category_id == $category->id  ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>


            {{-- @error('parent_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror --}}

          {{-- </div> --}}

        <button class="btn btn-success btn-lg mt-4 px-5"> Update </button>

    </form>


@stop
