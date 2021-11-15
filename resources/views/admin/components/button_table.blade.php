@if($permission_screen->edit_flg)
<a href="{{ route($url.'.edit',['id' => $id]) }}"
   class="btn btn-sm btn-box btn-outline btn-primary">
    <i class="fas fa-edit text_white"></i>
</a>
@endif
@if($permission_screen->del_flg)
@if(empty($idea))
<button class="btn btn-sm btn-box btn-outline btn-danger" data-toggle="modal"
        data-target="#modalNotification" onclick="deleteCommon({{$id}})">
    <i class="fas fa-trash-alt text_white"></i>
</button>
@endif
@endif
