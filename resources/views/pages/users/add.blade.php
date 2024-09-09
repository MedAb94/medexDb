<x-modal>
    <x-slot name="title">
        Ajouter un utilisateur
    </x-slot>
    <x-card id="usersForm">
        <form action="{{route('users.save')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="name"
                        label="nom"
                        is-required
                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        type="text"
                        name="email"
                        label="email"
                        type="email"
                        is-required
                    />
                </div>
                <div class="col-md-6 mt-2">
                    <x-forms.select
                        type="text"
                        class="select_pk"
                        name="role"
                        label="Role"
                        data-dropdown-parent="#main-modal"
                        data-placeholder="selectionner"
                        is-required
                    >
                        <option></option>
                        @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->description}}</option>
                        @endforeach
                    </x-forms.select>
                </div>
                <div class="col-md-6 mt-2">
                    <x-forms.input
                        type="text"
                        name="password"
                        label="mot de passe"
                        type="password"
                    />
                </div>
                <div class="col-md-6 mt-2">
                    <x-forms.input
                        type="text"
                        name="password_confirmation"
                        label="confirmation mot de passe"
                        type="password"
                    />
                </div>
            </div>
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-add
            onclick="addObjectDT({
            element:this,
             successMsg:'utilisateur ajouté avec succès'
            })"
            container="usersForm"
        >
            Enregistrer
        </x-buttons.btn-add>
    </x-slot>
</x-modal>

