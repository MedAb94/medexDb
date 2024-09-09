<div>
<a class="btn btn-sm p-1"
   data-toggle="tooltip"
   data-placement="top"
   onclick="openInModal('{{ route('users.form-edit', $user->id) }}',null, 'second')"
>
    <x-icons.action class="text-black" action="show"/>
</a>
<a class="btn btn-sm p-1"
   data-toggle="tooltip"
   data-placement="top"
    onclick="confirmActionDT({
        'url':'{{ route('users.delete', $user->id) }}',
       'text':'Etes-vous sûr de vouloir supprimer utilisateur ?',

    })"
>
    <x-icons.action class="text-danger" action="delete"/>
</a>
</div>
