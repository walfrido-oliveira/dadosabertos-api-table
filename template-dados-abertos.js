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
    let value  = $( "#page_length option:selected" ).text();
    let tableLength = $('#dados-abertos-table tbody tr').length;
    if (tableLength > 0) {
      setTable(value);
    } else {
      let columns = $('#dados-abertos-table thead tr:first th').length;
      $('#dados-abertos-table tbody').append("<tr><td class='empty-row' colspan='" + columns + "'>Sem Informação</td></tr>");
      $('#dados-abertos-page-length').hide();
    }
  })

  function setTable(pageSize = 10) {
    table = new DataTable(document.querySelector('#dados-abertos-table'), {
      pageSize: pageSize,
      sort: shortColumns,
      filters: shortColumns,
      filterText: '',
      pagingDivSelector: "#dados-abertos-pager",
      firstPage: false,
      prevPage: 'Anterior',
      nextPage: 'Próximo',
      lastPage: false
    }); 
  }

  $('.dados-abertos-filter-input').on("keyup", function() {
    var index = $(this).parent().parent().index();
    var input = $('#dados-abertos-table thead tr').eq(2).find('td').eq(index).find('input');
    input.val($(this).val());
    input.keyup();
  });

  $('#page_length').on('change', function() {
    let value = $(this).val();
    table.options.pageSize = value;
    table.refresh();
  });

})(jQuery);