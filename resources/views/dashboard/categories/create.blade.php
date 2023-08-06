@extends('layouts.dashboard')

@section('title', __('Create a new category'))

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create a new category') }}</h1>


    <div class="row">
        <div class="col-xl-6 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @include('dashboard.categories._form')
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
