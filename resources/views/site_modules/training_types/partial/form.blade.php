<fieldset class="fieldset-border">
    <legend class="legend-border">Details</legend>

    <div class="col-md-12 form-group">
        {{ html()->label('Title')->for('title') }} <span>*</span>

        {{ html()->text('title')->class('form-control')->placeholder('Title') }}

        @error('title')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Website Display Options</legend>

    <div class="row-auto">
        <div class="col-md-6 form-group">
            {{ html()->label('Display Order')->for('order') }} <span>*</span>

            {{ html()->number('order')->class('form-control') }}

            @error('order')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('Publish on website ?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'])->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
