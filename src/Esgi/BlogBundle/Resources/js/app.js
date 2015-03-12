$( document ).ready(function() {
    $('#recherche-btn').on('click', function() {
        $('#recherche-box').toggle();
        $('#recherche-box input').focus();
        return false;
    });
});