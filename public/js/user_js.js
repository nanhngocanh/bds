$("#show-more-icon").on('click', function () {
    $("#show-more-box").toggle('slow');
});

$("#show-form-message").on('click', function () {
    $("#form").toggle('slow');
    $("#show-more-box").toggle('slow');
});;
$("#close-report-form").on('click', function () {
    $("#form").toggle('slow');
});
