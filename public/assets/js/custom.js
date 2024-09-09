function fireDeleteAction(route, datatableId) {
    Swal.fire({
        title: 'Confirmez la suppression!',
        text: "Etes-vous sure de vouloir supprimer cette element",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirmez',
        cancelButtonText: 'Annulez'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: route,
                success: function () {
                    $(datatableId).DataTable().ajax.reload();
                    Swal.fire(
                        'Supprimé!',
                        'Element supprimé avec succès.',
                        'success'
                    );
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            })
        }
    });
    // $.confirm({
    //     title: 'Confirmez la suppression!',
    //     content: 'Etes-vous sure de vouloir supprimer le produit ?',
    //     buttons: {
    //         confirm: {
    //             text: 'Confirmez',
    //             action: function () {
    //                 $.ajaxSetup({
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     }
    //                 });
    //                 $.ajax({
    //                     type: "DELETE",
    //                     url: route,
    //                     success: function () {
    //                         $(datatableId).DataTable().ajax.reload();
    //                     },
    //                     error: function (error) {
    //                         console.log('Error:', error);
    //                     }
    //                 })
    //             }
    //         },
    //         cancel: {
    //             text: 'Annulez',
    //             action: function () {}
    //         }
    //     }
    // });
}

function printInvoice(code) {
    /*alert(code)
    return*/
    let iframe = document.createElement("iframe");
    iframe.src = "/invoices/pdf/" + code;
    iframe.style.display = "none";
    document.body.appendChild(iframe);
    iframe.onload = function() {
        //
        iframe.contentWindow.print();
    };
}
function printObject(url) {
    let iframe = document.createElement("iframe");
    iframe.src = url;
    iframe.style.display = "none";
    document.body.appendChild(iframe);
    iframe.onload = function() {
        iframe.contentWindow.print();
    };
}
