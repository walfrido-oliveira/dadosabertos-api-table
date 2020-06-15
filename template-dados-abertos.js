(function( $ ){
  var currentPage = 0;
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

})(jQuery);

function filterTable() {
  const query = q => document.querySelectorAll(q);
  const filters = [...query('th input')].map(e => new RegExp(e.value, 'i'));

  query('tbody tr').forEach(row => row.style.display = 
    filters.every((f, i) => f.test(row.cells[i].textContent)) ? '' : 'none');
}