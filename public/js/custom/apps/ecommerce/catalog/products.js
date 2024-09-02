"use strict";

var KTAppEcommerceProducts = function () {
    var table, dataTableInstance;

    var initEventHandlers = () => {
        // Attach event listeners for delete buttons
        table.querySelectorAll('[data-kt-ecommerce-product-filter="delete_row"]').forEach((button) => {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                const row = event.target.closest("tr");
                const productName = row.querySelector('[data-kt-ecommerce-product-filter="product_name"]').innerText;

                Swal.fire({
                    text: "Are you sure you want to delete " + productName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + productName + "!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        }).then(function () {
                            dataTableInstance.row($(row)).remove().draw();
                        });
                    } else if (result.dismiss === "cancel") {
                        Swal.fire({
                            text: productName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        });
                    }
                });
            });
        });
    };

    return {
        init: function () {
            table = "#kt_ecommerce_products_table";
            dataTableInstance = new DataTable(table, {
                info: false,
                order: [],
                pageLength: 10,
                columnDefs: [
                    { render: DataTable.render.number(",", ".", 2), targets: 4 },
                    { orderable: false, targets: 0 },
                    { orderable: false, targets: 1 }
                ]
            });

            dataTableInstance.on("draw", function () {
                initEventHandlers();
            });

            document.querySelector('[data-kt-ecommerce-product-filter="search"]').addEventListener("keyup", function (event) {
                dataTableInstance.search(event.target.value).draw();
            });

            (function () {
                const statusFilter = document.querySelector('[data-kt-ecommerce-product-filter="filter_kategori"]');
                $(statusFilter).on("change", function (event) {
                    let value = event.target.value;
                    if (value === "lihat") value = "";
                    dataTableInstance.column(2).search(value).draw();
                });
            })();

            initEventHandlers();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceProducts.init();
});
