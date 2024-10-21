<x-modal>
    <x-slot name="title">
        Edit Global modal : <strong class="text-primary">{{$global->model}}</strong>
    </x-slot>
    <x-card id="globalesFormEdit">
        <form action="{{route('globals.update')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                <x-forms.input
                    is_required="true"
                    name='titre'
                    label="Titre"
                    placeholder="ex : Departments"
                    value="{{$global->name}}"
                    is-required

                />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        value="{{$global->model}}"
                        name="model"
                        label="model"
                        is-required

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        value="{{$global->url_prefix}}"
                        name="url_prefix"
                        label="url_prefix"
                        is-required

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        name="icon"
                        label="icon"
                        value="{{$global->icon}}"
                        placeholder="just pu icon name without fa-"

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        value="{{$global->add_title}}"
                        name="add_title"
                        label="add_title"

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        value="{{$global->edit_title}}"
                        name="edit_title"
                        label="edit_title"
                    />
                </div>
            </div>
            <input type="hidden" name="id" value="{{$global->id}}">
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-edit
            onclick="addObjectDT({element:this,modal:'second-modal'})"
            container="globalesFormEdit"
        >
            Enregistrer
        </x-buttons.btn-edit>
    </x-slot>
</x-modal>
<script>


</script>
