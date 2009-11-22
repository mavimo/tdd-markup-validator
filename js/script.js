$(document).ready(function () {
  var num_page = $('#validate-items span.tot').html();
  var num_validated = 0;
  // Rendo peno evidenti le pagine non ancora validate
  $('.to-parse').fadeTo(1, 0.3);
  
  //============================================================================
  // Gestione dei filtri
  $('#filter span').click(filterReport);
  $('#filter span.all').click(function() { $('#report .page').show(); });
  
  // Funzione di filtraggio
  function filterReport() {
    var className = $(this).attr('class');
    $('#report .page').hide();
    $('.' + className, '#report').show();
  }
  
  //============================================================================
  // Faccio aprtire la validazione
  $('.to-parse:first').each(validate);
  
  // Funzione di validazione
  function validate() {
    var row = $(this);
    var validate_url = $('.address > a', row).attr('href');
    $.getJSON('validate.php', { 'url' : validate_url}, function (data) {
      $(row).addClass(data.status).fadeTo(1, 1);
      
      // Visualizzo il numero di errori (se presenti)
      if(data.error > 0) {
        $('.num-error a', row).html(data.error);
        $('.num-error a', row).attr('href', data.url);
        $('.num-error', row).show();
      }
      
      // Visualizzo il numero di warning (se presenti)
      if(data.warning > 0) {
        $('.num-warning a', row).html(data.warning);
        $('.num-warning a', row).attr('href', data.url);
        $('.num-warning', row).show();
      }
      
      num_validated++;
      percentage();
      $(row).removeClass('to-parse');
      $('.to-parse:first').each(validate);
    });
  }
  
  //============================================================================
  // Visualizzaizone delle percentuali
  function percentage() {
    // Calculate percentage of total
    var percentage = (num_validated / num_page * 100);
    $('#validate-items span.current').html(num_validated);
    $('#percentage span.current').html(Math.round(percentage, 1));
    
    drawBar('valid');
    drawBar('warning');
    drawBar('error');
    drawBar('unaviable');
  }
  
  //============================================================================
  // Disegna la barra di avanzamento
  function drawBar(className) {
    // Percentage for this class
    var percent = ($('.page.' + className).length     / num_page * 100);
    // Set bar width
    $('#progressbar .' + className).css( { 'width' : percent + '%' } );
    // Add text if usable
    if(percent > 0) {
      $('#progressbar .' + className).html( Math.round(percent) + '%');
    }
  }
  
  $('.to-parse .address div').hide();
  
});
