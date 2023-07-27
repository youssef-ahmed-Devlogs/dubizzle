@extends('layouts.dashboard')

@section('title', "Update $ad->title ad")

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Update <strong>{{ $ad->title }}</strong> ad</h1>


    <div class="row">
        <div class="col-xl-6 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
                        @include('dashboard.ads._form')
                    </form>

                    <div class="mt-3">
                        @foreach ($ad->images as $image)
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $ad->title }}"
                                class="w-100 mb-2 rounded">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
