<x-modal>
    <x-slot name="title">
        Utilisateur : <strong class="text-primary">{{$user->name}}</strong>
    </x-slot>
    <x-card id="userEditForm">
        <form action="{{route('users.update')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="name"
                        label="nom"
                        value="{{$user->name}}"
                        is-required

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        type="text"
                        name="email"
                        label="email"
                        type="email"
                        value="{{$user->email}}"
                        is-required
                    />
                </div>
                <div class="col-md-6 mt-2">
                    <x-forms.select
                        type="text"
                        class="select_pk"
                        name="role"
                        label="Role"
                        data-placeholder="selectionner"
                        is-required
                    >
                        <option></option>
                        @foreach($roles as $role)
                            <option
                                @if($user->hasRole($role->name)) selected @endif
                                value="{{$role->name}}">{{$role->description}}</option>
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
            <input type="hidden" name="id" value="{{$user->id}}">
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-edit
            onclick="addObjectDT({element:this,modal:'second-modal',successMsg:'Utilisateur modifié avec succès'})"
            container="userEditForm"
        >
            Enregistrer
        </x-buttons.btn-edit>
    </x-slot>
</x-modal>
<script>


</script>
