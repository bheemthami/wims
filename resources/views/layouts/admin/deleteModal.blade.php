<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
            </div>
            <div class="modal-body">
                Are You Sure to Delete ?
            </div>
            <div class="modal-footer">
                <div class="form-inline">
                    <div class="form-group">
                        <a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a>
                    </div>
                    <div class="form-group">
                        <a class="del-button">
                            {!! Form::open(['method' => 'DELETE', 'id' => 'delForm']) !!}
                            <button type="submit" class="btn btn-primary">Yes, Delete</button>
                            {!! Form::close() !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
