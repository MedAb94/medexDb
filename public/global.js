$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        // statusCode: {
        //     401: function (jqxhr, textStatus, errorThrown) {
        //         alert("Vous devez se connecter")
        //         window.location = "/login";
        //     }
        // }

    });
    // Customzing dataTable ajax errors
    $.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
        console.log(message);
        errorAlert("Une erreur est survenue , veuillez réessayer ou actualiser la page!");
    };
    resetJs();

});


loading_spinner = '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';

let select2_lang_config = {
    noResults: function () {
        return "Aucun résultat trouvé";
    },
    searching: function () {
        return "Recherche en cours...";
    },
    errorLoading: function () {
        return "Les résultats ne peuvent pas être chargés.";
    },
    inputTooShort: function (args) {
        var remainingChars = args.minimum - args.input.length;
        return "saissisez pour chercher";
    },

};
function openInModal(link, callback = null, modal = "main", size = "lg", is_static = false) {
    $.ajax({
        type: 'get',
        url: link,
        success: function (data) {
            $("#" + modal + "-modal .modal-dialog").addClass("modal-" + size);
            $("#" + modal + "-modal .modal-header-body").html(data);
            var myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById(modal + "-modal"), {
                backdrop: modal === "main" ? 'static' : true,
                keyboard: false
            });
            myModal.show();
            resetJs();


            // $("#" + modal + "-modal").modal();
            if (callback)
                callback();
        },
        error: function () {
            alert("Une erreur est survenue");
        }
    });
}


initDts();
init_select2();
init_select_ajax();
init_tagify();
init_date_pk();
// init_date_range();
init_input_image();

function saveForm(element, aftersave = null) {
    const container = $(element).attr('container');
    $('#' + container + ' #form-errors').hide();
    $(element).attr('disabled', 'disabled');
    $(element).attr("data-kt-indicator", "on");
    $('#' + container + ' .main-icon').hide();
    $('#' + container + ' .spinner-border').show();
    $.ajax({
        type: $('#' + container + ' form').attr("method"),
        url: $('#' + container + ' form').attr("action"),
        data: new FormData($('#' + container + ' form')[0]),
        cache: false,
        contentType: false,
        processData: false,
        // dataType: 'json',
        success: function (data) {
            $(element).removeAttr("data-kt-indicator");
            $(element).removeAttr('disabled');
            setTimeout(function () {
                $('#' + container + ' .answers-well-saved').hide();
                $('#' + container + ' .main-icon').show();
            }, 3500);
            if (aftersave) {
                aftersave(data);
            }
            $('#' + container + ' .is-invalid').each(function (index, item) {
                $(item).removeClass('is-invalid');
            });
            $('#' + container + ' .invalid-feedback').each(function (index, item) {
                $(item).remove();
            });
            $('#' + container + ' .select2-invalid-feedback').each(function (index, item) {
                $(item).remove();
            });
        },
        error: function (data) {
            $(element).removeAttr("data-kt-indicator");
            $(element).removeAttr('disabled');
            if (data.status === 422) {
                const errors = data.responseJSON;
                var errorsHtml = '<ul class="list-group">';
                const erreurs = (errors.errors) ? errors.errors : errors;

                $.each($('#' + container + ' form input'), function (key, item) {
                    let input = $(item);
                    if (!(input.attr('name') in erreurs)) {
                        input.next('.invalid-feedback').remove();
                        input.removeClass('is-invalid');
                    }
                });


                $.each(erreurs, function (key, value) {
                    const input = $(`#${container} .form-control[name=${key}]`);
                    if (input.attr('name') === key) {
                        if (input.hasClass('select_pk')) {
                            const span = $(`#${container} .form-control[name=${key}]`);
                            if (input.parent().parent().parent().hasClass('input-group')) {
                                span.parent().parent().parent('.select2-invalid-feedback').remove();
                                $(`<p class='select2-invalid-feedback'>${value}</p>`).insertAfter(input.parent().parent().parent());
                            } else {
                                span.next().next('.select2-invalid-feedback').remove();
                                $(`<p class='select2-invalid-feedback'>${value}</p>`).insertAfter(span.next());
                            }
                        } else {
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').remove();
                            $(`<p class='invalid-feedback'>${value}</p>`).insertAfter(input);
                        }
                    }
                });

                $('#' + container + ' .form-control').keyup(function () {
                    $(this).next('.invalid-feedback').remove();
                    $(this).removeClass('is-invalid');
                });

                $('#' + container + ' .select_pk').change(function () {
                    $(this).next().next('.select2-invalid-feedback').remove();
                    $(this).removeClass('select2-is-invalid');
                });

                $('#' + container + ' .select_pk').change(function () {
                    $(this).parent().parent().parent().next('.select2-invalid-feedback').remove();
                    $(this).removeClass('select2-is-invalid');
                });

                if (errors.errors) {
                    let form = $('#' + container + ' form');
                    $('#' + container).find('.alert-danger').remove();
                }
                $.each(erreurs, function (key, value) {
                    errorsHtml += '<li class="list-group-item list-group-item-danger">' + value + '</li>';
                });
                errorsHtml += '</ul>';
            } else {
                alert("Une erreur est survenue");
            }
            $(element).removeAttr("data-kt-indicator");
            $(element).removeAttr('disabled');
        }
    });
}

