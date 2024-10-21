<div>
<a class="btn btn-icon btn-success btn-sm"
   data-toggle="tooltip"
   data-placement="top"
   onclick="openInModal('{{ route('objects.form-edit', [$model->id,$object->id]) }}',null, 'second')"
>
    <x-icons.action action="show"/>
</a>
<a class="btn btn-icon btn-danger btn-sm"
   data-toggle="tooltip"
   data-placement="top"
    onclick="confirmActionDT({
        'url':'{{ route('objects.delete',  [$model->id,$object->id]) }}',
       'text':'Etes-vous sûr de vouloir supprimer ?',

    })"
>
    <x-icons.action  action="delete"/>
</a>
</div>
