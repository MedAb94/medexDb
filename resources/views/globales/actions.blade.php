<div>
<a class="btn btn-icon btn-success btn-sm"
   data-toggle="tooltip"
   data-placement="top"
   onclick="openInModal('{{ route('globals.form-edit', $model->id) }}',null, 'second')"
>
    <x-icons.action action="show"/>
</a>
    <a
        href="{{ route('objects.index', $model->url_prefix) }}"
        target="_blank"
        class="btn btn-icon btn-active-primary btn-sm"
   data-toggle="tooltip"
   data-placement="top"
       title="link"

>
    <x-icons.icon name="link"/>
</a>
<a class="btn btn-icon btn-danger btn-sm"
   data-toggle="tooltip"
   data-placement="top"
    onclick="confirmActionDT({
        'url':'{{ route('globals.delete', $model->id) }}',
       'text':'Etes-vous sûr de vouloir supprimer ce model ?',

    })"
>
    <x-icons.action action="delete"/>
</a>
</div>
