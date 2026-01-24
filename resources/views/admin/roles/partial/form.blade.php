<div class="form-group">
    {{ html()->label('Role')->for('name') }} <span>*</span>
    {{ html()->text('name')->class('form-control')->attribute('autofocus', true)->placeholder('Name') }}
    @error('name')
        <span class="text-danger"><i>{{ $message }}</i></span>
    @enderror
</div>
