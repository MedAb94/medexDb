<x-default-layout>
    <div class="card mt-4">
        <div class="card-header bg-primary flex justify-content-between">
            <h2 class="mt-6">Contacts</h2>
            <div>
                <button
                    onclick="openInModal('{{ route("contacts.create")}}')"
                    class="btn btn-success">
                    <i class="fa fa-add"></i>
                    Nouveau
                </button>
                <button
                    onclick="openInModal('{{ route("contacts.create")}}')"
                    class="btn btn-info btn-active-warning btn-outline-info">
                    <i class="fa fa-file-import"></i>
                    Importer
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="filters_form" method="post">
                <div id="filters_container">
                    <div class="my-2 row">
                        @csrf
                        <div class="col-md-6">
                            <x-forms.select
                                label="Pays"
                                icon="fa fa-filter"
                                class="select_pk"
                                name="country_id"
                                data-placeholder="Tous"
                                onchange="refreshDT()"
                                data-placeholder="Selectionnez"
                            >
                                <option value="0">Tous</option>
                                @foreach(\App\Models\Country::all() as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach

                            </x-forms.select>
                        </div>
                        <div class="col-md-6">
                            <x-forms.select
                                label="Type"
                                icon="fa fa-filter"
                                class="select_pk"
                                name="type_id"
                                data-placeholder="Tous"
                                onchange="refreshDT()"
                                data-placeholder="Selectionnez"
                            >
                                <option value="0">Tous</option>
                                @foreach(\App\Models\ContactType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach

                            </x-forms.select>
                        </div>
                    </div>
                </div>
            </form>

            <x-dt
                id="dt"
                link="{{route('contacts.dt')}}"
                colonnes="name,type_id,country_id,email,phones,website,actions"
                filters_form="filters_form"
                footer_callback="updateFooter"
            >
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Pays</th>
                    <th>Email</th>
                    <th>Phones</th>
                    <th>Siteweb</th>

                    <th style="min-width: 250px">Actions</th>
                </tr>
                </thead>
            </x-dt>

        </div>
    </div>
</x-default-layout>


