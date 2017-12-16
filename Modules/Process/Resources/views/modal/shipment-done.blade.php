<div class="modal fade" id="shipment-modal" tabindex="-1" role="dialog" aria-labelledby="shipment-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title">Shipment</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="shipmentId" id="shipment-id">
                <p>Confirm Shipment</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
                <button type="submit" class="btn btn-primary pull-right" onClick="bindCreateEvent()">Add</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function bindCreateEvent() {
        $.ajax({
            type: 'POST',
            url: '{{ URL::route('admin.process.shipment.shipped')}}',
            data: {
                shipmentId : $('#shipment-id').val(),
                shipment : 1,
                _token:$('meta[name="token"]').attr('value'),
            },
            success: function(data) {
//                toastr.success( data.message);
                $('#shipment-modal').modal('hide');
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                toastr.error('Error', xhr.message);
            }
        });
    }
</script>

