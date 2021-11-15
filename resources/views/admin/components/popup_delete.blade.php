<div class="modal fade" id="modalNotification" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form role="form" action="{{route($url)}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete {{ $type }}</h5>
                    <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="common_id">
                    <p>Are you sure to delete this {{ $type }}?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-close"></i> <span>Cancel</span>
                    </button>
                    <button type="submit" class="btn btn-outline btn-primary btn-sm">
                        <i class="fa fa-trash-o"></i> <span>Delete</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modalLock" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formLock" role="form" action="{{route($url)}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="titleConfirm" class="modal-title">Delete {{ $type }}</h5>
                    <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="lock_id">
                    <p id="lbText">Are you sure to delete this {{ $type }}?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-close"></i> <span>Cancel</span>
                    </button>
                    <button type="submit" class="btn btn-outline btn-primary btn-sm">
                        <i class="fa fa-trash-o"></i> <span id="btnLock">Delete</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
