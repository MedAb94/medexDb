<div class="btn-group">
<a class="btn btn-sm p-1"
   data-toggle="tooltip"
   data-placement="top"
    title="Afficher"
   onclick="openInModal('{{ route('roles.form-edit', $role->id) }}',null, 'second')"
>
    <x-icons.action class="text-black" action="show"/>
</a>
    <a class="btn btn-sm p-1"
   data-toggle="tooltip"
   data-placement="top"
    title="permissions"
   onclick="openInModal('{{ route('roles.get-permissions', $role->id) }}',null, 'second')"
>
    <x-icons.icon class="text-black" name="lock-open"/>
</a>
<a class="btn btn-sm p-1"
   data-toggle="tooltip"
   data-placement="top"
    title="supprimer"
    onclick="confirmActionDT({
        'url':'{{ route('roles.delete', $role->id) }}',
       'text':'Etes-vous sûr de vouloir supprimer utilisateur ?',

    })"
>
    <x-icons.action class="text-danger" action="delete"/>
</a>
</div>
