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
        <h4><x-icons.icon name="suitcase"/> Roles </h4>
    </x-slot>
    <x-buttons.btn-add
        onclick="openInModal('{{ route('roles.form-add')}}')"
        class="btn btn-primary">
        Ajouter
    </x-buttons.btn-add>

</x-header>
    <x-card class="bg-white">
        <x-dt
         id="dt"
         link="{{route('roles.DT')}}"
         colonnes="name,description,actions"
        >
            <thead>
             <tr>
                 <th>Name</th>
                 <th>Description</th>
                 <th>actions</th>
             </tr>
            </thead>
        </x-dt>
    </x-card>

</x-default-layout>
