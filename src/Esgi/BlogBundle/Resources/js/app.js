$( document ).ready(function() {
    $('#recherche-btn').on('click', function() {
        $('#recherche-box').slideToggle('slow');
        $('#recherche-box input').focus();
        return false;
    });
});