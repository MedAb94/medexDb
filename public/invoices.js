const medocAndSejourHeaders = `
    <tr>
        <th>Libellé</th>
        <th>Qty</th>
        <th>PU</th>
        <th>Total</th>
        <th>Medecin</th>
        <th>Action</th>
    </tr>`;

const ServiceHeaders = `
    <tr>
        <th>Libellé</th>
        <th>Qty</th>
        <th>PU</th>
        <th>Total</th>
        <th>Medecin</th>
        <th>Action</th>
    </tr>`;

let itemCounter = 0;
let itemCounterPos = 0;
let itemOrdonnanceCounter = 0;

$('#client_id_invoice').on('change', function () {
    $('#pcs').toggle($(this).val() !== '0');
});

$(document).on('change', '#client_id_invoice', function () {
    const client_id = $(this).val();

    if (client_id !== '' && client_id !== undefined) {
        $.ajax({
            url: `/clients/pcs/${client_id}`,
            type: 'GET',
            data: {
                client_id: client_id
            },
            success: function (data) {
                $('#client_id_invoice_div').removeClass('col-md-12').addClass('col-md-6');
                $('#pcs').show();

                let options = '<option value="">Sélectionner une PC</option>';

                data.forEach(pc => {
                    options += `<option value="${pc.id}">${pc.name}(${pc.rate}%)</option>`;
                });

                $('#pcs_id').html(options);
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    } else {
        $('#pcs').hide();
        $('#client_id_invoice').val(null);
        $('#pcs_id').val(null);
        $('#client_id_invoice_div').removeClass('col-md-6').addClass('col-md-12');
    }
});

// validate inputs
function validateInputs(isANewInvoice = true, isOrdonnance = false) {
    const clientInvoice = $('#client_id_invoice').val();
    const pcId = $('#pcs_id').val();
    const patientId = $('#patient_id').val();

    if (isANewInvoice) {
        if (patientId === '' || patientId === undefined) {
            displayError('Veuillez sélectionner un patient!');
            return false;
        }

        if (clientInvoice === '' || clientInvoice === undefined) {
            displayError('Veuillez sélectionner un client!');
            return false;
        }

        if (pcId === '' || pcId === undefined) {
            displayError('Veuillez sélectionner une prise en charge!');
            return false;
        }
    }

   if(!isOrdonnance) {
       // Check if the table has at least one row
       const selectedItems = $('.item-selected');
       if (selectedItems.length === 0) {
           displayError('Veuillez ajouter au moins un élément!');
           return false;
       }

       // Validate each selected item
       for (const item of selectedItems) {
           const row = $(item);
           const qtyInput = row.find('.qty');
           const priceInput = row.find('.price');
           const totalPriceInput = row.find('.total_price');
           const doctorInput = row.find('.doctor_id');

           if (!qtyInput.val() || qtyInput.val() === '0') {
               displayError('Veuillez entrer une quantité valide!');
               return false;
           }

           if (!priceInput.val() || priceInput.val() === '0') {
               displayError('Veuillez entrer un prix valide!');
               return false;
           }

           if (!totalPriceInput.val() || totalPriceInput.val() === '0') {
               displayError('Veuillez entrer un prix total valide!');
               return false;
           }
       }
   }

    return true;
}

function getItemsByType(type, rowNumber) {
    $.ajax({
        url: `/invoices/${type}/get-items`,
        method: 'GET',
        data: {
            type: type
        },
        success: function (data) {
            let options = '<option value="">Sélectionner</option>';

            data.forEach(item => {
                options += `<option value="${item.id}">${item.name ? item.name : item.first_name + ' ' + item.last_name}</option>`;
            });

            $(`#${type}${rowNumber}`).html(options);
        },
        error: function (error) {
            alert("Une erreur s'est produite lors de la récupération des données!");
            console.error('Error fetching items:', error);
        }
    });
}

function getDoctors(rowNumber) {
    $.ajax({
        url: `/invoices/get-doctors`,
        method: 'GET',
        success: function (data) {
            let options = '<option value="">Sélectionner</option>';

            data.forEach(item => {
                options += `<option value="${item.id}">${item.first_name + ' ' + item.last_name}</option>`;
            });

            $(`#medecin${rowNumber}`).html(options);
        },
        error: function (error) {
            alert("Une erreur s'est produite lors de la récupération des données!");
            console.error('Error fetching items:', error);
        }
    });
}

function displayError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message,
    });
}

