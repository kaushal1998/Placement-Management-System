function showRegister() {
    document.getElementById('regStudent').style.display = 'block';
    document.getElementById('logStudent').style.display = 'none';
}

function validationLogStu() {
    var email = document.getElementById('logemail').value;
    var password = document.getElementById('logpassword').value;
    if (email.name == 0 || password.length == 0) {
        alert('Some Fields are missing');
        return false;
    }
    return true;
}

function validationRegStu() {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var name = document.getElementById('name').value;
    var classn = document.getElementById('class').value;
    var branch = document.getElementById('branch').value;
    var rollno = document.getElementById('rollno').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;
    if (name.length == 0 || branch.length == 0 || classn.length == 0 || rollno.length == 0 || email.name == 0 || password.length == 0 || repassword.length == 0) {
        alert('Some Fields are missing');
        return false;
    } else if (!re.test(email)) {
        alert('invalid email address!');
        return false;
    } else if (password.length < 8) {
        alert('Password must be greater than 8 letters');
        return false;
    } else if (password != repassword) {
        alert('Passwords are not matching');
        return false;
    } else {
        return true;
    }
}

function alregPress() {
    document.getElementById('regStudent').style.display = 'block';
    document.getElementById('logStudent').style.display = 'none';
    document.getElementById('alreadyAcc').style.display = 'none';
}

function alloginPress() {
    document.getElementById('regStudent').style.display = 'none';
    document.getElementById('logStudent').style.display = 'block';
    document.getElementById('alreadyAcc').style.display = 'none';
}

function showLogin() {
    document.getElementById('regStudent').style.display = 'none';
    document.getElementById('logStudent').style.display = 'block';
}

function showRegisterCom() {
    document.getElementById('regCompany').style.display = 'block';
    document.getElementById('logCompany').style.display = 'none';
}

function showLoginCom() {
    document.getElementById('regCompany').style.display = 'none';
    document.getElementById('logCompany').style.display = 'block';
}

function validationLoginCom() {
    var email = document.getElementById('cid').value;
    var password = document.getElementById('cpass').value;
    if (email.name == 0 || password.length == 0) {
        alert('Some Fields are missing');
        return false;
    }
    return true;
}

function validationRegCom() {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var name = document.getElementById('cname').value;
    var regno = document.getElementById('regno').value;
    var vacancy = document.getElementById('vacancy').value;
    var cemail = document.getElementById('cemail').value;
    var cpassword = document.getElementById('cpassword').value;
    var crepassword = document.getElementById('crepassword').value;
    if (cname.length == 0 || regno.length == 0 || lid.length == 0 || cemail.name == 0 || vacancy.length == 0 || cpassword.length == 0 || crepassword.length == 0) {
        alert('Some Fields are missing');
        return false;
    } else if (!re.test(cemail)) {
        alert('invalid email address!');
        return false;
    } else if (cpassword.length < 8) {
        alert('Password must be greater than 8 letters');
        return false;
    } else if (cpassword != crepassword) {
        alert('Passwords are not matching');
        return false;
    } else {
        return true;
    }
}

function alcomploginPress() {
    document.getElementById('regCompany').style.display = 'none';
    document.getElementById('logCompany').style.display = 'block';
    document.getElementById('alreadyAccCompany').style.display = 'none';
}

function alcompregPress() {
    document.getElementById('regCompany').style.display = 'block';
    document.getElementById('logCompany').style.display = 'none';
    document.getElementById('alreadyAccCompany').style.display = 'none';
}