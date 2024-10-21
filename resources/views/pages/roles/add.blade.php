<x-modal>
    <x-slot name="title">
        Ajouter un role
    </x-slot>
    <x-card id="rolesForm">
        <form action="{{route('roles.save')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="name"
                        label="Nom"
                        is-required
                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="description"
                        label="Description"
                        is-required
                    />
                </div>

            </div>
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-add
            onclick="addObjectDT({element:this})"
            container="rolesForm"
        >
            Enregistrer
        </x-buttons.btn-add>
    </x-slot>
</x-modal>

