$(function() {
    $("#friendReq").on("click", function(e) {
        e.preventDefault();
        $('#errorReg').empty();
        var valIt = validateForm($("#formFriendReq"));

        var firstN = $("input#newfirst").val();
        var lastN = $("input#newlast").val();
        var yearG = $("input#newyear").val();
        var emailA = $("input#newemail").val();
        var txtArea = $("textarea#whyAdd").val();

        if (valIt == "") {
            var dataString = 'firstN=' + firstN + '&lastN=' + lastN + '&yearG=' + yearG + '&emailA=' + emailA + '&txtArea=' + txtArea;
            $.ajax({
                type: "POST",
                url: "/libs/friendReq.php",
                data: dataString,
                success: function(data) {
                    $('#errorReg').css('color', 'green');
                    successTime = '<span class="label label-success">Success</span><br /><br />' + data + '<br />';
                    $('#errorReg').html(successTime);
                    clearFields();
                },
                error: function(data) {
                    $('#errorReg').css('color', 'red');
                    errorTime = '<span class="label label-danger">Error</span><br /><br />' + data.statusText + '<br />Please contact site Admin<br /><br />';
                    $('#errorReg').html(errorTime);
                }
            });

        }
        else {
            valIt = '<span class="label label-danger">Error</span><br /><br />' + valIt + '<br />';
            $('#errorReg').css('color', 'red');
            $('#errorReg').html(valIt);
        }
    });

    $(window).resize(function() {
        $("#forPassDial").dialog("option", "position", "center");
    });

    $(window).resize(function() {
        $("#forUserDial").dialog("option", "position", "center");
    });

    $('#forPassDial').dialog({
        autoOpen: false,
        modal: true,
        draggable: false,
        resizable: false,
        title: "Forgot Password",
        height: 'auto',
        width: 'auto',
        fluid: true
    });

    $('#forUserDial').dialog({
        autoOpen: false,
        modal: true,
        draggable: false,
        resizable: false,
        title: "Forgot Username",
        height: 'auto',
        width: 'auto',
        fluid: true
    });

    $('#forUser').click(function() {
        $('#forUserDial').dialog('open');
    });

    $('.forPass').click(function() {
        $('#forPassDial').dialog('open');
    });

    $('#forUserSub').click(function() {
        var email = $('#forgotUser').val();
        $.ajax({
            type: "GET",
            url: "/Index/SendUserInfo/User/" + email,
            success: function(data) {
                $('#forUserDial').empty();
                if (data != email) {
                    $('#forUserDial').html('We did not find that email on file. Please join up or register.').show('slow');
                } else {
                    $('#forUserDial').html('We sent your username to your email address:<br /><br /> <div style="color:green;font-weight:bold;text-align:center;">' + data + '</div>').show('slow');
                }
            },
            error: function(data) {
                $('#forUserDial').empty();
                $('#forUserDial').html('Server error. Please try again later.').show('slow');
            }
        });
    });

    $('#forPassSub').click(function() {
        var email = $('#forgotPass').val();
        $.ajax({
            type: "GET",
            url: "/Index/SendUserInfo/Pass/" + email,
            success: function(data) {
                $('#forPassDial').empty();
                if (data != email) {
                    $('#forPassDial').html('We did not find that email on file. Please join up or register.').show('slow');
                } else {
                    $('#forPassDial').html('We sent a new password to your email address:<br /><br /> <div style="color:green;font-weight:bold;text-align:center;">' + data + '</div>').show('slow');
                }
            },
            error: function(data) {
                $('#forPassDial').empty();
                $('#forPassDial').html('Server error. Please try again later.').show('slow');
            }
        });
    });
});

function validateForm()
{
    var reason = "";
    var first = $("input#newfirst").val();
    var last = $("input#newlast").val();
    var year = $("input#newyear").val();
    var email = $("input#newemail").val();

    reason += validateFirstName(first);
    reason += validateName(last);
    reason += validateYear(year);
    reason += validateEmail(email);

    return reason;
}

function validateName(name)
{
    if (name == "") {
        return "Your last name cannot be blank<br />";
    }
    return "";
}

function validateFirstName(name)
{
    if (name == "") {
        return "Your first name cannot be blank<br />";
    }
    return "";
}

function validateYear(year)
{
    if (year == "") {
        return "Year cannot be blank<br />";
    }
    return "";
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

function toggleNav(whichBut) {
    switch (whichBut)
    {
        case 'login':
            $("#logli").addClass("active");
            $("#contli").removeClass("active");
            $("#abtli").removeClass("active");
            $("#joinli").removeClass("active");
            $("#regli").removeClass("active");
            $("#modreg").fadeOut();
            $("#modcont").fadeOut();
            $("#modabout").fadeOut();
            $("#modjoin").fadeOut();
            $("#modlogin").delay(600).fadeIn();
            break;
        case 'about':
            $("#abtli").addClass("active");
            $("#contli").removeClass("active");
            $("#logli").removeClass("active");
            $("#joinli").removeClass("active");
            $("#regli").removeClass("active");
            $("#modreg").fadeOut();
            $("#modcont").fadeOut();
            $("#modlogin").fadeOut();
            $("#modjoin").fadeOut();
            $("#modabout").delay(600).fadeIn();
            break;
        case 'contact':
            $("#contli").addClass("active");
            $("#logli").removeClass("active");
            $("#abtli").removeClass("active");
            $("#joinli").removeClass("active");
            $("#regli").removeClass("active");
            $("#modreg").fadeOut();
            $("#modlogin").fadeOut();
            $("#modabout").fadeOut();
            $("#modjoin").fadeOut();
            $("#modcont").delay(600).fadeIn();
            break;
        case 'join':
            $("#joinli").addClass("active");
            $("#contli").removeClass("active");
            $("#abtli").removeClass("active");
            $("#logli").removeClass("active");
            $("#regli").removeClass("active");
            $("#modreg").fadeOut();
            $("#modcont").fadeOut();
            $("#modabout").fadeOut();
            $("#modlogin").fadeOut();
            $("#modjoin").delay(600).fadeIn();
            break;
        case 'register':
            $("#regli").addClass("active");
            $("#contli").removeClass("active");
            $("#abtli").removeClass("active");
            $("#logli").removeClass("active");
            $("#joinli").removeClass("active");
            $("#modreg").fadeOut();
            $("#modcont").fadeOut();
            $("#modabout").fadeOut();
            $("#modlogin").fadeOut();
            $("#modjoin").fadeOut();
            $("#modreg").delay(600).fadeIn();
            break;
        default:
            alert('Javascript Server Error');
            break;
    }
    $("#bs-example-navbar-collapse-1").css("height","1px").removeClass("in").addClass("collapse");
}

function clearFields()
{
    document.getElementById("newyear").value = '';
    document.getElementById("newlast").value = '';
    document.getElementById("newfirst").value = '';
    document.getElementById("whyAdd").value = '';
    document.getElementById("newemail").value = '';
}