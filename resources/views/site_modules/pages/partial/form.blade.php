<fieldset class="fieldset-border">
    <legend class="legend-border">Page Details</legend>
    <div class="row-auto">
        <div class="col-md-12 form-group">
            {{ html()->label('Title')->for('title') }} <span>*</span>

            {{ html()->text('title')->class('form-control')->placeholder('Page Title') }}

            @error('title')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Summary')->for('summary') }} <span>*</span>

            {{ html()->textarea('summary')->id('summary')->rows(2)->class('form-control')->placeholder('summary goes here...') }}

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
            @if (isset($page) && $page->image)
                <a href="{{ asset('uploads/pages/' . $page->image) }}" target="_blank">
                    <div class="img-wrapper">
                        <img src="{{ asset('uploads/pages/' . $page->image) }}" alt="No Image">
                    </div>
                </a>
            @else
                <span class="text-danger">No Image</span>
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
            <br>
            @if (isset($page) && $page->attachment)
                <a class="btn btn-sm btn-success" href="{{ asset('uploads/pages/' . $page->attachment) }}"
                    target="_blank"><i class="fa fa-eye"></i> view
                    attachment</a>
            @else
                <span class="text-danger">No Attachment</span>
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
            {{ html()->label('Publish on Website ?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'])->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
