<x-modal>
    <x-slot name="title">
        Permissions role : <strong class="text-primary">{{$role->name}}</strong>
    </x-slot>
    <x-card id="rolePermissionForm">
        <form action="" id="permissionForm">
            <div class="row">
                <div class="col-md-12">
                    @foreach($permissions as $permission)
                        <div class="d-flex">
                            <!--begin::Checkbox-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3"
                                       name="permissions[]"
                                       type="checkbox"
                                       onchange="onPermissionCheck(this)"
                                       value="{{$permission->name}}"
                                       id="item_{{$permission->id}}"
                                       @if($role->hasPermissionTo($permission->name)) checked @endif
                                >
                                <label class="form-check-label" for="item_{{$permission->id}}">
                                    <div class="fw-bold text-black">{{$permission->description}}</div>
                                </label>
                            </div>

                        </div>
                        @if(!$loop->last)
                            <div class="separator separator-dashed my-5"></div>
                        @endif
                    @endforeach


                </div>
            </div>
        </form>
    </x-card>
    <div class="d-none d-flex justify-content-end" id="saveBtnCnt">
            <x-buttons.btn-edit
                onclick="savePermissions()"
                container="rolePermissionForm"
            >
                Enregistrer
            </x-buttons.btn-edit>
    </div>
</x-modal>
<script>
    function savePermissions() {
        let role_id = {{$role->id}};

        let url = "{{ route('roles.update_permissions')}}";
        let permissions = [];

        $('#permissionForm input[type=checkbox]').each(function () {
            if ($(this).is(':checked')) {
                permissions.push($(this).val());
            }
        });
        let data = {
            role_id,
            permissions,
        };
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function () {
                closeModal('second-modal');
                successAlert('Permissions modifiées avec succès');
                openInModal('{{ route('roles.get-permissions', $role->id) }}',null, 'second');
            }
        })
    }
    function onPermissionCheck(el) {
       $('#permissionForm input[type=checkbox]').each(function () {
           if ($(this).is(':checked')) {
               $('#saveBtnCnt').removeClass('d-none');
               return false;
           }
           $('#saveBtnCnt').addClass('d-none');
       });
    }

</script>
