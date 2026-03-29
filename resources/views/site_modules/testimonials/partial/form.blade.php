<fieldset class="fieldset-border">
    <legend class="legend-border">Details</legend>
    <div class="row-auto">
        <div class="col-md-12 form-group">
            {{ html()->label('Statement By')->for('statement_by') }} <span>*</span>
            {{ html()->text('statement_by')->class('form-control')->placeholder('name') }}
            @error('statement_by')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Recognition')->for('recognition') }} <span>*</span>
            {{ html()->text('recognition')->class('form-control')->placeholder('recognition') }}
            @error('recognition')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Statement')->for('statement') }} <span>*</span>
            {{ html()->textarea('statement')->id('statement')->class('form-control')->rows(2)->placeholder('statement goes here...') }}
            @error('statement')
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
            @if (isset($testimonial) && $testimonial->image)
                <div class="img-wrapper">
                    <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}" width="100">
                </div>
            @endif
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Remarks')->for('remarks') }}

            {{ html()->text('remarks')->class('form-control')->placeholder('name') }}

            @error('remarks')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
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
