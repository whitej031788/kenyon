<!DOCTYPE html>  
<html>  
    <head>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <!-- Bootstrap -->  
        <link href="/view/bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <title>Kenyon EX Collegian</title>
        <style>            
            body
            {
                background: black no-repeat center center fixed;
                /* background-color:#790FAB;*/
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            hr {
                display: block;
                height: 20px;
                border-top: 50px solid purple;
                margin-top: 30px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <script type="text/javascript" src="//code.jquery.com/jquery.js"></script>  
        <script type="text/javascript" src="/view/bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>  
        <script type="text/javascript" src="/view/js/register.js"></script>
        <hr />
        <div class="container">
            <div class="row">
                <div class="span2" style="text-align:center;background-color: #E8E8E8 ;padding:10px 50px 10px 50px;border-radius:25px;width:50%;margin:auto;">
                    <h1>KEC Registration</h1>
                    {if !isset($addedLogin)}
                        <p>Hello <i style="color:#BDA000;">{$firstName|ucfirst}</i> <i style="color:#BDA000;">{$lastName|ucfirst}</i>, class of <i style="color:#BDA000;">{$gradYear}</i>. You are a valid friend! Please enter the information below to create a valid login for the KEC site. Please make sure to enter valid information.</p>
                        <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;color:red;text-decoration:italics;" id="regErr"></span>
                        <form role="form" style="width:60%;margin:auto;" method="POST" action="/Registration/CreateLogin" id="regForm">
                            <div class="form-group">
                                <input type="text" class="form-control" id="loginId" placeholder="User Name" name="loginId" data-original-title="Must be at least 6 characters long">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="loginId" placeholder="Email" name="emailIt" data-original-title="Must be a valid email address">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="loginId" placeholder="Confirm Email" name="confEmailIt">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="loginId" placeholder="Password" name="passTime" data-original-title="At least 6 characters long and must contain at least one letter and one number">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="loginId" placeholder="Confirm Password" name="confPassTime">
                            </div>
                            <div class="form-group">
                                <img id="captcha" src="/libs/securimage/securimage_show.php" alt="CAPTCHA Image" /><br /><a href="#" onclick="document.getElementById('captcha').src = '/libs/securimage/securimage_show.php?' + Math.random();
                                        return false">New Captcha</a>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Code Above" name="captcha_code" size="10" maxlength="6" />
                            </div>
                            <button type="submit" class="btn btn-default text-center" id="regBut">Register</button>
                            <input type="hidden" name="fid" value="{$fid}" />
                        </form>
                    {elseif isset($addedLogin) AND $addedLogin eq 'true'}
                        <meta http-equiv="refresh" content="8; url=/" />
                        <p>Congratulations {$login}! We have added your login to the site. The site administrator will confirm your login and then you can login from the <a href = '/'>main page</a>, to which you will be redirected in 8 seconds.</p>
                    {else}
                        <p style="color:red;">There was an issue adding your login. Most likely that Username and/or Email address already exist in our system for a different login. Please use a different username and/or email address to register.</p>
                        <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;color:red;text-decoration:italics;" id="regErr"></span>
                        <form role="form" style="width:60%;margin:auto;" method="POST" action="/Registration/CreateLogin" id="regForm">
                            <div class="form-group">
                                <input type="text" class="form-control" id="loginId" placeholder="User Name" name="loginId" data-original-title="Must be at least 6 characters long">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="loginId" placeholder="Email" name="emailIt" data-original-title="Must be a valid email address">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="loginId" placeholder="Confirm Email" name="confEmailIt">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="loginId" placeholder="Password" name="passTime" data-original-title="At least 6 characters long and must contain at least one letter and one number">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="loginId" placeholder="Confirm Password" name="confPassTime">
                            </div>
                            <div class="form-group">
                                <img id="captcha" src="/libs/securimage/securimage_show.php" alt="CAPTCHA Image" /><br /><a href="#" onclick="document.getElementById('captcha').src = '/libs/securimage/securimage_show.php?' + Math.random();
                                        return false">New Captcha</a>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Code Above" name="captcha_code" size="10" maxlength="6" />
                            </div>
                            <button type="submit" class="btn btn-default text-center" id="regBut">Register</button>
                            <input type="hidden" name="fid" value="{$fid}" />
                        </form>
                    {/if}
                </div>
            </div>
        </div>
        <hr />
    </body>
</html>