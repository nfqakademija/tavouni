var changed = [];

$("input[class *= 'grade-value']").change(function() {
    $("#grade-submit").attr("disabled", false);

    var id = $(this).parent().attr("id");
    if (jQuery.inArray(id, changed) === -1) {
       changed.push(id);
   }
});

$('#grade-submit').click(function() {
   callGradeAjax();
});

function callGradeAjax() {
    var current = window.location.pathname;
    var grades = [];
    changed.forEach(function(gradeId) {
           grades.push(
               {
                   gradeId: gradeId,
                   gradeValue: $("#" + gradeId).find("input").val()
               }
           )
    });

    if (grades.length !== 0) {
        $.ajax ({
            url: current + "/edit",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(grades),
            contentType:"application/json; charset=utf-8",
            async: true,
            success: function () {
                showSuccessMessage();
                changed = [];
                $("#grade-submit").attr("disabled", true);
            },
            error: function (xhr, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                console.log(xhr.responseText);
            }
        });
    }
}

function showSuccessMessage() {
    $(".alert").show();
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
}

