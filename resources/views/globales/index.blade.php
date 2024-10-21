<x-default-layout>
<x-header>
    <x-slot name="title">
        <h4><x-icons.icon name="cogs"/> global models </h4>
    </x-slot>
    <x-buttons.btn-add
        onclick="openInModal('{{ route('globals.form-add')}}')"
        class="btn btn-primary">
        Ajouter
    </x-buttons.btn-add>

</x-header>
    <x-card class="bg-white">
        <x-dt
         id="dt"
         link="{{ route('globals.dt')}}"
         colonnes="name,model,url_prefix,icon,add_title,edit_title,actions"
        >
            <thead>
             <tr>
                 <th>name</th>
                 <th>model</th>
                 <th>url_prefix</th>
                 <th>icon</th>
                 <th>add_title</th>
                 <th>edit_title</th>
                 <th>actions</th>
             </tr>
            </thead>
        </x-dt>
    </x-card>
</x-default-layout>
