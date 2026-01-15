<fieldset class="fieldset-border">
    <legend class="legend-border">Details</legend>
    <div class="row-auto">
        <div class="col-md-12 form-group">
            {{ html()->label('Title')->for('title') }} <span>*</span>

            {{ html()->text('title')->class('form-control')->placeholder('Title') }}

            @error('title')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Image')->for('image') }}
            {{ html()->file('image')->id('image') }}
            @error('image')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            <span class="text-default">
                <p>
                    <i>Files must be less than <strong>5 MB.</strong></i><br>
                    <i>Allowed file types: <strong>png gif jpg jpeg.</strong></i>
                </p>
            </span>
            @if (isset($training_category) && $training_category->image)
                <div class="img-wrapper">
                    <img src="{{ asset('uploads/training_categories/' . $training_category->image) }}" width="100">
                </div>
            @endif
        </div>
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
