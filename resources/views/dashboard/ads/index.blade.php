@extends('layouts.dashboard')

@section('title', __('Ads List'))

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Ads List') }}</h1>

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

        <a href="{{ route('dashboard.ads.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Debatable') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Created By') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($ads as $ad)
                        <tr>
                            <td>
                                <img src="{{ $ad->getCover() }}" alt="{{ $ad->title }}" class="table-image">
                            </td>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->title }}</td>
                            <td>{{ $ad->price }}</td>
                            <td>
                                @if ($ad->debatable)
                                    <div class="badge bg-success text-light">{{ __('Debatable') }}</div>
                                @else
                                    <div class="badge bg-warning text-dark">{{ __('Undebatable') }}</div>
                                @endif
                            </td>
                            <td>
                                @if ($ad->status == 'pending')
                                    <div class="badge bg-warning text-dark">{{ ucwords(__($ad->status)) }}</div>
                                @elseif ($ad->status == 'published')
                                    <div class="badge bg-primary text-light">{{ ucwords(__($ad->status)) }}</div>
                                @elseif ($ad->status == 'disabled')
                                    <div class="badge bg-danger text-light">{{ ucwords(__($ad->status)) }}</div>
                                @endif
                            </td>
                            <td>{{ $ad->user->name }}</td>
                            <td>{{ $ad->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('dashboard.ads.edit', $ad) }}"
                                    class="btn btn-sm btn-success">{{ __('Edit') }}</a>

                                <form action="{{ route('dashboard.ads.destroy', $ad) }}" method="POST"
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
        {{ $ads->links() }}
    </div>
@endsection
