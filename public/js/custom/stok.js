const filter_from = document.getElementById("from");
const filter_to = document.getElementById("to");

filter_from.addEventListener("change", (e) => {
  let from = new Date(filter_from.value);
  let to = new Date(filter_to.value);

  if (!validate(from, to)) {
    to.setDate(from.getDate() + 6);
    filter_to.value = to.toISOString().slice(0, 10);
  }
});

filter_to.addEventListener("change", (e) => {
  let from = new Date(filter_from.value);
  let to = new Date(filter_to.value);

  if (!validate(from, to)) {
    from.setDate(to.getDate() - 6);
    filter_from.value = from.toISOString().slice(0, 10);
  }
});

function validate(from, to) {
  let range = (to - from) / (1000 * 60 * 60 * 24);
  if (range < 7) return true;

  alert("Rentang filter maksimal 7 hari!");
  return false;
}

("use strict");

var KTAppEcommerceReportViews = (function () {
  var table, dataTable;

  return {
    init: function () {
      // Inisialisasi tabel jika elemen ada
      table = document.querySelector("#table-stok");
      if (table) {
        dataTable = $(table).DataTable({
          info: false,
          order: [],
          pageLength: 10,
        });

        // Inisialisasi Export Button
        (function () {
          const reportTitle = "Product Views Report";
          new $.fn.dataTable.Buttons(table, {
            buttons: [
              { extend: "copyHtml5", title: reportTitle },
              { extend: "excelHtml5", title: reportTitle },
              { extend: "csvHtml5", title: reportTitle },
              { extend: "pdfHtml5", title: reportTitle },
            ],
          })
            .container()
            .appendTo($("#kt_ecommerce_report_views_export"));

          // Event untuk export menu
          document
            .querySelectorAll(
              "#kt_ecommerce_report_views_export_menu [data-kt-ecommerce-export]"
            )
            .forEach(function (element) {
              element.addEventListener("click", function (event) {
                event.preventDefault();
                const exportType = event.target.getAttribute(
                  "data-kt-ecommerce-export"
                );
                document
                  .querySelector(".dt-buttons .buttons-" + exportType)
                  .click();
              });
            });
        })();

        // Filter pencarian
        document
          .querySelector('[data-kt-ecommerce-order-filter="search"]')
          .addEventListener("keyup", function (event) {
            dataTable.search(event.target.value).draw();
          });

        // Filter berdasarkan rating
        (function () {
          const ratingFilter = document.querySelector(
            '[data-kt-ecommerce-order-filter="stokJenis"]'
          );
          $(ratingFilter).on("change", function (event) {
            let value = event.target.value;
            if (value === "all") value = "";
            dataTable.column(1).search(value).draw();
          });
        })();
      }
    },
  };
})();

// Inisialisasi saat DOM siap
KTUtil.onDOMContentLoaded(function () {
  KTAppEcommerceReportViews.init();
});
