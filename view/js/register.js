$(function() {
    $('.form-control').tooltip();

    $('#regErr').empty();

    //Using for account management validation as well
    $("#acctForm").submit(function(event) {
        var acctEmail = $('#acctEmail').val();
        var newPass = $('#acctNewPass').val();
        var confNewPass = $('#acctNewPassConf').val();

        $("#acctRegErr").empty();

        $('#acctSuccess').empty();

        var valIt = "";

        valIt += validateEmail(acctEmail);

        if (newPass != confNewPass) {
            valIt += 'Passwords do not match<br />';
        } else {
            if (newPass == "" && confNewPass == "") {

            } else {
                valIt += checkPassword(newPass);
            }
        }

        if (valIt == "") {

        } else {
            $("#acctRegErr").html(valIt);
            window.scrollTo(0, 0);
            event.preventDefault();
        }
    });

    $("#regForm").submit(function(event) {

        var valIt = validateForm();

        var captcha = $('input[name=captcha_code]').val();

        var dataString = 'captcha_code=' + captcha;

        $('#regErr').empty();

        if (valIt == '') {
            $.ajax({
                type: "POST",
                url: "/Registration/checkCapt",
                data: dataString,
                async: false,
                success: function(data) {
                    if (data == 'true') {

                    }
                    else {
                        $('#regErr').css('color', 'red');
                        window.scrollTo(0, 0);
                        $('#regErr').html('Captcha code does not match, please enter new code');
                        $('input[name=captcha_code]').val('');
                        document.getElementById('captcha').src = '/libs/securimage/securimage_show.php?' + Math.random();
                        event.preventDefault();
                    }
                },
                error: function(data) {
                    $('#regErr').css('color', 'red');
                    errorTime = 'Server Error<br />' + data.statusText + '<br />Please contact site Admin<br /><br />';
                    $('#regErr').html(errorTime);
                }
            });
        } else {
            $("#regErr").html(valIt);
            document.getElementById('captcha').src = '/libs/securimage/securimage_show.php?' + Math.random();
            window.scrollTo(0, 0);
            event.preventDefault();
        }

    });
});

function validateForm()
{
    var reason = "";
    var loginId = $('input[name=loginId]').val();
    var emailIt = $('input[name=emailIt]').val();
    var ConfEmailIt = $('input[name=confEmailIt]').val();
    var passTime = $('input[name=passTime]').val();
    var confPassTime = $('input[name=confPassTime]').val();
    var captcha = $('input[name=captcha_code]').val();

    if (loginId.length < 6) {
        reason += 'User Name must be at leats 6 characters long<br />';
    }

    reason += validateEmail(emailIt);

    if (emailIt !== ConfEmailIt) {
        reason += 'Emails do not match<br />'
    }

    reason += checkPassword(passTime);

    if (passTime !== confPassTime) {
        reason += 'Passwords do not match<br />'
    }

    if (captcha == '') {
        reason += 'Must enter captcha code';
    }

    return reason;
}

function validateEmail(email)
{
    var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (email == "") {
        return "Email cannot be blank<br />";
    }
    if (email.match(emailRegex) == null) {
        return "Please enter a valid email address<br />";
    }
    return "";
}

function checkPassword(pass)
{
    // at least one number, one lowercase letter
    // at least six characters
    var re = /(?=.*\d).{6,}/;
    if (re.test(pass)) {
        return '';
    }
    else {
        return 'Password does not meet requirements<br />';
    }
}