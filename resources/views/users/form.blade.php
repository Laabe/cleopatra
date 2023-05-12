<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus placeholder="Enter user name...">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') ?? $user->email }}" required autocomplete="email" placeholder="Enter user email...">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="admin" class="col-md-4 col-form-label text-md-end">{{ __('Administrator') }}</label>

    <div class="col-md-6">
        <select name="admin" id="is-admin" class="form-select">
            <option value="" selected disabled>Select an option</option>
            <option value="1" {{ $user->admin == true ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $user->admin != true ? 'selected' : '' }}>No</option>
        </select>

        @error('admin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
