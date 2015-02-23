<!DOCTYPE html>  
<html>  
    <head>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <title>Kenyon EX Collegian</title>
        <!-- Bootstrap -->  
        <link href="view/bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Old%20Standard%20TT">
        <style>
            .kcLetOne
            {
                font-style: italic;
                color:purple;
                font-weight:bold;
                font-size:24pt;
                font-family: Old Standard TT;
            }
            .kcLetTwo
            {
                font-style: italic;
                color:red;
                font-weight:bold;
                font-size:24pt;
                font-family: Old Standard TT;
            }
            body
            {
                background: url('img/background.jpg') no-repeat center center fixed;
                /* background-color:#790FAB;*/
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            textarea#whyAdd {
                resize: none !important;
            }
            @media(max-width:438px)
            {
                .kcLetTwo
                {
                    font-size:16pt;
                }
                .kcLetOne
                {
                    font-size:16pt;
                }
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->  
        <!--[if lt IE 9]>  
          <script src="bootstrap-3.0.0/assets/js/html5shiv.js"></script>  
          <script src="bootstrap-3.0.0/assets/js/respond.min.js"></script>  
        <![endif]-->  
    </head>  
    <body>  
        <script type="text/javascript" src="//code.jquery.com/jquery.js"></script>  
        <script type="text/javascript" src="/view/bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/view/jquery-ui-1.10.4/css/ui-lightness/jquery-ui-1.10.4.css" />
        <script type="text/javascript" src="/view/jquery-ui-1.10.4/js/jquery-ui-1.10.4.js"></script>
        <script type="text/javascript" src="/view/js/intro.js"></script>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header" style="padding:10px !important;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.kenyon.edu" target="_blank"><span class="kcLetOne">Kenyon</span>&nbsp;&nbsp;<span class="kcLetTwo">EX</span>&nbsp;&nbsp;<span class="kcLetOne">Collegian</span></a>
            </div>
            <div class="container-fluid">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" style="padding:10px !important;">
                        <li {if !isset($BadReg) OR $BadReg neq 'True'}class="active"{/if} id="logli"><a href="#" onclick="toggleNav('login');">Login</a></li>
                        <li {if isset($BadReg) AND $BadReg eq 'True'}class="active"{/if} id="regli"><a href="#" onclick="toggleNav('register');">Register</a></li>
                        <li id="abtli"><a href="#" onclick="toggleNav('about');">About</a></li>
                        <li id="contli"><a href="#" onclick="toggleNav('contact');">Contact</a></li>
                        <li id="joinli"><a href="#" onclick="toggleNav('join');">Join Up</a></li>
                        <!---<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>--->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="modal-dialog" style="padding-top:110px;">
            <div class="modal-content" id="modlogin" {if isset($BadReg) AND $BadReg eq 'True'}style="display:none;"{/if}>
                <div class="modal-header">
                    <h1 class="text-center">Kenyon Login</h1>
                </div>
                <div class="modal-body">
                    {if isset($isLive) AND $isLive EQ 1}
                        <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">This site contains a not so brief summary of the college experience, seen through the eyes of a group of Kenyon College Alumni. 
                            Please login below; if you are not registered, enter in your first name, last name, and graduation year on the <a href="#" onclick="toggleNav('register');">Registration</a> tab. 
                            If you are an authorized 'friend', you will be taken to the registration page. 
                            Any info you give will not be used for anything except allowing you access to this video documentary.</span><br /><br />
                        {if isset($badLog) AND $badLog EQ 'true'}<span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;color:red;text-decoration:italics;">We do not
                                show that as a valid login. Please contact the site admin to have your password reset or use the <a href="#" class="forPass">Forgot Password</a> link.</span><br />{/if}<br />
                            <form class="form col-md-12 center-block" method='POST' action='/'>
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" placeholder="Username" name='login'>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control input-lg" placeholder="Password" name='passTime'>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg btn-block">Sign In</button>
                                </div>
                            </form>
                            <span style="font-size:8pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;"><a href="#" id="forUser">Forgot Username?</a></span>
                            <span style="font-size:8pt; text-align:right;float:right; font-family:Century Gothic, Arial, Courier New, Sans-Serif;"><a href="#" class="forPass">Forgot Password?</a></span>
                        {else}
                            <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">The site is currently under construction and not allowing logins/registrations. Check back soon!</span>
                        {/if}
                    </div>          
                    <div class="modal-footer" style="text-align:center;">
                        <i>&quot;No period of my life has been one of such unmixed happiness as the four years which have been spent within college walls.&quot;<br /> <b>Horatio Alger</b></i>
                    </div>
                </div>
                <div class="modal-content" id="modreg"  {if !isset($BadReg) OR $BadReg neq 'True'}style="display:none;"{/if}>
                    <div class="modal-header">
                        <h1 class="text-center">Friends Register</h1>
                    </div>
                    <div class="modal-body">
                        {if isset($isLive) AND $isLive EQ 1}
                            {if isset($BadReg) AND $BadReg eq 'True'}<span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;color:red;text-decoration:italics;">There was a problem with 
                                    your registration; either we do not have you as a registered friend, which means you need to <a href="#" onclick="toggleNav('join');">Join Up</a>, or you already have a valid login. Contact the site admin with questions.</span><br /><br />{/if}
                                <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">Please fill out your first name, last name and graduation year below. If those are valid,
                                    you will be taken through registration where you can create your login credentials.</span><br /><br />
                                <form class="form col-md-12 center-block" action="/Registration" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" placeholder="First Name" name="fname">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" placeholder="Last Name" name="lname">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bfh-number input-lg" placeholder="Graduation Year" maxlength="4" name="year">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-lg btn-block">Register</button>
                                    </div>
                                    <input type="hidden" name="hidRegVal" value="newRegTrue">
                                </form>
                            {else}
                                <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">The site is currently under construction and not allowing logins/registrations. Check back soon!</span>
                            {/if}
                        </div>
                        <div class="modal-footer" style="text-align:center;">
                            <i>&quot;No period of my life has been one of such unmixed happiness as the four years which have been spent within college walls.&quot;<br /> <b>Horatio Alger</b></i>
                        </div>
                    </div>
                    <div class="modal-content" id="modjoin" style="display:none;">
                        <div class="modal-header">
                            <h1 class="text-center">Join Up</h1>
                        </div>
                        <div class="modal-body">
                            {if isset($isLive) AND $isLive EQ 1}
                                <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">Please enter the information requested below.
                                    This will be reviewed by the site administrator to determine whether you will be added as a registered friend. Please provide a valid email so the 
                                    admin can get back to you about site access.</span><br /><br />
                                <form class="form col-md-12 center-block" id="formFriendReq">
                                    <div id="errorReg">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" placeholder="First Name" id="newfirst">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" placeholder="Last Name" id="newlast">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bfh-number input-lg" placeholder="Graduation Year" maxlength="4" id="newyear">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" placeholder="Email" id="newemail">
                                    </div>
                                    <div class="form-group">
                                        <textarea style="width:100%" placeholder="Why should you be granted access? IE How do I know you?" rows="3" id="whyAdd"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-lg btn-block" id="friendReq">Send Request</button>
                                    </div>
                                </form>
                            {else}
                                <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">The site is currently under construction and not allowing logins/registrations. Check back soon!</span>
                            {/if}
                        </div>
                        <div class="modal-footer" style="text-align:center;">
                            <i>&quot;No period of my life has been one of such unmixed happiness as the four years which have been spent within college walls.&quot;<br /> <b>Horatio Alger</b></i>
                        </div>
                    </div>
                    <div class="modal-content" id="modabout" style="display:none;">
                        <div class="modal-header">
                            <h1 class="text-center">About</h1>
                        </div>
                        <div class="modal-body">
                            <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">The Kenyon EX Collegian is a web site dedicated to Kenyon College and, more specifically, a group of friends that attended the college for four years, between 2006-2010. <br /><br />
                                Kenyon is located in the small town of Gambier, Ohio, about 45 minutes from Columbus. There are about 1,600 students that attend the college. You will NOT get an accurate depiction of this student body of 1,600 from this website.<br /><br /> Rather, you will see the college experience through the eyes of a group of students who were fully aware that, whilst we all go to college to get a degree, good grades and aced tests would not be the memories that lasted through the years.  <br /><br /> My name is Jamie White, although many people close to me tend to call me J-Weezy. I am an IT specialist / software engineer who has thoroughly enjoyed putting this website together to share these videos with friends/family.
                                Below is a list of my immediate classmates, the stars of these videos. In case they did not want their names spelled out, I have taken to using nicknames, some well known and some that I only just made up. Thanks to everyone below, along with tons of others not named, for the memories:</span><br />
                            <table align="center" style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">
                                <ol>
                                    <tr><td><li>Statman</li></td>
                                    <td><li>Mockdolla</li></td></tr>
                                    <tr><td><li>ThunderC</li></td>
                                    <td><li>DonnieG</li></td></tr>
                                    <tr><td><li>Pfizzle</li></td>
                                    <td><li>Smaco</li></td></tr>
                                    <tr><td><li>DeboSlice</li></td>
                                    <td><li>DJTK</li></td></tr>
                                    <tr><td><li>Ratboy</li></td>
                                    <td><li>KingFisch</li></td></tr>
                                    <tr><td><li>Dad+Mom</li></td>
                                    <td><li>Beardlust</li></td></tr>
                                    <tr><td><li>Sheehan</li></td>
                                    <td><li>Kyman</li></td></tr>
                                </ol>
                            </table>
                        </div>
                        <div class="modal-footer" style="text-align:center;">
                            <i>&quot;No period of my life has been one of such unmixed happiness as the four years which have been spent within college walls.&quot;<br /> <b>Horatio Alger</b></i>
                        </div>
                    </div>
                    <div class="modal-content" id="modcont" style="display:none;">
                        <div class="modal-header">
                            <h1 class="text-center">Contact</h1>
                        </div>
                        <div class="modal-body">
                            <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;">If you would like to contact me, either with general questions about the site or if you have a need of a custom site built for your own needs, I can be reached only by email at:<br /><br />
                                <a href="mailto:whitej031788@gmail.com?subject=Site Contact" style="text-align:center;">whitej031788@gmail.com</a><br /><br />
                                If you would like to contact me via phone, you should really already have my phone number, so I have not provided it here.</span>
                        </div>
                        <div class="modal-footer" style="text-align:center;">
                            <i>&quot;No period of my life has been one of such unmixed happiness as the four years which have been spent within college walls.&quot;<br /> <b>Horatio Alger</b></i>
                        </div>
                    </div>
                </div>
                <div id="forUserDial" class="span12">Please enter the email address associated with<br />your account to have your username sent to you.<br /><br />
                    <input type="text" class="form-control input-lg" placeholder="Email" id="forgotUser"><br />
                    <button class="btn :hover btn-warning btn-block" id="forUserSub">Send Username</button></div>
                <div id="forPassDial" class="span12">
                    Please enter the email address associated with<br />your account to have your password reset.<br /><br />
                    <input type="text" class="form-control input-lg" placeholder="Email" id="forgotPass"><br />
                    <button class="btn :hover btn-warning btn-block" id="forPassSub">Reset Password</button>
                </div>
            </body>  
        </html> 