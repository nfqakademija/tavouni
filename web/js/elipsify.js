jQuery( document ).ready(function( $ ) {
    var deadlines = $('p.deadline-subject > a');
    for (var i = 0; i < deadlines.length - 1; i++) {
        if (collision(deadlines.eq(i), deadlines.eq(i + 1))) {
            deadlines.eq(i).text(ellipsify(deadlines.eq(i).text()));
            deadlines.eq(i + 1).text(ellipsify(deadlines.eq(i + 1).text()));
        }
    }
});

function ellipsify (str) {
    if (str.length > 24) {
        return (str.substring(0, 24) + "...");
    }
    else {
        return str;
    }
}

function collision($div1, $div2) {
    var x1 = $div1.offset().left;
    var w1 = $div1.outerWidth(false);
    var r1 = x1 + w1;
    var x2 = $div2.offset().left;
    var w2 = $div2.outerWidth(false);
    var r2 = x2 + w2;

    return !(r1 < x2 || x1 > r2);
}


