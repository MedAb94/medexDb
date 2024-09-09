<x-modal>
    <x-slot name="title">
        Add global model
    </x-slot>
    <x-card id="globalesForm">
        <form action="{{route('globals.save')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        name='titre'
                        label="Titre"
                        placeholder="ex : Departments"
                        is-required

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        name="model"
                        label="model"
                        placeholder="ex: App\Models\Department"
                        is-required

                    />
                </div>
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        name="url_prefix"
                        label="url_prefix"
                        placeholder="link to add after globals ex: /departments (without /)"
                        is-required

                    />
                </div>
                <div class="col-md-6 mt-3">
                    <x-forms.input
                        name="icon"
                        label="icon"
                        placeholder="just pu icon name without fa-"

                    />
                </div>
                <div class="col-md-6 mt-3">
                    <x-forms.input
                        name="add_title"
                        placeholder="ex: add new department"
                        label="add_title"

                    />
                </div>
                <div class="col-md-6 mt-3">
                    <x-forms.input
                        name="edit_title"
                        placeholder="ex: edit department"
                        label="edit_title"
                    />
                </div>
            </div>
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-add
            onclick="addObjectDT({element:this})"
            container="globalesForm"
        >
            Enregistrer
        </x-buttons.btn-add>
    </x-slot>
</x-modal>
<script>


</script>
