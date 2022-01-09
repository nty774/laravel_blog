@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Create Post
                    </div>
                    <div class="card-body">
                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row ">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="category_id">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" name="category">
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == old('category') ? 'selected' : '' }}>{{ $category->title }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="photoinput" class="form-label" >Photo</label>
                                    <input type="file" name="name[]" id="photoinput" class="form-control" value="{{ old('name') }}" multiple >
                                </div>



                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Description</label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">
                                        {{old('description')}}
                                    </textarea>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" required>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Confirm</label>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary"> Create Post</button>
                                    </div>
                                </div>

                            </div>

                            @error('title')
                            <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </form>






                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
