<h2 class="card-title text-center my-3">{{ trans('backpack::base.register') }}</h2>
<form role="form" method="POST" action="{{ route('backpack.auth.register') }}">
    @csrf

    <div class="row">
        <div class="col-6 mb-2">
            <label class="form-label" for="first_name">First Name</label>
            <input autofocus tabindex="1" type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old('first_name') }}">
            @if ($errors->has('first_name'))
                <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
            @endif
        </div>
        <div class="col-6 mb-2">
            <label class="form-label" for="last_name">Last Name</label>
            <input tabindex="2" type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" id="last_name" value="{{ old('last_name') }}">
            @if ($errors->has('last_name'))
                <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-2">
            <label class="form-label" for="{{ backpack_authentication_column() }}">{{ trans('backpack::base.'.strtolower(config('backpack.base.authentication_column_name'))) }}</label>
            <input tabindex="3" type="{{ backpack_authentication_column()==backpack_email_column()?'email':'text'}}" class="form-control {{ $errors->has(backpack_authentication_column()) ? 'is-invalid' : '' }}" name="{{ backpack_authentication_column() }}" id="{{ backpack_authentication_column() }}" value="{{ old(backpack_authentication_column()) }}">
            @if ($errors->has(backpack_authentication_column()))
                <div class="invalid-feedback">{{ $errors->first(backpack_authentication_column()) }}</div>
            @endif
        </div>
        <div class="col-6 mb-2">
            <label class="form-label" for="phone_number">Phone Number</label>
            <input tabindex="4" type="tel" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
            @if ($errors->has('phone_number'))
                <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-8 mb-2">
            <label class="form-label" for="address">Address</label>
            <input tabindex="5" type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" value="{{ old('address') }}">
            @if ($errors->has('address'))
                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
            @endif
        </div>
        <div class="col-4 mb-2">
            <label class="form-label" for="post_code">Post Code</label>
            <input tabindex="6" type="text" class="form-control {{ $errors->has('post_code') ? 'is-invalid' : '' }}" name="post_code" id="post_code" value="{{ old('post_code') }}">
            @if ($errors->has('post_code'))
                <div class="invalid-feedback">{{ $errors->first('post_code') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-2">
            <label class="form-label" for="password">{{ trans('backpack::base.password') }}</label>
            <input tabindex="7" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password" value="">
            @if ($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <div class="col-6 mb-2">
            <label class="form-label" for="password_confirmation">{{ trans('backpack::base.confirm_password') }}</label>
            <input tabindex="8" type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" value="">
            @if ($errors->has('password_confirmation'))
                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>
    </div>

    <div class="form-group mt-2">
        <button tabindex="9" type="submit" class="btn btn-primary w-100">
            {{ trans('backpack::base.register') }}
        </button>
    </div>
</form>
