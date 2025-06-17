jQuery(document).ready(function($) {
    $('.faq-question').click(function() {
        var faqId = $(this).data('faq-id');
        $('#' + faqId).slideToggle('fast');
        $(this).toggleClass('faq-active');
    });
});