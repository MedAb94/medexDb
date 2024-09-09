@switch($action)
    @case('add')
        <x-icons.icon {{ $attributes}} name="plus"/>
        @break
    @case('edit')
        <x-icons.icon {{ $attributes}} name="edit"/>
        @break
    @case('save')
        <x-icons.icon {{ $attributes}} name="save"/>
        @break
    @case('delete')
        <x-icons.icon {{ $attributes}} name="trash"/>
        @break
    @case('download')
        <x-icons.icon {{ $attributes}} name="download"/>
        @break
    @case('upload')
        <x-icons.icon {{ $attributes}} name="upload"/>
        @break
    @case('print')
        <x-icons.icon {{ $attributes}} name="print"/>
        @break
    @case('check')
        <x-icons.icon {{ $attributes}} name="check"/>
        @break
    @case('uncheck')
        <x-icons.icon {{ $attributes}} name="times"/>
        @break
    @case('pdf')
        <x-icons.icon {{ $attributes}} name="file-pdf"/>
    @case('show')
        <x-icons.icon {{ $attributes}} name="eye"/>
        @break
    @case('movment')
        <x-icons.icon {{ $attributes}} name="right-left"/>
        @break
    @case('refuse')
        <x-icons.icon {{ $attributes}} name="square-xmark"/>
        @break
@endswitch

