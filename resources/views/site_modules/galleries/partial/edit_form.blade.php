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

            {{ html()->text('type', $gallery->type)->id('gallery_type')->class('form-control')->attribute('readonly', true) }}

            @error('type')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        @if ($gallery->type === 'image')
            <div class="image-container">
                <div class="col-md-12 form-group">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gallery->images as $img)
                                <tr>
                                    <td>
                                        {{ html()->hidden("old_images[{$img->id}][id]", $img->id) }}
                                        <img src="{{ asset('uploads/galleries/' . $img->image) }}" width="80"
                                            alt="No image">
                                    </td>
                                    <td>
                                        {{ html()->text("old_images[{$img->id}][title]", $img->title)->class('form-control') }}
                                    </td>
                                    <td>
                                        {{ html()->number("old_images[{$img->id}][order]", $img->order)->class('form-control') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Not found!!!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <br>
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
            </div>
        @else
            <div class="row col-md-12">
                <div class="col-md-6 form-group">
                    {{ html()->label('Youtube video ID')->for('link') }}
                    {{ html()->text('link')->class('form-control')->placeholder('Title') }}
                    @error('link')
                        <span class="text-danger"><i>{{ $message }}</i></span>
                    @enderror
                </div>
            </div>
        @endif
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Published on website</legend>
    <div class="row px-15">
        <div class="col-md-6 form-group">
            {{ html()->label('Publish on Website ?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'], $gallery->status)->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('Publish Date')->for('date') }} <span>*</span>

            {{ html()->text('date')->id('published_date')->class('form-control') }}

            @error('date')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
