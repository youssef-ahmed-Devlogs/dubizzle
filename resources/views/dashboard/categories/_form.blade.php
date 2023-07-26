@csrf

@if ($category->name)
    @method('PUT')
@endif

<div class="form-profile-avatar mb-4 text-center">
    <img src="{{ $category->getCover() }}" alt="{{ $category->name }}">
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Enter user name" value="{{ old('name', $category->name) }}">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Parent</label>
            <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                <option value="">Without Parent</option>
                @foreach ($categories as $parent_category)
                    <option value="{{ $parent_category->id }}" @selected(old('parent_id', $category->parent_id) == $parent_category->id)>
                        {{ $parent_category->name }}
                    </option>
                @endforeach
            </select>

            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Order</label>
            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                placeholder="Enter category order" value="{{ old('order', $category->order) ?? 0 }}">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Change Cover</label>
            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror">

            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="" class="fw-bold">Description</label>

            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                placeholder="Enter category description" cols="30" rows="6">{{ old('description', $category->description) }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        @if ($category->name)
            <button class="btn btn-success">Update</button>
        @else
            <button class="btn btn-primary">Create</button>
        @endif
    </div>
</div>