function setDataTable(element) {
    if (!$.fn.dataTable.isDataTable(element) && $(element).length) {
        var colonnes = [];
        var index = [];
        var target;
        var ordre;
        var search;
        var visibility = [];
        var showbtn = [];
        var paginate = true;
        var infoPaginate = true;
        var type = "get";

        if (typeof $(element).attr("export") !== 'undefined') {

            showbtn = ['colvis', 'csv', 'excel', 'pdf', 'print'];
        }
        if (typeof $(element).attr("index") !== 'undefined') {
            var lists = $(element).attr("index").split(',');
            for (var i = 0; i < lists.length; i++) {
                index.push(parseInt(lists[i]));
            }
        } else {
            index.push(-1);
        }
        if (typeof $(element).attr("hiddens") !== 'undefined') {
            var lists = $(element).attr("hiddens").split(',');
            for (var i = 0; i < lists.length; i++) {
                visibility.push(parseInt(lists[i]));
            }
        }
        var nbr = $(element).attr("nbr");
        if (typeof $(element).attr("nbr") !== 'undefined') {
            nbr = $(element).attr("nbr");
        } else {
            nbr = 10;
        }
        if (typeof $(element).attr("ordre") !== 'undefined') {
            ordre = $(element).attr("ordre");
        } else
            ordre = 'asc';
        if (typeof $(element).attr("search") !== 'undefined') {
            search = false;
        } else {
            search = true;
        }
        if (typeof $(element).attr("disblePanginate") !== 'undefined') {
            paginate = false;
            infoPaginate = false;
        }

        if (typeof $(element).attr("type") !== 'undefined') { // added and  modified by sidi and brahim
            type = "post";
        }

        var lists = $(element).attr("colonnes").split(',');
        for (var i = 0; i < lists.length; i++) {
            colonnes.push({
                'data': lists[i],
                'name': lists[i]
            });
        }
        target = 'targets:' + index;
        var dataSrcCallbackName = $(element).attr("footer_callback");
        var dataSrcCallback = window[dataSrcCallbackName];
        oTable = $(element).DataTable({
            oLanguage: {
                sUrl: window.location.origin + '/vendor/datatables/datatable-fr.json',
            },
            "processing": true,
            "serverSide": true,
            "orderCellsTop": true,
            "bDestroy": true,
            "cache": false,
            "searching": search,
            "pageLength": nbr,
            "iDisplayLength": nbr,
            "bPaginate": paginate,
            "bInfo": infoPaginate,
            "order": [[0, ordre]],
            "columnDefs": [{
                orderable: false,
                targets: index
            },
                {
                    searchable: false,
                    targets: index
                },
                {
                    visible: false,
                    targets: visibility
                }
            ],
            "ajax": {
                "url": $(element).attr("link"),
                type,
                data: function (d) {
                    if (typeof $(element).attr("filters_form") === 'undefined')
                        return
                    const form = $('#' + $(element).attr('filters_form'));
                    const formData = form.serializeArray();
                    $.each(formData, function (key, value) {
                        d[value.name] = value.value;
                    });
                }
            },
            "footerCallback": function (row, data, start, end, display) {
                if (typeof window[$(element).attr("footer_callback")] === 'function') {
                    window[$(element).attr("footer_callback")](this.api(), row, data, start, end, display);
                }
            },
            "columns": colonnes,
            "drawCallback": function () {
                $('[data-toggle="tooltip"]').tooltip();
            },
        })
    }
}


