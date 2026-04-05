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

        <div class="col-md-6 form-group">
            {{ html()->label('Year')->for('academic_year_id') }} <span>*</span>

            {{ html()->select('academic_year_id', $data['year_options'], $data['setting']->academic_year_id)->class('form-control') }}

            @error('academic_year_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('Post Category')->for('post_category_id') }} <span>*</span>
            {{ html()->select('post_category_id', $data['post_category_options'])->class('form-control') }}
            @error('post_category_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Summary')->for('summary') }}

            {{ html()->textarea('summary')->id('summary')->rows(2)->class('form-control')->placeholder('summary goes here...') }}

            @error('summary')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('Description')->for('description') }}

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
            @if (isset($post) && $post->image)
                <a href="{{ asset('uploads/posts/' . $post->image) }}" target="_blank">
                    <div class="img-wrapper">
                        <img class="img img-responsive" src="{{ asset('uploads/posts/' . $post->image) }}"
                            alt="No Image">
                    </div>
                </a>
            @else
                <span class="text-danger">No Attachment</span>
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

            @if (isset($post) && $post->attachment)
                <a class="btn btn-sm btn-success" href="{{ asset('uploads/posts/' . $post->attachment) }}">
                    <i class="fa fa-file"></i> view
                </a>
            @else
                <span class="text-danger">No Attachment</span>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Published on website</legend>

    <div class="col-md-4 form-group">
        {{ html()->label('Publish on website ?')->for('status') }} <span>*</span>

        {{ html()->select('status', $data['publish_options'])->class('form-control') }}

        @error('status')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-4 form-group">
        {{ html()->label('Show on modal ?')->for('show_on_modal') }} <span>*</span>

        {{ html()->select('show_on_modal', [1 => 'YES', 0 => 'NO'])->class('form-control') }}

        @error('show_on_modal')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-4 form-group">
        {{ html()->label('Publish Date')->for('date') }} <span>*</span>

        {{ html()->text('date')->id('published_date')->class('form-control') }}

        @error('date')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
</fieldset>
