@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Category List
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category</a>
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
                                    <th>Title</th>
                                    <th>Owner</th>
                                    <th>Control</th>
                                    <th>Created</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->user->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('category.destroy',$category->id) }}" method="POST" >
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt fa-fw"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="small mb-0">
                                            <i class="fas fa-calendar"></i>
                                            {{ $category->created_at->format('Y-m-d') }} - <i class="fas fa-clock"></i> {{ $category->created_at->format('H:i a') }}

                                        </p>
                                        <p>
                                            <i class="fas fa-user-clock"></i>
                                            {{ $category->created_at->diffForHumans() }}
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

                        {{ $categories->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
