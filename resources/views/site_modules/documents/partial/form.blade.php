<fieldset class="fieldset-border">
    <legend class="legend-border">Document Details</legend>

    <div class="col-md-4 form-group">
        {{ html()->label('Academic Year')->for('academic_year_id') }} <span>*</span>

        {{ html()->select('academic_year_id', $data['year_options'])->class('form-control') }}

        @error('academic_year_id')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-4 form-group">
        {{ html()->label('Document Type')->for('document_type_id') }} <span>*</span>

        {{ html()->select('document_type_id', $data['document_type_options'])->class('form-control') }}

        @error('document_type_id')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-4 form-group">
        {{ html()->label('Date')->for('date') }} <span>*</span>

        {{ html()->text('date')->id('date')->class('form-control') }}

        @error('date')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('Title')->for('title') }} <span>*</span>

        {{ html()->text('title')->class('form-control')->placeholder('Document Title') }}

        @error('title')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('Summary')->for('summary') }}

        {{ html()->textarea('summary')->class('form-control')->rows(2)->placeholder('Summary goes here...') }}

        @error('summary')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-6 form-group">
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

        @if (isset($document) && $document->image)
            <div class="img img-wrapper">
                <img class="img img-responsive" src ="{{ asset('uploads/documents/' . $document->image) }}"
                    target="_blank" alt="No Image" />
            </div>
        @endif
    </div>

    <div class="col-md-6 form-group">
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
        @if (isset($document) && $document->attachment)
            <a class="btn btn-sm btn-success" href="{{ asset('uploads/documents/' . $document->attachment) }}"
                target="_blank">
                <i class="fa fa-file"></i> view
            </a>
        @endif
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
