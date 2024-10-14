<x-default-layout>
    <div class="card mt-4">
        <div class="card-header bg-primary flex justify-content-between">
            <h2 class="mt-6">Stands</h2>
            <a
                class="btn btn-primary"
                href="{{route('stands.plan')}}"
                target="_blank"
            >
                <i class="fa fa-map-marker-alt"></i>
                Plan
            </a>
        </div>
        <div class="card-body">
            <form id="filters_form" method="post">
                <div id="filters_container">
                    <div class="my-2 row">
                        @csrf
                        <div class="col-md-4">
                            <x-forms.select
                                label="Categorie"
                                icon="fa fa-filter"
                                class="select_pk"
                                name="category_id"
                                data-placeholder="Tous"
                                onchange="refreshDT()"
                                data-placeholder="Selectionnez"
                            >
                                <option value="0">Tous</option>
                                @foreach(\App\Models\StandCategory::all() as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach

                            </x-forms.select>
                        </div>
                        <div class="col-md-4">
                            <x-forms.select
                                label="Reservation"
                                icon="fa fa-filter"
                                class="select_pk"
                                name="booking"
                                data-placeholder="Tous"
                                onchange="refreshDT()"
                                data-placeholder="Selectionnez"
                            >
                                <option value="9">Tous</option>
                                <option value="1">Reservé</option>
                                <option value="0">Libre</option>

                            </x-forms.select>
                        </div>
                        <div class="col-md-4">
                            <x-forms.select
                                label="Paiement"
                                icon="fa fa-filter"
                                class="select_pk"
                                name="payment"
                                data-placeholder="Tous"
                                onchange="refreshDT()"
                                data-placeholder="Selectionnez"
                            >
                                <option value="9">Tous</option>
                                <option value="1">Payé</option>
                                <option value="0">Impayé</option>

                            </x-forms.select>
                        </div>
                    </div>
                </div>
            </form>

            <x-dt
                id="dt"
                link="{{route('stands.dt')}}"
                colonnes="number,category_id,price,booked_for,paid_by,actions"
                filters_form="filters_form"
                footer_callback="updateFooter"
            >
                <thead>
                <tr>
                    <th>Numero</th>
                    <th>Categorie</th>
                    <th>Prix</th>
                    <th>Reservé pour</th>
                    <th>Payé par</th>
                    <th style="min-width: 250px">Actions</th>
                </tr>
                </thead>
            </x-dt>

        </div>
    </div>
</x-default-layout>


