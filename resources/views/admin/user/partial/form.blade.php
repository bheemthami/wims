<div class="row-auto">
    <div class="form-group col-md-4">
        {{ html()->label('First Name')->for('first_name') }} <span>*</span>

        {{ html()->text('first_name')->class('form-control')->attribute('autofocus', true)->placeholder('first name') }}

        @error('first_name')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        {{ html()->label('Last Name')->for('last_name') }} <span>*</span>

        {{ html()->text('last_name')->class('form-control')->placeholder('last name') }}

        @error('last_name')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        {{ html()->label('Email')->for('email') }} <span>*</span>

        {{ html()->email('email')->class('form-control')->placeholder('Email')->disabled(isset($user)) }}

        @error('email')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
    @if (!isset($user))
        <div class="form-group col-md-4">
            {{ html()->label('Role')->for('role_id') }} <span>*</span>

            {{ html()->select('role_id', $roleOptions)->class('form-control') }}

            @error('role_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group col-md-4">
            {{ html()->label('Password')->for('password') }} <span>*</span>

            {{ html()->password('password')->class('form-control') }}

            @error('password')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group col-md-4">
            {{ html()->label('Confirm Password')->for('password_confirmation') }} <span>*</span>

            {{ html()->password('password_confirmation')->class('form-control') }}

            @error('password_confirmation')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    @endif
</div>
<div class="clearfix"></div>
