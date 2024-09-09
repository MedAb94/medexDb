<x-modal>
    <x-slot name="title">
        Role : <strong class="text-primary">{{$role->name}}</strong>
    </x-slot>
    <x-card id="roleEditForm">
        <form action="{{route('roles.update')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="name"
                        label="nom"
                        value="{{$role->name}}"
                        is-required

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="description"
                        label="nom"
                        value="{{$role->description}}"
                        is-required

                    />
                </div>

            </div>
            <input type="hidden" name="id" value="{{$role->id}}">
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-edit
            onclick="addObjectDT({element:this,modal:'second-modal',successMsg:'Role modifié avec succès'})"
            container="roleEditForm"
        >
            Enregistrer
        </x-buttons.btn-edit>
    </x-slot>
</x-modal>
<script>


</script>
