$(document).ready(function() { 
    $('.link a').click(function(e) {
        $('.link a.active').removeClass('nav-pills active');
        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
    });
});   