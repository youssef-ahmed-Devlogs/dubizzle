@csrf

@if ($ad->title)
    @method('PUT')
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="Enter ad title" value="{{ old('title', $ad->title) }}">

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Description</label>

            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                placeholder="Enter ad description" cols="30" rows="5">{{ old('description', $ad->description) }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Categories</label>
            <select name="categories_ids[]" class="form-control @error('categories_ids[]') is-invalid @enderror"
                multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            @error('categories_ids[]')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter email" value="{{ old('email', $ad->user->email) }}">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Phone Number</label>
            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                placeholder="Enter phone" value="{{ old('phone_number', $ad->user->phone_number) }}">

            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Full Description</label>

            <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror"
                placeholder="Enter ad full description" cols="30" rows="8">{{ old('full_description', $ad->full_description) }}</textarea>

            @error('full_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Images</label>
            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple>

            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        @if ($ad->title)
            <button class="btn btn-success">Update</button>
        @else
            <button class="btn btn-primary">Create</button>
        @endif
    </div>
</div>
