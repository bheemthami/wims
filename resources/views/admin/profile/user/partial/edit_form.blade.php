<div class="row">
    <div class="col-md-6 form-group">
        {{ html()->label('First Name')->for('first_name') }} <span>*</span>

        {{ html()->text('first_name')->class('form-control')->placeholder('Name') }}

        @error('first_name')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        {{ html()->label('Last Name')->for('last_name') }} <span>*</span>

        {{ html()->text('last_name')->class('form-control')->placeholder('Last Name') }}

        @error('last_name')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
</div>
