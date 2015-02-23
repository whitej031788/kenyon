<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <title>Kenyon EX Collegian</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="/view/bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/view/bootstrap-3.0.0/dist/css/carousel.css" rel="stylesheet" media="screen">
        <style>
            html, body
            {
                background: url('/img/background.jpg') no-repeat center center fixed;
                /* background-color:#790FAB;*/
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                height:100%;
            }

            .container.myCont
            {
                background: #f5f6f6; /* Old browsers */
                background-repeat: no-repeat;
                background-size: cover;
                background-size: 100% auto;
                background: -moz-radial-gradient(center, ellipse cover, #f5f6f6 0%, #dbdce2 21%, #b8bac6 49%, #dddfe3 80%, #f5f6f6 100%); /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#f5f6f6), color-stop(21%,#dbdce2), color-stop(49%,#b8bac6), color-stop(80%,#dddfe3), color-stop(100%,#f5f6f6)); /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover, #f5f6f6 0%,#dbdce2 21%,#b8bac6 49%,#dddfe3 80%,#f5f6f6 100%); /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover, #f5f6f6 0%,#dbdce2 21%,#b8bac6 49%,#dddfe3 80%,#f5f6f6 100%); /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover, #f5f6f6 0%,#dbdce2 21%,#b8bac6 49%,#dddfe3 80%,#f5f6f6 100%); /* IE10+ */
                background: radial-gradient(ellipse at center, #f5f6f6 0%,#dbdce2 21%,#b8bac6 49%,#dddfe3 80%,#f5f6f6 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f5f6f6', endColorstr='#f5f6f6',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
                border: 1px solid #000;
            }
            .midTime
            {
                display:none;
            }
            #jwPlayDiv
            {
                min-height: 450px;
            }
            @media (max-width: 1000px)
            {
                #jwPlayDiv
                {
                    min-height: 0px !important;
                }
            }
            @media (max-width: 991px)
            {
                .nav.navbar-nav.navbar-right
                {
                    float:left !important;
                }
            }
            @media (max-width:1200px)
            {
                li.paginate_button
                {
                    display:none !important;
                }
                #videoTable_next, #videoTable_first, #videoTable_last, #videoTable_previous
                {
                    display:inline-block !important;
                }
            }
            @media (max-width:769px)
            {
                #videoTable_last, #videoTable_first
                {
                    display:none !important;
                }
            }
            #videoTable td
            {
                border-right:1px solid black;
            }
            table.has-columns-hidden > tbody > tr > td > span.responsiveExpander {
                background: url('../img/plus.png') no-repeat 5px center;
                padding-left: 32px;
                cursor: pointer;
            }

            table.has-columns-hidden > tbody > tr.detail-show > td span.responsiveExpander {
                background: url('../img/minus.png') no-repeat 5px center;
            }

            table.has-columns-hidden > tbody > tr.row-detail > td {
                background: #eee;
            }

            table.has-columns-hidden > tbody > tr.row-detail > td > ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            table.has-columns-hidden > tbody > tr.row-detail > td > ul > li > span.columnTitle {
                font-weight: bold;
            }
            .modal-dialog
            {
                width:90%;
                max-width:900px;
            }
            .usersTable td
            {
                border:none;
            }
            .even
            {
                background-color:lightgray !important;
            }
            .odd
            {
                background-color:white !important;
            }
            .dataTables_wrapper
            .paginate_button,
            .dataTables_wrapper
            .paginate_active{
                float:center;

            }

            div.dataTables_paginate {
                float: center;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="bootstrap-3.0.0/assets/js/html5shiv.js"></script>
          <script src="bootstrap-3.0.0/assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="/view/DataTables-1.10.0/media/css/jquery.dataTables.css">
        <link rel="stylesheet" href="/view/jquery-ui-1.10.4/css/ui-lightness/jquery-ui-1.10.4.css" />
        <link rel="stylesheet" href="/view/css/login.css" />
        <script type="text/javascript" src="//code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="/view/js/jwplayer/jwplayer.js"></script>
        <script type="text/javascript" src="/view/bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/view/jquery-ui-1.10.4/js/jquery-ui-1.10.4.js"></script>
        <script type="text/javascript" charset="utf8" src="/view/DataTables-1.10.0/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="/view/js/login.js"></script>
        <script type="text/javascript" charset="utf8" src="/view/js/datatables.responsive.js"></script>
        <div class="container myCont">
            <div class="navbar-wrapper">
                <div class="container">

                    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand">Kenyon Ex Collegian</a>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li {if $type eq "home"}class="active"{/if}><a href="/Login">Home</a></li>
                                    <li {if $type eq "videos"}class="active"{/if}><a href="/Login/Videos">Videos</a></li>
                                    <li {if $type eq "account"}class="active"{/if}><a href="/Login/Account">My Account</a></li>
                                    <li><a href="/Login/LogOut">Log Out</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="mailto:whitej031788@gmail.com">Contact Us</a></li>
                                            <li><a href="#" class="comSoon">KEC Store</a></li>
                                            <li><a href="#" class="comSoon">Site Help</a></li>
                                            <li class="divider"></li>
                                            <li class="dropdown-header">Other Sites</li>
                                            <li><a href="http://www.kenyon.edu" target="_blank">Kenyon Website</a></li>
                                            <li><a href="http://athletics.kenyon.edu/index.aspx?path=msoc" target="_blank">Kenyon Mens Soccer</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a>{$UserName}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container marketing">
                <hr class="featurette-divider">
                <hr class="featurette-divider">

                {if $type eq "home"}

                    <div class="row featurette">
                        <div class="col-md-12" style="font-size:13pt;">
                            Welcome to the Kenyon Ex Collegian. All of these videos were recorded by a flip video camera, with a couple of Go Pro exceptions. Feel free to browse the videos, comment on them, vote them up or down. One thing we ask is to please
                            not give access of this site to unauthorized parties. Enjoy!
                        </div>
                    </div>

                    <div class="row featurette">
                        <div class="col-md-4">
                            <h2 class="featurette-heading">KEC <span class="text-muted">Featured Video</span></h2>
                            <p class="lead">{if !isset($vidDescrip)} There is currently no featured video to display.{else}{$vidDescrip}{/if}</p>
                        </div>
                        <div class="col-md-8" id="jwPlayDiv">
                            <h2 class="featurette-heading"><span class="text-muted">{if !isset($vidName)} {else}{$vidName}{/if}</span></h2>
                            {if !isset($vidPath)}<div style="margin:0 auto;text-align:center;"><img src="/img/phil.jpg" align="center"></div> {else}<div id="myMedia">Loading the player...</div>
                                <script type="text/javascript">
                                    jwplayer("myMedia").setup({ldelim}
                                            file: "{$vidPath}",
                                            width: "100%",
                                            aspectratio: "12:5",
                                            events: {
                                                onReady: loadFooter()
                                            }
                                    {rdelim});
                                </script>{/if}
                            </div>
                        </div>
                    </div>
                {elseif $type eq "videos"}
                    <div class="row featurette">
                        <div class="col-md-12" style="font-size:13pt;">
                            <h1 class="featurette-heading" style="margin-top:0px !important;font-size:22pt !important;">Below are all the videos we currently have uploaded to the site. <span class="text-muted">You can search and filter; once you find the video you are looking for,
                                    simply click on the link in the far right column.</span></h1>
                        </div>
                        <hr class="featurette-divider">
                        <div class="col-md-12 table-responsive">
                            <table id="videoTable" class="table" style="padding:5px;" style="border:1px solid black;">
                                <thead>
                                    <tr style="background-color:#545763;color:#f0f0f0;">
                                        <th> Video Name </th>
                                        <th> Description </th>
                                        <th> Watch Video! </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td></td><td></td><td></td></tr>
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade bs-example-modal-lg" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="model-header" style="padding:15px;font-size:18pt !important;">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="jwplayer('myVideoMedia').stop();">×</button>
                                    <h2 class="modal-title" id="videoTitle" style="text-align:center;">Large modal</h2>
                                    <hr class="featurette-divider" style="margin:10px !important;">
                                </div>
                                <div class="modal-body" id="videoBody">
                                    Body
                                </div>
                                <div class="modal-footer" style="text-align:center;">
                                    <div class="col-md-12" id="videoFooter">
                                        Footer
                                    </div>
                                    {if isset($isAdmin) AND $isAdmin eq "1"}
                                        <br />
                                        <div class="row">
                                            <form class="form col-md-6 center-block" id="adminUpdate">
                                                <div id="adminSuccess"></div>
                                                <input type="hidden" name="currentVidId" id="currentVidId" value="">
                                                <label>Disable Video&nbsp;</label><input type="checkbox" name="disableVid" id="disableVid">
                                                <div class="form-group">
                                                    <label>New Vid Name</label><input type="text" class="form-control input-sm" name="newName" id="newName">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Vid Descrip</label><textarea name="newDescrip" id="newDescrip" style="width:100%" rows="3"></textarea>
                                                </div>
                                                <button class="btn">Change</button>
                                            </form>
                                            <div class="col-md-6">
                                                <table align="center" class="usersTable" style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;text-align:left;">
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
                                        </div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                {else}
                    <script type="text/javascript" src="/view/js/register.js"></script>
                    <div class="row featurette">
                        <div class="col-md-12" style="font-size:13pt;text-align:center;">
                            Manage your account settings:
                        </div>
                    </div>
                    <div class="row featurette">
                        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                            <form role="form" id="acctForm" action="/Login/Account" method="POST">
                                <hr class="colorgraph">
                                {if isset($update) AND $update eq "success"}<span style="font-size:12pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;color:green;text-decoration:italics;" id="acctSuccess">We have updated your account successfully</span>{/if}
                                <span style="font-size:10pt; font-family:Century Gothic, Arial, Courier New, Sans-Serif;color:red;text-decoration:italics;" id="acctRegErr"></span>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label><input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="{$FNAME}" tabindex="1" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label><input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="{$LNAME}" tabindex="2" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>User Name</label><input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="{$UserName}" tabindex="3" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Email</label><input type="email" name="acctEmail" id="acctEmail" class="form-control input-lg"  value="{$EMAIL}" tabindex="4">
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="font-size:13pt;text-align:center;">
                                        Change your password below:
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="font-size:13pt;text-align:center;">
                                        *Must have at least 6 characters one number and one letter:
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="acctNewPass" id="acctNewPass" class="form-control input-lg" placeholder="New Password" tabindex="5">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="acctNewPassConf" id="acctNewPassConf" class="form-control input-lg" placeholder="Confirm New Password" tabindex="6">
                                        </div>
                                    </div>
                                </div>
                                <hr class="colorgraph">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12"><input type="submit" value="Submit Changes" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                {/if}
                <div class="container marketing">
                    <div class="row featurette">
                        <div class="col-md-12">
                            <div id="midTime">
                                <hr class="featurette-divider" style="margin-bottom:20px !important;">

                                <p>&copy; Jamie White Company, Inc. &middot;</p>
                                <p>Gambier, OH 43022</p>

                                <hr class="featurette-divider" style="margin-top:20px !important;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="comSoonDial" class="col-md-12">
                Coming Soon!
            </div>
        </body>
    </html>