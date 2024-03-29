/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
var productSelected = {};

function selectProductAction() {
  let uang = Intl.NumberFormat('id-ID');
  var selectedData = $(this).data();
  $('input#id').val(selectedData.id);
  $('input#code').val(selectedData.code);
  $('input#name').val(selectedData.name);
  $('input#unit').val(selectedData.unit);
  $('input#price').val(selectedData.price);
  $('input#price_view').val(uang.format(selectedData.price));
  $('input#buyprice').val(selectedData.buyprice);
  $('input#stock').val(selectedData.stock);
  $('#stockview').html(selectedData.stock);
  $('.modal').modal('hide');
}

$(document).ready(function () {
  $('.product-table').DataTable({
    processing: true,
    serverSide: true,
    order: [3, "asc"],
    ajax: 'products',
    columns: [{
      "data": null,
      "sortable": false,
      render: function render(data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    }, 
    {
      data: 'id',
      name: 'id',
      visible: false,
      orderable: false,
      searchable: false
    }, {
      data: 'code',
      name: 'code',
      orderable: false
    }, {
      data: 'product_name',
      name: 'product_name',
    }, {
      data: 'category',
      name: 'category.name',
      orderable: false
    }, {
      data: 'unit',
      name: 'unit.code',
      orderable: false
    }, {
      data: 'stock',
      name: 'stock',
      orderable: false
    }, {
      data: 'sell_price',
      name: 'sell_price',
      render: $.fn.dataTable.render.number('.', '.', 0, ''),
      orderable: false
    },
    {
      data: 'buy_price',
      name: 'buy_price',
      visible: false,
      orderable: false,
      searchable: false
    }, 
    {
      data: 'actions',
      name: 'actions',
      orderable: false,
      searchable: false,
      render: function render(data, type, row) {
        return '<button data-id="' + row.id + '" data-code="' + row.code + '" data-name="' + row.product_name + '" data-unit="' + row.unit + '" data-price="' + row.sell_price + '" data-buyprice="' + row.buy_price + '" data-stock="' + row.stock + '" class="btn btn-info text-white btn-sm btn-select-product">Pilih</button>';
      }
    }]
  });
  $('.product-table').on('click', '.btn-select-product', selectProductAction);
  
});

$(function() { 
  $('.product-table input[type=search]').focus();
});



/******/ })()
;