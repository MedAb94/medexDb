<x-modal>
    <x-slot name="title">
        {!! $model->edit_title??"Modifier" !!} : <strong class="text-primary">{{$object->name}}</strong>
    </x-slot>
    <x-card id="ObjectsForm">
        <form action="{{route('objects.update')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="name"
                        value="{{$object->name}}"
                        label="libelle"
                        is-required

                    />
                </div>
            </div>
            <input type="hidden" name="model_id" value="{{$model->id}}">
            <input type="hidden" name="id" value="{{$object->id}}">
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-add
            onclick="addObjectDT({element:this,modal:'second-modal',successMsg:'Modification effectuée avec succès'})"
            container="ObjectsForm"
        >
            Enregistrer
        </x-buttons.btn-add>
    </x-slot>
</x-modal>

