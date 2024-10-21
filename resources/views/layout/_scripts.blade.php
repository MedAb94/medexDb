<script>
    function openInModal(link, aftersave = null, modal = "main", size = "lg") {
        $.ajax({
            type: 'get',
            url: link,
            success: function (data) {
                $("#" + modal + "-modal .modal-dialog").addClass("modal-" + size);
                $("#" + modal + "-modal .modal-header-body").html(data);
                var myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById(modal + "-modal"));
                myModal.show();


                // $("#" + modal + "-modal").modal();
                if (aftersave)
                    aftersave();
            },
            error: function (err) {
                console.log(err)
                alert("Une erreur est survenue");
            }
        });
    }

    $('.select2').select2({
        width: '100%',
        dropdownAutoWidth: true,
    });

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
                console.log(data);
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
                            if (input.hasClass('select2')) {
                                const span = $(`#${container} .form-control[name=${key}]`);
                                // span.addClass('select2-is-invalid');
                                span.next().next('.select2-invalid-feedback').remove();
                                $(`<p class='select2-invalid-feedback'>${value}</p>`).insertAfter(span.next());
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

                    $('#' + container + ' .select2').change(function () {
                        $(this).next().next('.select2-invalid-feedback').remove();
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
                    //$('#' + container + ' #form-errors').show().html(errorsHtml);
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
            oTable = $(element).DataTable({
                oLanguage: {
                    sUrl: '{{url("/")}}/' + "vendor/datatables/datatable-" + '{{app()->getLocale()}}' + ".json",
                },
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "orderCellsTop": true,
                "bDestroy": true,
                "cache": false,
                "searching": search,
                "pageLength": nbr,
                "iDisplayLength": nbr,
                //"ordering": false,
                "bPaginate": paginate,
                "bInfo": infoPaginate,
                "order": [[0, ordre]],
                //"aoColumnDefs": [{ "bVisible": false, "aTargets": visibility }],

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
                // "ajax": $(element).attr("link"),
                "ajax": {
                    "url": $(element).attr("link"),
                    type,
                    data: function (d) {
                        if (typeof $(element).attr("filtres") === 'undefined')
                            return
                        $('#' + $(element)
                            .attr('filtres') + ' .form-control')
                            .each(function (index, item) {
                                d[$(item).attr('name')] = $(item).val()
                            });
                    }
                }, // replaced by brahim and sidi
                "columns": colonnes,
                "drawCallback": function () {
                    // init tooltips
                    $('[data-toggle="tooltip"]').tooltip();
                },
                //dom: 'Blfrtip',
                // buttons:
                // showbtn
            })
        }
    }


    // date picker

</script>
