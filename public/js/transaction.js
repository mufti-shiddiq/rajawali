
$(function () {
    var table = $('.cart-table').DataTable({
        processing: true,
        serverSide: true,
                
        ajax: "/transactions",
        columns: [

            { "data": null,"sortable": false, 
                render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }  
            },

            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'quantity', name: 'quantity'},
            {data: 'unit', name: 'unit'},
            {data: 'price', name: 'price', render: $.fn.dataTable.render.number('.', '.', 0, '')},
            {data: 'conditions', name: 'conditions', render: $.fn.dataTable.render.number('.', '.', 0, '')},
            {data: 'total', name: 'total', render: $.fn.dataTable.render.number('.', '.', 0, '')},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});

function change() {
    let uang = Intl.NumberFormat('id-ID');
    let grand_total = $("#grand_total").val(),
        cash = $("#cash").val();
    // $("#change").html(cash - grand_total);
    $('#change').html(uang.format(cash - grand_total));
    $("#changes").val(cash - grand_total);
}

function invoice(jumlah) {
    let hasil = "",
        char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        total = char.length;
    for (var r = 0; r < jumlah; r++) hasil += char.charAt(Math.floor(Math.random() * total));
    return hasil
}
$("#invoice").html(invoice(10));

