@extends('layouts.dashboard')

@section('title', __('Categories List'))

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Categories List') }}</h1>
    <div class="d-flex align-items-center justify-content-between my-2">
        <form class=" d-sm-inline-block form-inline mw-100">
            <div class="input-group">
                <input type="text" name="search" class="form-control bg-light border-0 small"
                    placeholder="{{ __('Search for...') }}" value="{{ request()->get('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Parent') }}</th>
                        <th>{{ __('Category Order') }}</th>
                        <th>{{ __('Created By') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Actions') }}</th>
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
                                    <div class="badge bg-primary text-light">{{ __('Primary') }}</div>
                                @endif
                            </td>
                            <td>{{ $category->order }}</td>
                            <td>{{ $category->createdBy->name }}</td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('dashboard.categories.edit', $category) }}"
                                    class="btn btn-sm btn-success">{{ __('Edit') }}</a>

                                <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">{{ __('Empty') }}</td>
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
