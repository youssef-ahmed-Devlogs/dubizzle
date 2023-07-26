@extends('layouts.dashboard')

@section('title', 'Categories List')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Categories List</h1>
    <div class="d-flex align-items-center justify-content-between my-2">
        <form class=" d-sm-inline-block form-inline mw-100">
            <div class="input-group">
                <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..."
                    value="{{ request()->get('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">Create</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Order</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                <img src="{{ $category->getCover() }}" alt="{{ $category->name }}" class="table-image">
                            </td>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if ($category->parent->name)
                                    {{ $category->parent->name }}
                                @else
                                    <div class="badge bg-primary text-light">Primary</div>
                                @endif
                            </td>
                            <td>{{ $category->order }}</td>
                            <td>{{ $category->createdBy->name }}</td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('dashboard.categories.edit', $category) }}"
                                    class="btn btn-sm btn-success">Edit</a>

                                <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-2">
        {{ $categories->links() }}
    </div>
@endsection
