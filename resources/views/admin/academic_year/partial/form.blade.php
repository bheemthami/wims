<div class="row">
    <div class="col-md-12 form-group">
        {{ html()->label('Year')->for('year') }} <span>*</span>
        {{ html()->text('year')->class('form-control')->placeholder('Year')->autofocus() }}

        @error('year')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
</div>