function updateTotal() {
    const total = $('#total');
    total.val(0);

    $('.item-selected').each(function () {
        const row = $(this);
        const totalPrice = row.find('.total_price').val() || row.find('.price').val();
        total.val(Number(total.val()) + Number(totalPrice));
    });

    // hide the total div if the total is 0
    if (total.val() === '0') {
        total.val(0);
        $('#totalDiv').hide();
    }
}

// delete invoice
$("body").on('click', '.deleteInvoice', function (e) {
    e.preventDefault();

    let invoiceId = $(this).data("id");

    Swal.fire({
        title: 'Confirmez la suppression!',
        text: "Etes-vous sure de vouloir supprimer la facture ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirmez',
        cancelButtonText: 'Annulez'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: "/invoices/delete/" + invoiceId,
                success: function () {
                    $('#invoicesDT').DataTable().ajax.reload();
                    Swal.fire(
                        'Supprimé!',
                        'La facture a été supprimée avec succès.',
                        'success'
                    );
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            })
        }
    });
});

// remove row from table when I click on remove-tr button and update the total
$(document).on('click', '.remove-tr', function () {
    $(this).parents('tr').remove();
    updateTotal();
});

// get the selected item
$(document).on('change', '.items', function () {
    const item_id = $(this).val();
    const row = $(this).closest('tr');
    const qtyInput = row.find('.qty');
    row.find('.price');
    row.find('.total_price');
    const total = $('#total');

    // get the selected value of the type by the data-value attribute
    const typeItemSelected = $(this).attr('data-value');
    console.log(typeItemSelected);

    row.find('.qty').show().val(1);
    row.find('.price').show();
    row.find('.total_price').show();

    // Check if the row already has the class 'item-selected'
    if (item_id !== "" && item_id !== undefined) {
        console.log(typeItemSelected)
        const fetchData = new Promise((resolve, reject) => {
            $.ajax({
                url: `/invoices/${typeItemSelected}/get-items`,
                method: 'GET',
                data: {
                    type: typeItemSelected
                },
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });

        fetchData.then(data => {
            let itemSelected = false;

            data.forEach(item => {
                if (item.id === Number(item_id)) {

                    itemSelected = true;
                    row.addClass('item-selected');
                    row.find('.price').val(item.unit_price !== undefined ? item.unit_price : item.price);
                    row.find('.total_price').val(item.unit_price ? item.unit_price * qtyInput.val() : item.price * qtyInput.val());

                    updateTotal();

                    qtyInput.on('change', function () {
                        const qty = $(this).val();
                        const price = row.find('.price').val();

                        row.find('.total_price').val(qty * price);

                        updateTotal();
                    });

                    $('#totalDiv').show();
                }
            });

            if (!itemSelected) {
                displayError("Vous devez sélectionner un élément!");
            }

        }).catch(error => {
            console.error('Error fetching items:', error);
        });
    } else {
        row.removeClass('item-selected');
        row.find('.price').val('');
        row.find('.total_price').val('');

        // display error message
        displayError("Vous devez sélectionner un élément!");

        updateTotal();
    }
});

function getServicesRow(rowNumber) {
    const type = 'services';

    getItemsByType('services', rowNumber);
    getDoctors(rowNumber);

    return `<tr>
        <td>
            <select name="items[${type}][${rowNumber}][item_id]" class="form-control items" id="${type}${rowNumber}" style="width: 100px;" data-value="${type}" required></select>
        </td>
        <td>
            <input type="number" name="items[${type}][${rowNumber}][qty]" min="1" value="1"
                           class="form-control qty"/>
        </td>
        <td>
            <input type="number" name="items[${type}][${rowNumber}][price]" class="form-control price"
                           readonly="true"/>
        </td>
        <td>
            <input type="number" name="items[${type}][${rowNumber}][total_price]" class="form-control total_price"
                           readonly="true"/>
        </td>
        <td>
            <select name="items[${type}][${rowNumber}][doctor_id]" class="form-control items doctor_id" id="medecin${rowNumber}" style="width: 100px;" data-value="services" required>
            </select>
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-tr ">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>`
}

function getMedocAndSejoursRow(type, rowNumber) {
    getItemsByType(type, rowNumber);

    return `<tr>
        <td>
            <select name="items[${type}][${rowNumber}][item_id]" class="form-control items" id="${type}${rowNumber}" style="width: 100px;" data-value="${type}" required></select>
        </td>
        <td>
            <input type="number" name="items[${type}][${rowNumber}][qty]" min="1" value="1"
                           class="form-control qty"/>
        </td>
        <td>
            <input type="number" name="items[${type}][${rowNumber}][price]" class="form-control price"
                           readonly="true"/>
        </td>
        <td>
            <input type="number" name="items[${type}][${rowNumber}][total_price]" class="form-control total_price"
                           readonly="true"/>
        </td>
        <td>

        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-tr ">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>`
}

$(document).on('click', '#addMedocBtn', function (event) {
    const itemType = event.currentTarget.value;
    itemCounter++;
    $('#tableName').html("Produits");
    $('#tableHeaders').html(medocAndSejourHeaders);
    $('#tableBody').append(getMedocAndSejoursRow('medicaments', itemCounter));
    $('#dynamiqueTable').show();
});

$(document).on('click', '#addServiceBtn', function (event) {
    const itemType = event.currentTarget.value;
    itemCounter++;
    $('#tableName').html("services");
    $('#tableHeaders').html(ServiceHeaders);
    $('#tableBody').append(getServicesRow(itemCounter));
    $('#dynamiqueTable').show();
});

$(document).on('click', '#addSejourBtn', function (event) {
    const itemType = event.currentTarget.value;
    itemCounter++;
    $('#tableName').html("Sejours");
    $('#tableHeaders').html(medocAndSejourHeaders);
    $('#tableBody').append(getMedocAndSejoursRow('sejours', itemCounter));
    $('#dynamiqueTable').show();
});

// règlements

function addReglementRow() {
    const table = $('#dynamicReglementsTable tbody');
    let reglementCounter = table.find('tr').length;
    const row = $('<tr>');
    const cell1 = $('<td>').appendTo(row);
    const cell5 = $('<td>').appendTo(row);
    const cell2 = $('<td>').appendTo(row);
    const cell3 = $('<td>').appendTo(row);
    const cell4 = $('<td>').appendTo(row);

    cell3.html(`<input type='text' name='reglements[${reglementCounter}][justificatif]' class='form-control justificatif'>`);
    cell2.html(`<input type='number' name='reglements[${reglementCounter}][amount]' class='form-control amount' min="1">`);
     cell5.html(`<td class="account_select"></td>`)
    const selectElement = $(`
                <select
                data-dropdown-parent="#invoicesReglementsAddForm"
                onchange="getReglementAccounts(this,${reglementCounter})"
                data-placeholder="Selectionner"
                name="reglements[${reglementCounter}][payment_mode_id]"

              class="form-control select_pk  payment_mode_id"></select>
`);
    selectElement.append(`<option value=""></option>`);


    $.ajax({
        url: '/invoices/get-reglement-payment-options',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.warn('response', response)
            response.forEach(option => {
                selectElement.append(`<option value="${option.id}">${option.name}</option>`);
            });
            init_select2();
        },
        error: function (error) {
            console.error('Error fetching options from the server', error);
        }
    });

    cell1.html(selectElement);
    cell4.html(`
        <button onclick='deleteReglement(this)' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
    `);

    table.append(row);
}

function getReglementAccounts(el, counter) {
     // find nex td and append select
    if (parseInt($(el).val()) === 7) {
        $.ajax({
            url: "/accounts/get-all-accounts",
            success: function (data) {
                let accounts = data.accounts;
                console.log($(el).closest('tr').find('td:eq(1)'));
                console.log($(el).closest('tr').find('td'));
                console.log($(el).closest('td'));
                $(el).closest('tr').attr('has_account', 'true');
                $(el).closest('tr').find('td:eq(1)').html(`
                                <select
                                  class="select_pk form-control"
                                   data-placeholder="Selectionner"
                                   data-dropdown-parent="#invoicesReglementsAddForm"
                                   name='reglements[${counter}][account_id]'
                                   class='form-control'
                             >
                             <option value=""></option>
                          ${accounts.map(ac => `<option value="${ac.id}">${ac.name}(${ac.number})</option>`).join('')}

                            </select>
                            `);
                init_select2();
            }
        })

    }
    else {
        $(el).closest('tr').find('td:eq(1)').html('');
        $(el).closest('tr').removeAttr('has_account');
    }

}

function validateReglementInputs() {
    const rows = $('#dynamicReglementsTable tbody').find('tr');

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const rowElement = $(row);
        const justificatif = rowElement.find(`input[name="reglements[${i}][justificatif]"]`).val();
        const amount = rowElement.find(`input[name="reglements[${i}][amount]"]`).val();
        const mode = rowElement.find(`select[name="reglements[${i}][payment_mode_id]"]`).val();
        if (mode==='7'){
            const account = rowElement.find(`select[name="reglements[${i}][account_id]"]`).val();
            if (!account|| !amount || !mode) {
                displayError('Veuillez remplir tous les champs!');
                return false;
            }
        }

        if ( !amount || !mode) {
             // add red border to the select or input
            // rowElement.find(`select[name="reglements[${i}][payment_mode_id]"]`).css('border-color', 'red');
            displayError('Veuillez remplir tous les champs!');
            return false;
        }
    }

    return true;
}

