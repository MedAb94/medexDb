<x-modal>
    <x-slot name="title">
        {!! $model->add_title??"Ajouter" !!}
    </x-slot>
    <x-card id="ObjectsEditForm">
        <form action="{{route('objects.save')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input
                        is_required="true"
                        type="text"
                        name="name"
                        label="libelle"
                        is-required

                    />
                </div>
            </div>
            <input type="hidden" name="model_id" value="{{$model->id}}">

        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-add
            onclick="addObjectDT({element:this})"
            container="ObjectsEditForm"
        >
            Enregistrer
        </x-buttons.btn-add>
    </x-slot>
</x-modal>

