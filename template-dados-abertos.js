(function( $ ){
  var shortColumns = [];
  var table = null;

  $(document).ready(function() {
    var colCount = 0;
    $('#dados-abertos-table tr:nth-child(1) td').each(function () {
      if ($(this).attr('colspan')) {
          colCount += +$(this).attr('colspan');
      } else {
          colCount++;
      }
    });
    for (let index = 0; index < colCount; index++) {
      shortColumns.push(true);
    }
    table = $('#dados-abertos-table').datatable({
      pageSize: 10,
      sort: shortColumns,
      filters: shortColumns,
      filterText: '',
      pagingDivSelector: "#dados-abertos-pager",
    }); 
  })

  $('.dados-abertos-filter-input').on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $('#dados-abertos-table tbody tr').filter(function() {
     //$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });

    var index = $(this).parent().parent().index();
    var input = $('#dados-abertos-table thead tr').eq(2).find('td').eq(index).find('input');
    input.val($(this).val());
    input.keyup();
  });


})(jQuery);