function updateReglementsTotal() {
    const totalReglements = $('#reglementsTotal');
    const restToPay = $('#restToPay');
    const netToPay = $('#netToPay');

    let newTotal = 0;

    $('.amount').each(function () {
        const row = $(this);
        const amount = parseFloat(row.val()) || 0;
        newTotal += amount;
    });

    if (newTotal > parseFloat(netToPay.val())) {
        displayError("La somme des règlements ne peut pas dépasser le montant net à payer.");
        return;
    }

    //totalReglements.val(newTotal);
  //  restToPay.val(parseFloat(netToPay.val()) - newTotal);
}

$(document).on('change', '.amount', function () {
    updateReglementsTotal();
});

function deleteReglement(id) {
    event.preventDefault();

    const row = $(id).closest('tr');
    const inputValue = row.find('input').val();
    const selectValue = row.find('select').val();
    const reglementId = $(id).closest('tr').find('input[type="hidden"]').attr('data-value');

    if (inputValue !== '' || selectValue !== '') {
        Swal.fire({
            title: 'Confirmez la suppression!',
            text: "Etes-vous sure de vouloir supprimer ce règlement ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmez',
            cancelButtonText: 'Annulez'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/invoices/reglements/delete/" + reglementId,
                    success: function () {
                        row.remove();
                        updateReglementsTotal();
                        Swal.fire(
                            'Supprimé!',
                            'Le règlement a été supprimé avec succès.',
                            'success'
                        );
                        location.reload();
                    },
                    error: function (error) {
                        console.log('Error:', error);
                    }
                })
            }
        });
    } else {
        row.remove();
        updateReglementsTotal();
    }
}

