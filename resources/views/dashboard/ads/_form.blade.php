@csrf

@if ($ad->title)
    @method('PUT')
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Title') }}</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="{{ __('Enter ad title') }}" value="{{ old('title', $ad->title) }}">

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Description') }}</label>

            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                placeholder="{{ __('Enter ad description') }}" cols="30" rows="5">{{ old('description', $ad->description) }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Categories') }}</label>
            <select name="categories_ids[]" class="form-control @error('categories_ids[]') is-invalid @enderror"
                multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(in_array($category->id, $ad_categories ?? []))>{{ $category->name }}</option>
                @endforeach
            </select>

            @error('categories_ids[]')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Email') }}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('Enter Email Address') }}" value="{{ old('email', $ad->user->email) }}">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Phone Number') }}</label>
            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                placeholder="{{ __('Enter phone') }}" value="{{ old('phone_number', $ad->user->phone_number) }}">

            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Full Description') }}</label>

            <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror"
                placeholder="{{ __('Enter ad full description') }}" cols="30" rows="8">{{ old('full_description', $ad->full_description) }}</textarea>

            @error('full_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Images') }}</label>
            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple>

            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Status') }}</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror">
                <option value="">{{ __('Select Status') }}</option>
                <option value="pending" @selected($ad->status == 'pending')>{{ ucwords(__('pending')) }}</option>
                <option value="published" @selected($ad->status == 'published')>{{ ucwords(__('published')) }}</option>
                <option value="disabled" @selected($ad->status == 'disabled')>{{ ucwords(__('disabled')) }}</option>
            </select>

            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Debatable') }}</label>
            <select name="debatable" class="form-control @error('debatable') is-invalid @enderror">
                <option value="">{{ __('Debatable') }}</option>
                <option value="1" @selected($ad->debatable == 1)>{{ __('Yes') }}</option>
                <option value="0" @selected($ad->debatable == 0)>{{ __('No') }}</option>
            </select>

            @error('debatable')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Price') }}</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                placeholder="{{ __('Enter ad price') }}" value="{{ old('price', $ad->price) }}">

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        @if ($ad->title)
            <button class="btn btn-success">{{ __('Update') }}</button>
        @else
            <button class="btn btn-primary">{{ __('Create') }}</button>
        @endif
    </div>
</div>
