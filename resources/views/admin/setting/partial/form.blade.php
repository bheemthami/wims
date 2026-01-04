<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ html()->label('Academic Year')->for('academic_year_id') }} <span>*</span>
            {{ html()->select('academic_year_id', $year_options)->class('form-control') }}
            @error('academic_year_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('Local Level')->for('municipality') }} <span>*</span>
            {{ html()->text('municipality')->class('form-control')->placeholder('Local Level') }}
            @error('municipality')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('Name')->for('office') }} <span>*</span>
            {{ html()->text('office')->class('form-control')->placeholder('Office') }}
            @error('office')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('Address')->for('office_address') }} <span>*</span>
            {{ html()->text('office_address')->class('form-control')->placeholder('Office Address') }}
            @error('office_address')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('Province Name')->for('province_name') }} <span>*</span>
            {{ html()->text('province_name')->class('form-control')->placeholder('Province Name') }}
            @error('province_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('District Name')->for('district_name') }} <span>*</span>
            {{ html()->text('district_name')->class('form-control')->placeholder('district') }}
            @error('district_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('Phone')->for('phone') }} <span>*</span>
            {{ html()->text('phone')->class('form-control')->placeholder('Phone') }}
            @error('phone')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('Email')->for('email') }} <span>*</span>
            {{ html()->email('email')->class('form-control')->placeholder('example@gmail.com') }}
            @error('email')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group">
            {{ html()->label('Logo')->for('logo') }}
            {{ html()->file('logo') }}
            @error('logo')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            @if (isset($setting) && $setting->logo)
                <div class="mt-1">
                    <img class="img-responsive" src="{{ asset('uploads/setting/' . $setting->logo) }}" height="100"
                        width="100" alt="LOGO">
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ html()->label('Website main Logo')->for('local_logo') }}
            {{ html()->file('local_logo') }}
            @error('local_logo')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            @if (isset($setting) && $setting->local_logo)
                <div class="mt-1">
                    <img class="img-responsive" src="{{ asset('uploads/setting/' . $setting->local_logo) }}"
                        height="100" width="100" alt="LOCAL LOGO">
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ html()->label('Favicon')->for('favicon') }}
            {{ html()->file('favicon') }}
            @error('favicon')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            @if (isset($setting) && $setting->favicon)
                <div class="mt-1">
                    <img class="img-responsive" src="{{ asset('uploads/setting/' . $setting->favicon) }}"
                        height="100" width="100" alt="FAVICON">
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ html()->label('System Name')->for('system_name') }} <span>*</span>
            {{ html()->text('system_name')->class('form-control')->placeholder('System Name') }}
            @error('system_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('System Short Name')->for('system_short_name') }} <span>*</span>
            {{ html()->text('system_short_name')->class('form-control')->placeholder('System Short Name') }}
            @error('system_short_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('Tag Line')->for('tag_line') }} <span>*</span>
            {{ html()->text('tag_line')->class('form-control')->placeholder('System Short Name') }}
            @error('tag_line')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

    </div>
</div>
