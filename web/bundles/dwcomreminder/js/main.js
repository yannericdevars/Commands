jQuery(function() {
    jQuery( "#accordion" ).accordion();
});
jQuery(function() {
    jQuery( "#tabs" ).tabs();
});
jQuery( "#button_message" ).click(function() {
  jQuery( "#toggler" ).toggle( "slide" );
});