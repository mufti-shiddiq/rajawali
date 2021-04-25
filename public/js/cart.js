/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
var productSelected = {};

function selectProductAction() {
  var selectedData = $(this).data();
  $('input#id').val(selectedData.id);
  $('input#code').val(selectedData.code);
  $('input#name').val(selectedData.name);
  $('input#unit').val(selectedData.unit);
  $('input#price').val(selectedData.price);
  $('.modal').modal('hide');
}

$(document).ready(function () {
  $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    order: [2, "asc"],
    ajax: BASE_URL + '/products',
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
      name: 'code'
    }, {
      data: 'product_name',
      name: 'product_name'
    }, {
      data: 'category',
      name: 'category.name'
    }, {
      data: 'unit',
      name: 'unit.code'
    }, {
      data: 'stock',
      name: 'stock'
    }, {
      data: 'sell_price',
      name: 'sell_price',
      render: $.fn.dataTable.render.number('.', '.', 0, '')
    }, {
      data: 'actions',
      name: 'actions',
      orderable: false,
      searchable: false,
      render: function render(data, type, row) {
        return '<button data-id="' + row.id + '" data-code="' + row.code + '" data-name="' + row.product_name + '" data-unit="' + row.unit + '" data-price="' + row.sell_price + '" class="btn btn-info text-white btn-sm btn-select-product">Pilih</button>';
      }
    }]
  });
  $('.data-table').on('click', '.btn-select-product', selectProductAction);
});
/******/ })()
;