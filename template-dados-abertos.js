(function( $ ){
  var currentPage = 0;
  var shortColumns = [];

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

    $('#dados-abertos-table').datatable({
      pageSize: 10,
      sort: shortColumns,
      filterText: '',
      pagingDivSelector: "#dados-abertos-pager"
    });
    
  })
  
  function paginateTable() {
    $('#dados-abertos-pager').empty();
    $('table.paginated').each(function() {
      var numPerPage = 10;
      var $table = $(this);
      $table.bind('repaginate', function() {
          $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
      });
      $table.trigger('repaginate');
      var numRows = $table.find('tbody tr').length;
      var numPages = Math.ceil(numRows / numPerPage);
      var $pager = $('<ul class="pagination"></ul>');
      $pager.append('<li class="page-item"><a class="page-link" id="prev" href="#">Anterior</a></li>')
      for (var page = 0; page < numPages; page++) {
          var item = $('<li class="page-item"></li>');
          item.append('<a class="page-link" href="#">' + page + 1 + '</a>');
          item.bind('click', {
              newPage: page
          }, function(event) {
              event.preventDefault();
              currentPage = event.data['newPage'];
              $table.trigger('repaginate');
              $(this).addClass('active').siblings().removeClass('active');
          }).appendTo($pager).addClass('clickable');
      }
      $pager.append('<li class="page-item"><a class="page-link" id="next" href="#">Próximo</a></li>')
      $pager.appendTo('#dados-abertos-pager').find('.page-item').eq(1).addClass('active');
    });
  }

  $(document).on('click', '#prev', function(event) {
    var $table = $('table.paginated');
    event.preventDefault();
    if((currentPage - 1) < 0) return;
    currentPage--;
    $table.trigger('repaginate');
    $('.page-item').eq(currentPage + 1).addClass('active').siblings().removeClass('active');
  });

  $(document).on('click', '#next', function(event) {
    var $table = $('table.paginated');
    event.preventDefault();
    if((currentPage + 1) > ($('.page-item').length - 3)) return;
    currentPage++;
    $table.trigger('repaginate');
    $('.page-item').eq(currentPage + 1).addClass('active').siblings().removeClass('active');
  });

  $('.dados-abertos-filter-input').on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $('#dados-abertos-table tbody tr').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });


})(jQuery);