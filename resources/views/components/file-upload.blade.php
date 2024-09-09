

@if( isset($is_image) && !$is_image )
<div class="card hover-elevate-up shadow-sm parent-hover my-4">
    <a href="#" class="">
        <div class="card-body d-flex align-items-center">
        <span class="svg-icon fs-1">
            <x-icons.icon name="file-upload" style="font-size: 21px;margin-inline-end: 10px"/>
        </span>

            <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
            <a @isset($url) target="_blank" @endisset href="{{$url??'#'}}">{{$name??''}}</a>
        </span>
        </div>
    </a>
</div>
@else
    <x-forms.image
     name="{{$name??''}}"
     value="{{$value??''}}"
    />
@endif

{{--<div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">--}}
{{--    <!--begin::Icon-->--}}
{{--    <i class="ki-duotone ki-devices-2 fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>        <!--end::Icon-->--}}

{{--    <!--begin::Wrapper-->--}}
{{--    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">--}}
{{--        <!--begin::Content-->--}}
{{--        <div class="mb-3 mb-md-0 fw-semibold">--}}
{{--            <h4 class="text-gray-900 fw-bold">Database Backup Process Completed!</h4>--}}

{{--            <div class="fs-6 text-gray-700 pe-7">Login into Admin Dashboard to make sure the data integrity is OK</div>--}}
{{--        </div>--}}
{{--        <!--end::Content-->--}}

{{--        <!--begin::Action-->--}}
{{--        <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap">--}}
{{--            Proceed            </a>--}}
{{--        <!--end::Action-->--}}
{{--    </div>--}}
{{--    <!--end::Wrapper-->--}}
{{--</div>--}}

