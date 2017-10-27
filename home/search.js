function applynow(cid, id) {
    $.ajax({
        url: 'applyNow.php',
        data: { cid: cid, id: id },
        type: 'POST',
        success: function(res) {
            if (res == 'added') {
                $('.applynow.' + cid).text('Applied');
            } else if (res == 'failed') {
                alert('Something went wrong, Please try again!');
            }
        }
    });
}