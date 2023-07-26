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
            <label for="" class="fw-bold">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Enter user name" value="{{ old('name', $user->name) }}">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter user email" value="{{ old('email', $user->email) }}">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Phone Number</label>
            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                placeholder="Enter user phone" value="{{ old('phone_number', $user->phone_number) }}">

            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Role</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror">
                <option value="user" @selected(old('role', $user->role) == 'user')>User</option>
                <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                <option value="super-admin" @selected(old('role', $user->role) == 'super-admin')>Super Admin</option>
            </select>

            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter user password">

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Password Confirmation</label>
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="Enter password confirmation">

            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Change Avatar</label>
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">

            @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        @if ($user->name)
            <button class="btn btn-success">Update</button>
        @else
            <button class="btn btn-primary">Create</button>
        @endif
    </div>
</div>
