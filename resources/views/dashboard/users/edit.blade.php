@extends('layouts.dashboard')

@section('title', "Update $user->name profile")

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Update <strong>{{ $user->name }}</strong> profile</h1>


    <div class="row">
        <div class="col-xl-6 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @include('dashboard.users._form')
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
