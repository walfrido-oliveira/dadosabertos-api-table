(function( $ ){

  

})(jQuery);


function filterTable() {
  const query = q => document.querySelectorAll(q);
  const filters = [...query('th input')].map(e => new RegExp(e.value, 'i'));

  query('tbody tr').forEach(row => row.style.display = 
    filters.every((f, i) => f.test(row.cells[i].textContent)) ? '' : 'none');
}