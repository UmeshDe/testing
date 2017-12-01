<div class="modal fade" id="location-modal" tabindex="-1" role="dialog" aria-labelledby="location-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title">Location</h3>
            </div>
            <div class="modal-body">
                <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name">City Name</label>
                    <input type="text" class="form-control" id="city-name"  name = "name" autofocus placeholder="Enter City Name" value="{{ old('name') }}">
                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">
                    <label for="type-location">Location</label>
                    <input type="text" class="form-control" id="type-location"  name = "location" autofocus placeholder="Enter Location" value="{{ old('location') }}">
                    {!! $errors->first('location', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('sublocation') ? ' has-error has-feedback' : '' }}">
                    <label for="type-sublocation">Sublocation</label>
                    <input type="text" class="form-control" id="type-sublocation"  name = "sublocation" autofocus placeholder="Enter Sublocation" value="{{ old('sublocation') }}">
                    {!! $errors->first('sublocation', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
                <button type="submit" class="btn btn-primary pull-right" onClick="bindCreateEvent()"><i class="glyphicon glyphicon-save"></i> {{ trans('core::core.button.create') }}</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function bindCreateEvent() {
        $.ajax({
            type: 'POST',
            url: '{{ URL::route('admin.admin.location.store')}}',
            data: {
                name : $('#city-name').val(),
                location : $('#type-location').val(),
                sublocation : $('#type-sublocation').val(),
                _token:$('meta[name="token"]').attr('value'),
            },
            success: function(data) {
                if(data.error == false){
                    $.each(data , function (i,item) {
                        $('#loading_location_id').append('<option value="' + item.id + '" selected>' + item.name + '-' + item.location + '-' + item.sublocation+ '<option>').trigger('change');
                        $('#unloading_location_id').append('<option value="' + item.id + '" selected>' + item.name + '-' + item.location + '-' + item.sublocation+ '<option>').trigger('change');
                    })
                    toastr.success( data.message,'Success');
                }
                else{
                    toastr.error('Error', data.message);
                }

                $('#location-modal').modal('hide');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                toastr.error('Error', xhr.message);
            }
        });
    }
</script>