$(document).on('click', '#deleteInvoiceLine', function (event) {
    const row = $(this).closest('tr');
    const invoiceLineId = row.attr('data-value');

    confirmAction({
        callback: function () {
            $.ajax({
                type: 'DELETE',
                url: `/invoices/lines/delete/${invoiceLineId}`,
                success: function () {
                    row.remove();
                    successAlert();
                    location.reload();
                },
            });
        }
    });
});

$(document).on('click', '#majorerBtn', function (event) {
    const invoiceId = $(this).attr('data-value');

    Swal.fire({
        title: 'Majorer la facture',
        html: `<input type="number" id="majoration" name="majoration" class="form-control" min="1" max="100" value="1">`,
        showCancelButton: true,
        confirmButtonText: 'Valider',
        cancelButtonText: 'Annulez',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const majoration = $('#majoration').val();
            return $.ajax({
                url: `/invoices/${invoiceId}/majorer`,
                method: 'POST',
                data: {
                    majoration
                },
                success: function (response) {
                    location.reload();
                },
                error: function (error) {
                    console.error('Error fetching options from the server', error);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
});

// minorer
$(document).on('click', '#minorerBtn', function (event) {
    const invoiceId = $(this).attr('data-value');

    Swal.fire({
        title: 'Minorer la facture',
        html: `<input type="number" id="minoration" name="minoration" class="form-control" min="1" max="100" value="1">`,
        showCancelButton: true,
        confirmButtonText: 'Valider',
        cancelButtonText: 'Annulez',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const minoration = $('#minoration').val();
            return $.ajax({
                url: `/invoices/${invoiceId}/minorer`,
                method: 'POST',
                data: {
                    minoration
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                },
                error: function (error) {
                    console.error('Error fetching options from the server', error);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
});

// POS
$(document).on('click', '#addMedocInPosBtn', function (event) {
    itemCounterPos++;
    $('#tableName').html("Produits & Services");
    $('#tableHeaders').html(medocAndSejourHeaders);
    $('#tableBody').append(getMedocAndSejoursRow('medicaments', itemCounterPos));
    $('#dynamiquePosTable').show();
});

$(document).on('click', '#addServiceInPosBtn', function (event) {
    itemCounterPos++;
    $('#tableName').html("Produits & Services");
    $('#tableHeaders').html(ServiceHeaders);
    $('#tableBody').append(getServicesRow(itemCounterPos));
    $('#dynamiquePosTable').show();
});

$(document).on('change', '#posFormAdd form #patient_id', function () {
    const patientId = $(this).val();

    $.ajax({
        url: `/patients/${patientId}/get`,
        method: 'GET',
        success: function (response) {
            console.log(response)
            $('#patient_name').text(response.first_name + ' ' + response.last_name + ' - ' + response.matricule);
        },
        error: function (error) {
            console.error('Error fetching patient from the server', error);
        }
    });
});

// ordonnances js
$(document).on('click', '#addOrdonnanceMedocBtn', function (event) {
    itemOrdonnanceCounter++;
    $('#tableOrdonnanceName').html("Produits");
    $('#tableOrdonnanceHeaders').html(medocAndSejourHeaders);
    $('#tableOrdonnanceBody').append(getMedocAndSejoursRow('medicaments', itemOrdonnanceCounter));
    $('#dynamiqueOrdonnanceTable').show();
});

$(document).on('click', '#addOrdonnanceServiceBtn', function (event) {
    itemOrdonnanceCounter++;
    $('#tableOrdonnanceName').html("Services");
    $('#tableOrdonnanceHeaders').html(ServiceHeaders);
    $('#tableOrdonnanceBody').append(getServicesRow(itemOrdonnanceCounter));
    $('#dynamiqueOrdonnanceTable').show();
});

$(document).on('click', '#addOrdonnanceAutreBtn', function (event) {
    itemOrdonnanceCounter++;
    $('#tableOrdonnanceName').html("Autres Produits");
    $('#tableOrdonnanceBody').append(`
        <tr>
              <input type="hidden" name="items[autres][${itemOrdonnanceCounter}][price]" value="0" class="form-control" required>
              <input type="hidden" name="items[autres][${itemOrdonnanceCounter}][qty]" value="0" class="form-control" required>
            <td rowspan="3">
                <input type="text" name="items[autres][${itemOrdonnanceCounter}][description]" class="form-control" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-tr ">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    `);

    $('#dynamiqueOrdonnanceTable').show();
});



