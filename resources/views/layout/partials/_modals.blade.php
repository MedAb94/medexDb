@foreach (['main','first','second','third','fourth'] as $type_modal)
    <div id="{{$type_modal}}-modal"
         @if($loop->first)
             data-bs-backdrop="static"
         @endif
         class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header-body">
                </div>
            </div>
        </div>
    </div>
@endforeach
