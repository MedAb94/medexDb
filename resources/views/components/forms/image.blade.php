<!--begin::Image input placeholder-->
<style>
    .image-input-placeholder {
        background-image: url({{asset('assets/media/avatars/blank.png')}})
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{asset('assets/media/avatars/blank.png')}})
    }
</style>
<!--end::Image input placeholder-->

<!--begin::Image input-->
<div {{$attributes->merge(['class'=>'image-input image-input-outline image_input'])}} >
    <!--begin::Image preview wrapper-->
    <div class="image-input-wrapper w-125px h-125px"
    {{isset($value)?'style=background-image:url('.$value.')':''}}
    >

    </div>
    <!--end::Image preview wrapper-->

    <!--begin::Edit button-->
    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
           data-kt-image-input-action="change"
           data-bs-toggle="tooltip"
           data-bs-dismiss="click"
           title="Modifier">
        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

        <!--begin::Inputs-->
        <input type="file" value="{{$value??''}}" name="{{$name??'avatar'}}" />
        <input type="hidden" name="avatar_remove" />
        <!--end::Inputs-->
    </label>
    <!--end::Edit button-->

    <!--begin::Cancel button-->

<span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
      data-kt-image-input-action="cancel"
      data-bs-toggle="tooltip"
      data-bs-dismiss="click"
      title="supprimer">
    <i class="ki-outline ki-cross fs-3"></i>
</span>
<!--end::Cancel button-->

<!--begin::Remove button-->
{{--    @if(isset($value))--}}
<span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
      data-kt-image-input-action="remove"
      data-bs-toggle="tooltip"
      data-bs-dismiss="click"
      title="Remove avatar">
    <i class="ki-outline ki-cross fs-3"></i>
</span>
{{--    @endif--}}
<!--end::Remove button-->
</div>
<!--end::Image input-->
