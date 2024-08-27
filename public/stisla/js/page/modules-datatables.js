"use strict";

$("[data-checkboxes]").each(function () {
    var me = $(this),
        group = me.data("checkboxes"),
        role = me.data("checkbox-role");

    me.change(function () {
        var all = $(
                '[data-checkboxes="' +
                    group +
                    '"]:not([data-checkbox-role="dad"])'
            ),
            checked = $(
                '[data-checkboxes="' +
                    group +
                    '"]:not([data-checkbox-role="dad"]):checked'
            ),
            dad = $(
                '[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'
            ),
            total = all.length,
            checked_length = checked.length;

        if (role == "dad") {
            if (me.is(":checked")) {
                all.prop("checked", true);
            } else {
                all.prop("checked", false);
            }
        } else {
            if (checked_length >= total) {
                dad.prop("checked", true);
            } else {
                dad.prop("checked", false);
            }
        }
    });
});

$("#table-1").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
    pageLength : 10,
   lengthMenu: [[5, 10, 20, -1], [7, 10, 20, 'Todos']]
});
$("#table-2").dataTable({
    columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
});
$("#table-request-cargo").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});
$("#table-request-crew").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-3").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
    pageLength : 7,
   lengthMenu: [[7, 10, 20, -1], [7, 10, 20, 'Todos']]
});

$("#table-4").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-5").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-6").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
    pageLength : 5,
   lengthMenu: [[5, 10, 20, -1], [8, 10, 20, 'Todos']]
});
$("#table-7").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-8").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
    pageLength : 10,
   lengthMenu: [[10, 20, -1], [5, 10, 20, 'Todos']]
});

$("#table-9").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-10").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-11").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-12").dataTable({
    columnDefs: [{ sortable: false, targets: [2, 3] }],
    pageLength : 10,
   lengthMenu: [[5, 10, 20, -1], [8, 10, 20, 'Todos']]
});

$("#table-13").dataTable({
   columnDefs: [{ sortable: false, targets: [2, 3] }],
   pageLength : 5,
   lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
});

$("#table-14").dataTable({
   columnDefs: [{ sortable: false, targets: [2, 3] }],
   pageLength : 5,
   lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
   searching: false,
   // bPaginate: false,
    bLengthChange: false,
    bFilter: true,
    bInfo: false,
    bAutoWidth: false 
});

$("#table-15").dataTable({
   columnDefs: [{ sortable: false, targets: [2, 3] }],
   pageLength : 5,
   lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
   searching: false,
   // bPaginate: false,
    bLengthChange: false,
    bFilter: true,
    bInfo: false,
    bAutoWidth: false 
});

$("#table-16").dataTable({
   columnDefs: [{ sortable: false, targets: [2, 3] }],
});

$("#table-17").dataTable({
   columnDefs: [{ sortable: false, targets: [2, 3] }],
   pageLength : 10,
   lengthMenu: [[10, 15, 20, -1], [5, 10, 15, 20, 'Todos']]
});
