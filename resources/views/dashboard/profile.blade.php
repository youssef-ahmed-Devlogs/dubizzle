@extends('layouts.dashboard')

@section('title', 'Profile')

@push('styles')
    <style>
        .ad-card {
            text-decoration: none !important;
            transition: 0.4s ease-in-out;
        }

        .ad-card:hover {
            translate: 0 -10px;
            box-shadow: 0px 6px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
        }

        .profile-header .profile-model {
            text-align: center;
            max-width: 200px;
            margin: 0 auto;
        }

        .profile-header .profile-avatar {
            position: relative;
        }

        .profile-header .profile-avatar,
        .profile-header .profile-avatar img {
            width: 200px;
            height: 200px;
        }

        .profile-header .profile-avatar img {
            object-fit: cover;
        }

        .profile-header .profile-avatar .online-status {
            background-color: #3fa933;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: block;
            position: absolute;
            left: 30px;
            bottom: 0;
        }

        .profile-header .profile-info {
            margin-top: 10px;
        }

        .profile-header .profile-info .profile-name {
            font-weight: bold;
            font-size: 30px
        }

        .profile-sec-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .profile-details {
            background-color: #fff;
            margin-top: 15px;
            border-radius: 8px;
            padding: 15px
        }

        .profile-details .main-info {
            margin: 0;
            line-height: 2;
        }

        .profile-ads {
            background-color: #fff;
            margin-top: 15px;
            border-radius: 8px;
            padding: 15px
        }

        .profile-ads .ad-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 5px;
        }

        .profile-ads .ad-card .card-title {
            font-size: 18px;
            text-decoration: none;
            color: #858796;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    <div class="profile-header">
        <div class="profile-model">
            <div class="profile-avatar">
                <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
                <span class="online-status"></span>
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ $user->name }}</div>
                <div class="profile-bio">
                    @if ($user->role === 'super-admin')
                        <div class="badge bg-primary text-light">{{ $user->role }}</div>
                    @elseif ($user->role === 'admin')
                        <div class="badge bg-info text-light">{{ $user->role }}</div>
                    @else
                        <div class="badge bg-secondary text-light">{{ $user->role }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="profile-details">
        <h2 class="profile-sec-title">Main Info</h2>

        <ul class="main-info">
            <li>
                Email: <Strong>{{ $user->email }}</Strong>
            </li>
            <li>
                Phone Number: <strong>{{ $user->phone_number }}</strong>
            </li>
        </ul>
    </div>

    <div class="profile-ads">
        <h2 class="profile-sec-title">Ads</h2>

        <div class="row">

            @forelse ($user->ads as $ad)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                    <a href="{{ route('dashboard.ads.edit', $ad) }}" class="card ad-card">
                        <img src="{{ $ad->getCover() }}" alt="{{ $ad->title }}">

                        <div class="card-body">
                            <h2 class="card-title">{{ $ad->title }}</h2>

                            <div class="d-flex align-items-center" style="gap: 5px">
                                @if ($ad->status == 'pending')
                                    <div class="badge bg-warning text-dark">{{ $ad->status }}</div>
                                @elseif ($ad->status == 'published')
                                    <div class="badge bg-primary text-light">{{ $ad->status }}</div>
                                @elseif ($ad->status == 'disabled')
                                    <div class="badge bg-danger text-light">{{ $ad->status }}</div>
                                @endif

                                @if ($ad->debatable)
                                    <div class="badge bg-success text-light">Debatable</div>
                                @else
                                    <div class="badge bg-warning text-dark">Undebatable</div>
                                @endif
                            </div>


                        </div>
                    </a>
                </div>

            @empty
                <div class="col-12">
                    <p>This profile has no ads</p>
                </div>
            @endforelse

        </div>
    </div>
@endsection
