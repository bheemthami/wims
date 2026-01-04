<fieldset class="fieldset-border">
    <legend class="legend-border">Details</legend>

    <div class="col-md-12 form-group">
        {{ html()->label('Title')->for('title') }} <span>*</span>

        {{ html()->text('title')->class('form-control')->placeholder('Title') }}

        @error('title')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('Summary (Max 400 characters)')->for('summary') }} <span>*</span>

        {{ html()->textarea('summary')->id('summary')->class('form-control')->rows(2)->placeholder('summary goes here...') }}

        @error('summary')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('Description (Max 10000 characters)')->for('description') }} <span>*</span>

        {{ html()->textarea('description')->id('editor')->class('form-control')->placeholder('description goes here...') }}

        @error('description')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('Images')->for('image') }} <span>*</span>

        {{ html()->file('image[]')->id('image')->multiple() }}

        @error('image.*')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror

        <span class="text-default">
            <p class="mt-10">
                <i>Files must be less than <strong>10 MB.</strong></i><br>
                <i>Allowed file types: <strong>png gif jpg jpeg.</strong></i>
            </p>
        </span>
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('Attachment')->for('attachment') }}

        {{ html()->file('attachment')->id('attachment')->class('form-control') }}

        @error('attachment')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror

        <span class="text-default">
            <p>
                <i>Files must be less than <strong>5 MB.</strong></i><br>
                <i>Allowed file types: <strong>doc, docx, xls, xlsx, pdf.</strong></i>
            </p>
        </span>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Website Display Options</legend>

    <div class="col-md-6 form-group">
        {{ html()->label('Display Order')->for('order') }} <span>*</span>

        {{ html()->number('order')->class('form-control') }}

        @error('order')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        {{ html()->label('Publish on website ?')->for('status') }} <span>*</span>

        {{ html()->select('status', $data['publish_options'], 1)->class('form-control') }}

        @error('status')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
</fieldset>
