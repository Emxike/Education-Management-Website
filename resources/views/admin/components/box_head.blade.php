<div class="card-header py-3">
    @if(isset($title))
        <h6 class="m-0 font-weight-bold text-primary float-left">{{ $title }}</h6>
    @endif

   @if(isset($url) && $permission_screen->add_flg)
    <a href="{{route($url)}}" role="button"
       class="btn btn-primary btn-common text-center float-right">
        <span><i class="fa fa-plus"></i> Add</span>
    </a>
    @endif
</div>
