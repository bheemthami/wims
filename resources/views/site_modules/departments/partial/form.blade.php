<fieldset class="fieldset-border">
    <legend class="legend-border">Details</legend>

    <div class="col-md-12 form-group">
        {{ html()->label('Title')->for('title') }} <span>*</span>

        {{ html()->text('title')->class('form-control')->placeholder('Title') }}

        @if ($errors)
            <span class="text-danger"><i>{{ $errors->first('title') }}</i></span>
        @endif
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Website Display Options</legend>

    <div class="row col-md-12">
        <div class="col-md-4 form-group">
            {{ html()->label('Display Order')->for('order') }} <span>*</span>

            {{ html()->number('order')->class('form-control') }}

            @if ($errors)
                <span class="text-danger"><i>{{ $errors->first('order') }}</i></span>
            @endif
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-4 form-group">
            {{ html()->label('Publish on website ?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'])->class('form-control') }}

            @if ($errors)
                <span class="text-danger"><i>{{ $errors->first('status') }}</i></span>
            @endif
        </div>
    </div>
</fieldset>
