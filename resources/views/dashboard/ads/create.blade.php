@extends('layouts.dashboard')

@section('title', 'Create a new ad')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Create a new ad</h1>


    <div class="row">
        <div class="col-xl-6 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.ads.store') }}" method="POST" enctype="multipart/form-data">
                        @include('dashboard.ads._form')
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