function init_date_pk(selector = ".date_pk") {
    $(selector).daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1950,
            autoApply: true,
            format: 'DD/MM/YYYY',
            locale: {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Appliquer",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "A",
                "customRangeLabel": "Custom",
                "weekLabel": "S",
                "daysOfWeek": [
                    "Di",
                    "Lu",
                    "Ma",
                    "Me",
                    "Je",
                    "Ve",
                    "Sa"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Aout",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Decembre"
                ],
                "firstDay": 1
            }
        },
    );

}

function init_input_image(selector = ".image_input") {
    new KTImageInput(document.querySelector(selector));
}

function resetJs() {
    initDts();
    init_date_pk();
    // init_date_range();
    init_input_image();
    init_select2();
    init_select_ajax();
    init_tagify();

}

init_select2();

function init_select2() {
    $('.select_pk').select2({
        // no data msg
        language: select2_lang_config,
    });
}

function init_drop_zone(selector = "#input_file") {
    new Dropzone(selector, {
        url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 10,
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        accept: function (file, done) {
            if (file.name == "wow.jpg") {
                done("Naha, you don't.");
            } else {
                done();
            }
        }
    });
}

function init_filePond({
                           selector = "#input_file",
                           placeholder_title = "Glissez et déposez le fichier ici",
                           acceptedFiles = ["image/*", "application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"],
                           validationMsg = "Fichier non valide",
                       }) {
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
    );

    var pond = FilePond.create(
        document.querySelector(selector), {
            labelIdle: `${placeholder_title} ou<span class="filepond--label-action"> Parcourir </span>`,
            storeAsFile: true,
            checkValidity: true,
            credits: false,
            labelFileTypeNotAllowed: validationMsg,
            fileValidateTypeLabelExpectedTypes: "",
            acceptedFileTypes: acceptedFiles,
        }
    );
    return pond;
}


function initDts() {
    if ($('#dt').length) setDataTable('#dt');
    if ($('.dt').length) setDataTable('.dt');
    for (let i = 1; i < 5; i++) {
        if ($('.dt' + i).length) setDataTable('.dt' + i);
    }
}

