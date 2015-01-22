// listen click, open modal and .load content
$('#modalButton').click(function () {
    $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
});

function submitform(id) {
    // get the form id and set the event handler
    $('form#' + id).on('beforeSubmit', function (e) {
        var form = $(this);
        $.post(
                form.attr("action"),
                form.serialize()
                )
                .done(function (result) {
                    form.parent().html(result);
                })
                .fail(function () {
                    console.log("server error");
                });
        return false;
    }).on('submit', function (e) {
        e.preventDefault();
    });
}

$('#tendercategory').on('beforeSubmit', function (e) {
    var $form = $(this);

    submitForm($form);
    // do whatever here, see the parameter \$form? is a jQuery Element to your form
}).on('submit', function (e) {
    e.preventDefault();
});

$('#tendercategory').submit(submitForm);