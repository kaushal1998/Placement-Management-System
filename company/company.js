function validate() {
    var limit = document.getElementById('limit').value;
    console.log(limit);
    if (limit == 0 || limit > 10) {
        alert('Enter valid sem no.');
        return false;
    } else {
        return true;
    }
}

function call(id, value) {
    $.ajax({
        url: 'call.php',
        type: 'POST',
        data: { id: id, value: value },
        success: function(res) {
            if (res == 'Success') {
                $('.call.' + id).text('Called, cancel JOB request.');
            } else if (res == 'SuccessO') {
                $('.call.' + id).text('Call For JOB');
            } else {
                alert('Something went wrong, Please try again!');
            }
        }
    });
}

function showdetails(id) {
    $('.details.' + id).css('display', 'block');
}