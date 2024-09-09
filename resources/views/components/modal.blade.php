<div class="modal-header">
    <h3 class="modal-title">{{$title}}</h3>
    <div
        class="btn btn-icon btn-sm btn-active-light-primary ms-2"
        data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>

<div class="modal-body p-1">
    {{$slot}}
</div>
@if(isset($footer))
    <div class="modal-footer">
        {{$footer}}
    </div>
@endif

