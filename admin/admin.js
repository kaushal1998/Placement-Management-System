function validate(isvalidate, id, sid) {
    $('.validate.' + id).css('background-image', 'url(../images/loading.gif)');
    $.ajax({
        url: 'validate.php',
        data: { isvalidate: isvalidate, id: id, sid: sid },
        type: 'POST',
        success: function(res) {
            console.log(res);
            if (res == 'Success') {
                $('.onebox.' + id).fadeOut("slow", function() {
                    $('.onebox.' + id).css('display', 'none');
                });
            } else {
                $('.validate.' + id).css('background-image', 'none');
                alert('Something went wrong, Please try again');
            }
        }
    });
}

function validateComp(isvalidate, id) {
    $.ajax({
        url: 'validatecomp.php',
        data: { isvalidate: isvalidate, id: id },
        type: 'POST',
        success: function(res) {
            console.log(res);
            if (res == 'Success') {
                $('.box.' + id).fadeOut("slow", function() {
                    $('.box.' + id).css('display', 'none');
                });
            } else {
                alert('Something went wrong, Please try again');
            }
        }
    });
}