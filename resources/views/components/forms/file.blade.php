{{--<div {{$attributes->merge(['class'=>'dropzone'])}} >--}}
{{--    <div class="dz-message needsclick">--}}
{{--        <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>--}}
{{--        <div class="ms-4">--}}
{{--            <h3 class="fs-5 fw-bold text-gray-900 mb-1">{!! $label !!}</h3>--}}
{{--            @if(isset($subTitle))--}}
{{--                <span class="fs-7 fw-semibold text-gray-500">{!! $subTitle !!}</span>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group">
    @if(isset($label))
        <label class="@if(isset($isRequired)) required @endif fs-6 fw-semibold mb-2">
            {!! $label !!}
        </label> <br>
    @endif
    <input
        type="file"
        name="{{ $name??null }}"
        {{$attributes->merge(['class'=>'filepond form-control'])}}
    >
</div>
<script>
    var $pond_{{$name}} = init_filePond({
        selector: @json(isset($attributes['id'])?'#'.$attributes['id']:null)

    });
    @if(isset($attributes['src']))
    $pond_{{$name}}.addFile(@json($attributes['src']))
    @endif
</script>
