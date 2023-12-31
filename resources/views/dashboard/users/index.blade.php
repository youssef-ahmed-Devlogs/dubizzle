@extends('layouts.dashboard')

@section('title', __('Users List'))

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Users List') }}</h1>
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

        <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone Number') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}" class="table-image">
                            </td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>
                                @if ($user->role === 'super-admin')
                                    <div class="badge bg-primary text-light">
                                        {{ __(ucwords(str_replace('-', ' ', $user->role))) }}</div>
                                @elseif ($user->role === 'admin')
                                    <div class="badge bg-info text-light">
                                        {{ __(ucwords(str_replace('-', ' ', $user->role))) }}
                                    </div>
                                @else
                                    <div class="badge bg-secondary text-light">
                                        {{ __(ucwords(str_replace('-', ' ', $user->role))) }}</div>
                                @endif
                            </td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('dashboard.users.edit', $user) }}"
                                    class="btn btn-sm btn-success">{{ __('Edit') }}</a>

                                <form action="{{ route('dashboard.users.destroy', $user) }}" method="POST"
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
                            <td colspan="7" class="text-center">{{ __('Empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-2">
        {{ $users->links() }}
    </div>
@endsection
