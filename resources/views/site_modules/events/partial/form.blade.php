<fieldset class="fieldset-border">
    <legend class="legend-border">Event Details</legend>
    <div class="fieldset-body">
        <div class="row">
            <div class="col-md-12 form-group">
                {{ html()->label('Title')->for('title') }} <span>*</span>

                {{ html()->text('title')->class('form-control')->placeholder('Title of the event') }}

                @error('title')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {{ html()->label('Start Date')->for('start_date') }} <span>*</span>

                <div class="form-group">
                    <div class="input-group date" id="start_date">
                        {{ html()->text('start_date')->id('start_date')->class('form-control') }}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                    @error('start_date')
                        <span class="text-danger"><i>{{ $message }}</i></span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        {{ html()->label('Start Time')->for('start_time') }} <span>*</span>

                        <div class="input-group">
                            {{ html()->text('start_time')->id('start_time')->class('form-control timepicker') }}
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>

                @error('start_time')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                {{ html()->label('End Date')->for('end_date') }} <span>*</span>

                <div class="form-group">
                    <div class="input-group date" id="end_date">
                        {{ html()->text('end_date')->id('end_date')->class('form-control') }}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                    @error('end_date')
                        <span class="text-danger"><i>{{ $message }}</i></span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        {{ html()->label('End Time')->for('end_time') }} <span>*</span>

                        <div class="input-group">
                            {{ html()->text('end_time')->id('end_time')->class('form-control timepicker') }}
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>

                @error('end_time')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                {{ html()->label('Description')->for('description') }} <span>*</span>

                {{ html()->textarea('description')->id('editor')->class('form-control')->placeholder('description goes here...') }}

                @error('description')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                @isset($event)
                    @if ($event->image)
                        <img src="{{ asset('uploads/events/' . $event->image) }}" width="100">
                    @else
                        <span class="text-danger">No Image</span>
                    @endif
                    <br>
                @endisset

                {{ html()->label('Image')->for('image') }}

                {{ html()->file('image')->id('image')->class('form-control') }}

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
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                @isset($event)
                    @if ($event->attachment)
                        <a href="{{ asset('uploads/events/' . $event->attachment) }}" target="_blank">
                            <i class="fa fa-file"></i> view
                        </a>
                    @else
                        <span class="text-danger">No Attachment</span>
                    @endif
                    <br>
                @endisset

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
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                {{ html()->label('Remarks')->for('remarks') }}

                {{ html()->text('remarks')->class('form-control')->placeholder('any other details') }}

                @error('remarks')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                {{ html()->label('Speaker of the event')->for('speaker') }}

                {{ html()->text('speaker')->class('form-control')->placeholder('Speaker of the event') }}

                @error('speaker')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Document Details</legend>
    <div class="fieldset-body">
        <div class="row">
            <div class="col-md-6 form-group">
                {{ html()->label('Publish on website ?')->for('status') }} <span>*</span>

                {{ html()->select('status', $data['publish_options'])->class('form-control') }}

                @error('status')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>
    </div>
</fieldset>
