<x-default-layout>
    @section('css')
        <style>
            span.select2-container {
                z-index:10050;
            }
        </style>
    @endsection
<x-header>
    <x-slot name="title">
        <h4><x-icons.icon :name="$model->icon??'list'"/>
            {!! $model->name !!} </h4>
    </x-slot>
    <x-buttons.btn-add
        onclick="openInModal('{{ route('objects.form-add',$model->id)}}')"
        class="btn btn-primary">
        {!! $model->add_title !!}
    </x-buttons.btn-add>

</x-header>
    <x-card class="bg-white">
        <x-dt
         id="dt"
         link="{{route('objects.DT',$model->id)}}"
         colonnes="name,actions"
        >
            <thead>
             <tr>
                 <th>Libelle</th>
                 <th>actions</th>
             </tr>
            </thead>
        </x-dt>
    </x-card>
</x-default-layout>
