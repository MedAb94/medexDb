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
        <h4><x-icons.icon name="users"/> Utilisateurs </h4>
    </x-slot>
    <x-buttons.btn-add
        onclick="openInModal('{{ route('users.form-add')}}')"
        class="btn btn-primary">
        Ajouter
    </x-buttons.btn-add>

</x-header>
    <x-card class="bg-white">
        <x-dt
         id="dt"
         link="{{route('users.DT')}}"
         colonnes="name,email,actions"
        >
            <thead>
             <tr>
                 <th>Name</th>
                 <th>Email</th>
                 <th>actions</th>
             </tr>
            </thead>
        </x-dt>
    </x-card>

</x-default-layout>
