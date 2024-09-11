<x-modal>
    <x-slot name="title">
        Création d'un contact
    </x-slot>
    <x-card id="accountsForm">
        <form action="{{route('contacts.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4 my-1">
                    <input type="hidden" name="id" value="{{$contact->id??null}}">
                    <x-forms.input
                        name="name"
                        label="Nom"
                        placeholder="Nom"
                        value="{{$contact->name??''}}"

                    >
                    </x-forms.input>
                </div>
                <div class="col-md-4 my-1">
                    <x-forms.select
                        name="type_id"
                        label="Type de contact"
                        data-dropdown-parent="#main-modal"
                    >
                        @foreach($types as $type)
                            <option value="{{$type->id}}"
                                    @if($contact && $contact->type_id == $type->id) selected @endif>{{$type->name}}</option>
                        @endforeach
                    </x-forms.select>
                </div>
                <div class="col-md-4 my-1">
                    <x-forms.select
                        name="country_id"
                        label="Pays"
                        data-dropdown-parent="#main-modal"
                    >
                        @foreach($countries as $country)
                            <option value="{{$country->id}}"
                                    @if($contact && $contact->country_id == $country->id) selected @endif>{{$country->name}}</option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="col-md-4 my-1">
                    <x-forms.input
                        name="address"
                        label="Adresse"
                        placeholder="Adresse"
                        value="{{$contact->address??''}}"
                    >
                    </x-forms.input>

                </div>
                <div class="col-md-4 my-1">
                    <x-forms.input
                        name="email"
                        label="Email"
                        placeholder="Email"
                        value="{{$contact->email??''}}"
                    >
                    </x-forms.input>

                </div>
                <div class="col-md-4 my-1">
                    <x-forms.input
                        name="website"
                        label="Siteweb"
                        placeholder="Siteweb"
                        value="{{$contact->website??''}}"
                    >
                    </x-forms.input>

                </div>
                <div class="col-md-4 my-1">
                    <x-forms.input
                        name="phone1"
                        label="Telephone 1"
                        placeholder="Telephone"
                        value="{{$contact->phone1??''}}"
                    >
                    </x-forms.input>
                </div>
                <div class="col-md-4 my-1">
                    <x-forms.input
                        name="phone2"
                        label="Telephone 2"
                        placeholder="Telephone"
                        value="{{$contact->phone2??''}}"

                    >
                    </x-forms.input>
                </div>
                <div class="col-md-4 my-1">
                    <x-forms.input
                        name="phone3"
                        label="Telephone 3"
                        placeholder="Telephone"
                        value="{{$contact->phone3??''}}"
                    >
                    </x-forms.input>
                </div>


            </div>
        </form>
    </x-card>
    <x-slot name="footer">
        <x-buttons.btn-add
            onclick="saveForm(this,function (data){
                const myModalEl = document.getElementById('main-modal');
                            const modal = bootstrap.Modal.getInstance(myModalEl);
                            modal.hide();
                             $('#dt').DataTable().ajax.reload();
                                Swal.fire(
                                    'Ajouté!',
                                    data.message,
                                    'success'
                                );
            })"
            container="accountsForm"
        >
            Enregistrer
        </x-buttons.btn-add>
    </x-slot>
</x-modal>
