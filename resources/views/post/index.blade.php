@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Posts List
                    </div>
                    <div class="card-body">
                        {{-- <div class="mb-3">
                            <a href="{{ route('post.create') }}" class="btn btn-primary">Post Create</a>
                        </div> --}}

                        <div class="mb-3 d-flex justify-content-between">

                            <div class="">
                                <a href="{{ route('post.create') }}" class="btn btn-primary">
                                    Create Post
                                </a>
                                @isset(request()->search)
                                    <a href="{{ route('post.index') }}" class="btn btn-outline-primary mr-3">
                                        <i class="feather-list"></i>
                                        All Post
                                    </a>
                                    <span>Search By : " {{ request()->search }} "</span>
                                @endisset
                            </div>
                            <form method="get" class="w-25">
                                <div class="input-group ">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search Something">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        @if(session('status'))
                            <p class="alert alert-success">
                                {{ session('status') }}
                            </p>
                        @endif
                        <table class="table table-broder table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="w-25">Title</th>
                                <th>Is Pusblish</th>
                                <th>Category</th>
                                <th>Owner</th>
                                <th>Control</th>
                                <th>Created</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td class="small ">{{ Str::words($post->title,10,"...") }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{$post->is_publish ? 'checked' : ''}}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked"> {{$post->is_publish ? 'publish' : 'unpublish'}}</label>
                                        </div>
                                    </td>
                                    <td>{{$post->category->title ?? "Unknown Category"}}</td>
                                    <td>{{ $post->user->name ?? "Unknown User" }}</td>
                                    <td>
                                        <div class="btn-group">

                                            <a href="{{ route('post.show',$post->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-info fa-fw"></i>
                                            </a>

                                            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>

                                            <button class="btn btn-sm btn-outline-primary" form="PostDeleteForm{{ $post->id }}">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>

                                            <form action="{{ route('post.destroy',$post->id) }}" method="POST" id="PostDeleteForm{{ $post->id }}">
                                                @csrf
                                                @method('delete')

                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="small mb-0">
                                            <i class="fas fa-calendar"></i>
                                            {{ $post->created_at->format('Y-m-d') }} - <i class="fas fa-clock"></i> {{ $post->created_at->format('H:i a') }}
                                        </p>
                                        <p class="small mb-0">
                                            <i class="fas fa-user-clock"></i>
                                            {{ $post->created_at->diffForHumans() }}
                                        </p>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-primary"> There is no Category</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>

                       {{ $posts->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
