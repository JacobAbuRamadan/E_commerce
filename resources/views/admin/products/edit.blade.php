@extends('admin.master')

@section('title', 'Admin Dashboard')
@section('content')

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3  text-gray-800">{{ __('side.Edit Category') }}</h1>
        <a class="btn btn-outline-dark" href="{{ route('admin.categories.index') }}"> All Category</a>
    </div>


    <form action="{{ route('admin.categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label> Name </label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror  " placeholder="Name"
                value="{{ old('name' ,$category->name) }}">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


            <div class="mb-3">
                <label> image </label>
                <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror  "><img width="80" src="{{asset('uploads/images/categories/'.$category->image)}}" alt="">
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-3">
                <label> Parent </label>

                <select name="parent_id"
                    class="form-control @error('parent_id') is-invalid" @enderror">
                <option value=" " selected>-- Select --</option>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach

                </select>

            @error('parent_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror

          </div>

        <button class="btn btn-success btn-lg mt-4 px-5"> Add </button>

    </form>


@stop
