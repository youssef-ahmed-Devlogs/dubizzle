@csrf

@if ($user->name)
    @method('PUT')
@endif

<div class="form-profile-avatar mb-4 text-center">
    <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ __('Enter name') }}" value="{{ old('name', $user->name) }}">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Email') }}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('Enter Email Address') }}" value="{{ old('email', $user->email) }}">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Phone Number') }}</label>
            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                placeholder="{{ __('Enter phone') }}" value="{{ old('phone_number', $user->phone_number) }}">

            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Role') }}</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror">
                <option value="user" @selected(old('role', $user->role) == 'user')>{{ __('User') }}</option>
                <option value="admin" @selected(old('role', $user->role) == 'admin')>{{ __('Admin') }}</option>
                <option value="super-admin" @selected(old('role', $user->role) == 'super-admin')>{{ __('Super Admin') }}</option>
            </select>

            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Password') }}</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('Enter user password') }}">

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Password Confirmation') }}</label>
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('Enter password confirmation') }}">

            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">{{ __('Change Avatar') }}</label>
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">

            @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        @if ($user->name)
            <button class="btn btn-success">{{ __('Update') }}</button>
        @else
            <button class="btn btn-primary">{{ __('Create') }}</button>
        @endif
    </div>
</div>
