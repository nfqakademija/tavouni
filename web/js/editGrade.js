var input = $("input[class *= 'grade-value']");

input.keypress(function (event) {
    if (event.keyCode === 13) {
        $(this).blur();
    }
});

input.focusout(function () {
    var gradeValue = $(this).val();
    if (gradeValue !== $(this).attr('value')) {
        var gradeId = $(this).parent().attr('id');
        callGradeAjax(gradeId, gradeValue, $(this));
    }
});

function callGradeAjax(gradeId, gradeValue, input) {
    var current = window.location.pathname;
    $.ajax ({
        url: current + "/edit/" + gradeId + "/" + gradeValue,
        type: "POST",
        async: true,
        success: function () {
            input.attr('value', gradeValue);
            $(".alert").show();
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").slideUp(500);
            });
        },
        error: function (xhr, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log(xhr.responseText);
            input.val(input.attr('value'));
        }
    });
}
$(":input").bind('click keyup', function () {
    $(this).focus();
});

