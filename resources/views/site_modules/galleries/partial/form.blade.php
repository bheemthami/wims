<fieldset class="fieldset-border">
    <legend class="legend-border">Details</legend>
    <div class="row px-15">
        <div class="col-md-12 form-group">
            {{ html()->label('Title')->for('title') }} <span>*</span>

            {{ html()->text('title')->class('form-control')->placeholder('Title') }}

            @error('title')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Summary')->for('summary') }}

            {{ html()->textarea('summary')->id('summary')->class('form-control')->rows(2)->placeholder('summary goes here...') }}

            @error('summary')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('Year')->for('academic_year_id') }} <span>*</span>

            {{ html()->select('academic_year_id', $data['year_options'], $data['setting']->academic_year_id)->class('form-control') }}

            @error('academic_year_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('Type')->for('type') }} <span>*</span>

            {{ html()->select('type', $data['type_options'], 'image')->id('gallery_type')->class('form-control') }}

            @error('type')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>


        <div class="col-md-6 form-group">
            <div class="image-container">
                {{ html()->label('Image')->for('image') }}

                {{ html()->file('image[]')->id('image')->multiple() }}

                @error('image')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror

                <span class="text-default">
                    <p>
                        <i>Files must be less than <strong>10 MB.</strong></i><br>
                        <i>Allowed file types: <strong>png gif jpg jpeg.</strong></i>
                    </p>
                </span>
            </div>

            <div class="video-container">
                {{ html()->label('Video Link (if type is video)')->for('link') }} <span>*</span>

                {{ html()->text('link')->class('form-control')->placeholder('link') }}

                @error('link')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>
        <div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Published on website</legend>
    <div class="row px-15">
        <div class="col-md-6 form-groiup">
            {{ html()->label('Publish on Website ?')->for('status') }}

            {{ html()->select('status', $data['publish_options'], 0)->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6">
            {{ html()->label('Publish Date')->for('date') }}
            {{ html()->text('date')->id('published_date')->class('form-control') }}
            @error('date')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
