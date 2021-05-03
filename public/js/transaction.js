
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

function discount_total() {

    let discount_total = $("#discount_total").val();
    grand_total -= discount_total
    console.log('ok',grand_total)
    // $("#change").val(cash - grand_total);
    
}

function change() {
    let grand_total = $("#grand_total").val(),
        cash = $("#cash").val();
    $("#change").val(cash - grand_total);
    $("#change_view").html(cash - grand_total);
}

function invoice(jumlah) {
    let hasil = "",
        char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        total = char.length;
    for (var r = 0; r < jumlah; r++) hasil += char.charAt(Math.floor(Math.random() * total));
    return hasil
}
$("#invoice").html(invoice(10));


function process() {
    let data = item.rows().data(),
        qty = [];
    $.each(data, (index, value) => {
        qty.push(value[3])
    });
    $.ajax({
        url: addUrl,
        type: "post",
        dataType: "json",
        data: {
            produk: JSON.stringify(produk),
            qty: qty,
            total_bayar: $("#total").html(),
            jumlah_uang: $('[name="jumlah_uang"]').val(),
            diskon: $('[name="diskon"]').val(),
            pelanggan: $("#pelanggan").val(),
            nota: $("#nota").html()
        },
        success: res => {
            if (isCetak) {
                Swal.fire("Sukses", "Sukses Membayar", "success").
                    then(() => window.location.href = `${cetakUrl}${res}`)
            } else {
                Swal.fire("Sukses", "Sukses Membayar", "success").
                    then(() => window.location.reload())
            }
        },
        error: err => {
            console.log(err)
        }
    })
}