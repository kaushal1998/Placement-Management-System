function validate() {
    var sem_no = document.getElementById('sem').value;
    var marks = document.getElementById('cgpa').value;
    var kts = document.getElementById('kt').value;
    if (sem_no == 0) {
        alert('Enter valid sem no.');
        return false;
    } else if (!marks) {
        alert('Enter valid score.');
        return false;
    } else {
        return true;
    }
}

function join(id) {
    console.log(id);
    $.ajax({
        url: 'join.php',
        data: { id: id },
        type: 'POST',
        success: function(res) {
            $(location).attr('href', 'index.php')
        }
    });
}

$(document).ready(function() {
    email = $('#semail').val();
    sid = $('#sid').val();
    console.log(email);
    resumeClick = 0;
});

$('#resumeUpload').click(function(e) {
    e.preventDefault();
    var formData;
    formData = new FormData();
    formData.append('userid', email);
    formData.append('id', sid);
    formData.append('file', $('#resume')[0].files[0]);
    $.ajax({
        url: 'resumeUpload.php',
        type: 'POST',
        data: formData,
        success: function(res) {
            if (res == 'success') {
                console.log('success');
            } else {
                console.log(res);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$('#reuploadbutton').click(function(e) {
    if (resumeClick == 0) {
        $('.uploadbox').css('display', 'block');
        $('.uploadbox').css('height', '110px');
        resumeClick = 1;
    } else {
        e.preventDefault();
        $('.resume').css('opacity', '0.5');
        console.log(resumeClick);
        var formData;
        formData = new FormData();
        formData.append('userid', email);
        formData.append('id', sid);
        formData.append('file', $('#resume2')[0].files[0]);
        $.ajax({
            url: 'resumeUpload.php',
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            success: function(res) {
                $.each(res.response, function(key, value) {
                    $('.resume').css('opacity', '1');
                    if (value.status == 'Success') {
                        $('#my_resume').attr('data', '../' + value.path);
                    } else if (value.status == 'Failed') {
                        alert('Something went wrong, Please try again!');
                    } else if (value.status == 'file extension') {
                        alert('Please upload only PDF files only.');
                    }
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
});