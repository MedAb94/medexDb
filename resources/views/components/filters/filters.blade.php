<!--begin::Menu wrapper-->
@php
$datatable = $attributes['datatable'] ?? null;
$onclick= 'refreshDT('. $datatable .')';
@endphp
<div class="m-0" {!! $attributes !!} @if(!isset($attributes['id'])) id="filters_container" @endif>
    <!--begin::Menu toggle-->
    <a href="#" class="btn btn-lg btn-success fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
        <i class="ki-duotone ki-filter fs-6 text-white me-1"><span class="path1"></span><span class="path2"></span></i>
        Filtrer
    </a>
    <!--end::Menu toggle-->

    <!--begin::Menu dropdown-->
    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">
        <!--begin::Header-->

        <div class="px-7 py-2">
{{--            <div class="fs-5 text-gray-900 fw-bold">options de filtrage</div>--}}
        </div>
        <!--end::Header-->
        <!--begin::Menu separator-->
        <div class="separator border-gray-200"></div>
        <!--end::Menu separator-->

        <!--begin::Form-->
        <div class="px-7 py-2">

         {!! $slot !!}
            <!--begin::Actions-->
            <div class="d-flex justify-content-end">
                <button
                    onclick="{{$onclick}}"
                    type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Réinitialiser</button>
                <button
                    onclick="{{$onclick}}"
                    type="button" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Appliquer</button>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Form-->
    </div>
    <!--end::Menu dropdown-->
</div>
<!--end::Menu wrapper-->
