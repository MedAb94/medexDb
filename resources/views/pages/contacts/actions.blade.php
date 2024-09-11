<div>
    <a class="btn btn-sm p-1"
       data-toggle="tooltip"
       data-placement="top"
       onclick="openInModal('{{ route('contacts.create', $contact->id) }}',null, 'main')"
    >
        <x-icons.action class="text-black" action="show"/>
    </a>
    <a class="btn btn-sm p-1"
       data-toggle="tooltip"
       data-placement="top"
       onclick="confirmActionDT({
        'url':'{{ route('contacts.delete', $contact->id) }}',
       'text':'Etes-vous sûr de vouloir supprimer ce contact ?',
       'method' : 'DELETE'

    })"
    >
        <x-icons.action class="text-danger" action="delete"/>
    </a>
</div>
