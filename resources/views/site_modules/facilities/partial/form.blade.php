<fieldset class="fieldset-border">
    <legend class="legend-border">Facility Details</legend>
    <div class="row m-0">
        <div class="col-md-12 form-group">
            {{ html()->label('Title')->for('title') }} <span>*</span>

            {{ html()->text('title')->class('form-control')->placeholder('Facility Title') }}

            @error('title')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Summary')->for('summary') }} <span>*</span>

            {{ html()->textarea('summary')->id('summary')->class('form-control')->placeholder('summary goes here...')->rows(3) }}

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

            {{ html()->file('image[]')->id('image')->multiple() }}

            @error('image')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            <span class="text-default">
                <p>
                    <i>Files must be less than <strong>5 MB.</strong></i><br>
                    <i>Allowed file types: <strong>png gif jpg jpeg.</strong></i>
                </p>
            </span>
        </div>
        @if (isset($facility))
            <div class="col-md-6 form-group">
                {{ html()->label('Uploaded Images') }}
                <div class="photos">
                    @forelse($facility->images as $img)
                        <div class="img-wrapper">
                            <a href="{{ asset('uploads/media/' . $img->image) }}" target="_blank">
                                <img class="img img-responsive" src="{{ asset('uploads/media/' . $img->image) }}">
                            </a>
                        </div>
                    @empty
                        <span class="text-danger">No Images</span>
                    @endforelse
                </div>
            </div>
        @endif

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
            @if (isset($facility) && $facility->attachment)
                <a href="{{ asset('uploads/facilities/' . $facility->attachment) }}" class="btn btn-success"
                    target="_blank">
                    <i class="fa fa-eye"></i> View
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

            {{ html()->number('order')->class('form-control')->placeholder('Display Order') }}

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
