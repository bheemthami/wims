<div class="modal modal-danger fade" id="deleteModal">
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
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <a class="del-button">
                    {{ Html::form('DELETE', null)->id('delForm')->open() }}

                    {{ Html::submit('Yes, Delete')->class('btn btn-outline') }}

                    {{ Html::form()->close() }}
                </a>
            </div>
        </div>
    </div>
</div>
