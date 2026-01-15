<fieldset class="fieldset-border">
    <legend class="legend-border">Details</legend>
    <div>
        <div class="col-md-12 form-group">
            {{ html()->label('Title')->for('title') }} <span>*</span>
            {{ html()->text('title')->class('form-control')->placeholder('Title') }}
            @error('title')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('Quota')->for('quota') }} <span>*</span>
            {{ html()->text('quota')->class('form-control')->placeholder('quota') }}
            @error('quota')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('Duration')->for('duration') }} <span>*</span>
            {{ html()->text('duration')->class('form-control')->placeholder('duration') }}
            @error('duration')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('Eligibility')->for('eligibility') }} <span>*</span>
            {{ html()->text('eligibility')->class('form-control')->placeholder('eligibility') }}
            @error('eligibility')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Summary')->for('summary') }} <span>*</span>
            {{ html()->textarea('summary')->class('form-control')->rows(2)->placeholder('summary goes here...') }}
            @error('summary')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Description')->for('description') }} <span>*</span>
            {{ html()->textarea('description')->id('editor')->class('form-control')->placeholder('description goes here...') }}
            @error('description')
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
            @if (isset($program) && $program->image)
                <div class="img-wrapper">
                    <img src="{{ asset('uploads/programs/' . $program->image) }}" width="100">
                </div>
            @endif
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Attachment')->for('attachment') }}
            {{ html()->file('attachment')->id('attachment') }}
            @error('attachment')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            <span class="text-default">
                <p>
                    <i>Files must be less than <strong>5 MB.</strong></i><br>
                    <i>Allowed file types: <strong>doc, docx, xls, xlsx, pdf.</strong></i>
                </p>
            </span>

            @if (isset($program) && $program->attachment)
                <a href="{{ asset('uploads/programs/' . $program->attachment) }}" target="_blank">
                    <i class="fa fa-file"></i> view
                </a>
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
