"use strict";

var KTAppEcommerceReportViews = (function () {
  var table, dataTable;

  return {
    init: function () {
      // Inisialisasi tabel jika elemen ada
      table = document.querySelector("#kt_ecommerce_report_views_table");
      if (table) {
        dataTable = $(table).DataTable({
          info: false,
          order: [],
          pageLength: 10,
        });

        // Inisialisasi Date Range Picker
        (function () {
          var startDate = moment().subtract(29, "days"),
            endDate = moment(),
            dateRangePicker = $("#kt_ecommerce_report_views_daterangepicker");

          function updateDateRange(start, end) {
            dateRangePicker.html(
              start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
            );
          }

          dateRangePicker.daterangepicker(
            {
              startDate: startDate,
              endDate: endDate,
              ranges: {
                Today: [moment(), moment()],
                Yesterday: [
                  moment().subtract(1, "days"),
                  moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                  moment().startOf("month"),
                  moment().endOf("month"),
                ],
                "Last Month": [
                  moment().subtract(1, "month").startOf("month"),
                  moment().subtract(1, "month").endOf("month"),
                ],
              },
            },
            updateDateRange
          );

          updateDateRange(startDate, endDate);
        })();

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
