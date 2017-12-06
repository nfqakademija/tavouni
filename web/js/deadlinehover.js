
jQuery( document ).ready(function( $ ) {
    $('.deadline-subject').tooltip({content: function () {
        return $(this).prop('title');
    }});
});