function successAlert(text = "Opération effectuée avec succès", confirmButtonText = "Ok") {
    Swal.fire({
        text,
        icon: "success",
        buttonsStyling: false,
        confirmButtonText,
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
}

function errorAlert(text = "Une erreur est survenue", confirmButtonText = "Ok") {
    Swal.fire({
        text,
        icon: "error",
        buttonsStyling: false,
        confirmButtonText,
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
}


function confirmAction({
                           text = "Etes-vous sûr de vouloir effectuer cette opération ?",
                           confirmButtonText = "Oui",
                           callback = null,
                           cancelButtonText = "Non",
                           icon = "warning"
                       }) {
    Swal.fire({
        text: text,
        icon,
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText,
        cancelButtonText,
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            if (callback) {
                callback();
            } else {
                successAlert("Opération effectuée avec succès");
            }
        }
    });
}

function confirmActionDT({
                             url,
                             method = 'get',
                             data = null,
                             dt = '#dt',
                             text = "Etes-vous sûr de vouloir effectuer cette opération ?",
                             confirmButtonText = "Oui",
                             cancelButtonText = "Non",
                             icon = "warning",
                             callback = null,
                             successMsg = "Opération effectuée avec succès",
                             errorCallBack = null
                         }) {

    confirmAction({
        text,
        confirmButtonText,
        cancelButtonText,
        icon,
        callback: function () {
            $.ajax({
                type: method,
                url: url,
                data,
                success: function (data) {
                    successAlert(successMsg);
                    $(dt).DataTable().ajax.reload();
                    if (callback) {
                        callback(data);
                    }
                },
                error: function (error) {
                    errorAlert(error.responseJSON.message);
                    if (errorCallBack)
                        errorCallBack(error);
                }
            });
        }
    });
}

// function to inject content in a container form ajax request
function injectHtml({url, container, method = 'get', data = null, successCallBack = null, errorCallBack}) {

    $(container).html(loading_spinner);
    $.ajax({
        url,
        method,
        data,
        success: function (data) {
            $(container).html(data);
            if (successCallBack)
                successCallBack(data);
            resetJs();
        },
        error: function (error) {
            if (errorCallBack)
                errorCallBack(error)
            else {
                errorAlert("Une erreur est survenue");
                $(container).html('');

            }
        }
    });
    return false;
}

function addObjectDT({
                         element,
                         dt = "#dt",
                         modal = 'main-modal',
                         successMsg = "Objet ajouté avec succès",
                         callback = null,
                     }) {
    saveForm(element, function (response) {
        closeModal(modal);
        $(dt).DataTable().ajax.reload();
        successAlert(successMsg);
        if (callback)
            callback(response);
    })
}

function closeModal(modal = 'main-modal') {
    var myModalEl = document.getElementById(modal)
     if (myModalEl.length === 0) {
         return;
     }
    bootstrap.Modal.getInstance(myModalEl).hide();
}

function init_date_range(selector = ".date_range", timePicker = false) {
    var format = "DD/MM/YYYY";
    var start_date = $(selector).attr('start');
    var end_date = $(selector).attr('end');
    // alert(start_date + " - " +end_date);
    if (timePicker)
        format = "DD/MM/YYYY HH:mm";

    $(selector).daterangepicker({
        format,
        "autoApply": true,
        'autoUpdateInput': true,
        "separator": " - ",
        "applyLabel": "Appliquer",
        "cancelLabel": "Annuler",
        "fromLabel": "Du",
        "toLabel": "A",
        "startDate": start_date ? start_date : moment().subtract(30, 'days'),
        "endDate": end_date ? end_date : moment(),
        "customRangeLabel": "Personnalisé",
        "daysOfWeek": [
            "Di",
            "Lu",
            'Ma',
            'Me',
            'Je',
            'Ve',
            'Sa'
        ],
        "monthNames": [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Decembre",

        ],

    });

    $(selector).on('apply.daterangepicker', function (ev, picker) {
        // console.log(format,picker.startDate.format(format) + ' - ' + picker.endDate.format(format));
        $(this).val(picker.startDate.format(format) + ' - ' + picker.endDate.format(format));
    });

    $(selector).on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
}

function refreshDT(dt = "#dt") {
    $(dt).DataTable().ajax.reload();
}

function init_select_ajax(selector='.select2-ajax') {
    const url = $(selector).attr('url');
    const title = $(selector).attr('title');
    const minlengthToSearch = $(selector).attr('length_to_Search')===undefined ? 3 : $(selector).attr('length_to_Search');
   const data_name =$(selector).attr('data_name')===undefined ? 'name' : $(selector).attr('data_name');
   let custom_data = $(selector).attr('custom_data')===undefined ? '{}' : $(selector).attr('custom_data');
   let data_id = $(selector).attr('data_id')===undefined ? 'id' : $(selector).attr('data_id');
   let method = $(selector).attr('method')===undefined ? 'get' : $(selector).attr('method');
   let form_selector = $(selector).attr('form_selector')===undefined ? null : $(selector).attr('form_selector');
   try {
        custom_data = JSON.parse(custom_data);
    } catch (error) {
        console.error('Error parsing custom_data:', error);
    }

    $(selector).select2({
        language: select2_lang_config,
        ajax: {
            url,
            type: method,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                let queryData = `q=${params.term}`;
                if (form_selector) {
                    const formData = $(form_selector).serializeArray();
                    formData.forEach(field => {
                        queryData += `&${field.name}=${field.value}`;
                    });
                }
                return queryData;
            },
            processResults: function (data, params) {
                let selectedPropertyId;

                params.page = params.page || 1;
                let resultObj = {};
                return {
                    results: $.map(data, function (item) {
                        if (data_id && data_id.includes('.')) {
                            const [objectKey, propertyName] = data_id.split('.');
                            selectedPropertyId = item[objectKey] ? item[objectKey][propertyName] : undefined;
                        } else {
                            selectedPropertyId = item[data_id];
                        }
                        for (let key in custom_data) {
                            if (custom_data.hasOwnProperty(key)) {
                                // Evaluate the value dynamically
                                resultObj[key] = eval(custom_data[key]);
                            }
                        }
                        if (Object.keys(resultObj).length > 0) {
                            return {
                                text: item[data_name],
                                id: selectedPropertyId,
                                ...resultObj,
                            };
                        } else {
                            return {
                                text: item[data_name],
                                id: selectedPropertyId,
                            };
                        }
                    }),

                };
            },
            cache: true
        },
        placeholder: title,
        minimumInputLength: minlengthToSearch,

    });

}
function init_tagify(selector='.input_tag'){
    if ($(selector).length === 0) {
        return;
    }
    let js_selector = document.querySelector(selector);
    let whitelist = $(selector).attr('whitelist')!==undefined ? $(selector).attr('whitelist').split(',') : [];
     // convert to array
    // let parseWhitelist = ;
    new Tagify((js_selector),{
        whitelist,
        dropdown: {
            enabled: 1,

        }
    });

}

