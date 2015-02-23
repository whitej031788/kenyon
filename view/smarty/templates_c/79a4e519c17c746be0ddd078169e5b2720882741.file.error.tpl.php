<?php /* Smarty version Smarty-3.1.17, created on 2015-02-17 10:19:44
         compiled from "view/smarty/templates/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:137539819354e35c104818f1-08675096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79a4e519c17c746be0ddd078169e5b2720882741' => 
    array (
      0 => 'view/smarty/templates/error.tpl',
      1 => 1424137337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137539819354e35c104818f1-08675096',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54e35c104ab8e4_01925002',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e35c104ab8e4_01925002')) {function content_54e35c104ab8e4_01925002($_smarty_tpl) {?><!DOCTYPE html>  
<html>  
    <head>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <!-- Bootstrap -->  
        <link href="../view/bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <title>Kenyon EX Collegian</title>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Old%20Standard%20TT">
        <style>
            body
            {
                background: url('../img/background.jpg') no-repeat center center fixed;
                /* background-color:#790FAB;*/
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
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
        <script type="text/javascript" src="../view/bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>  
        <script type="text/javascript" src="../view/js/intro.js"></script>

        <div class="modal-dialog" style="padding-top:110px;">
            <div class="modal-content" id="modlogin" style="text-align:center;">
                <div class="modal-header">
                    <h1 class="text-center">Error!</h1>
                </div>
                <img src="../img/phil.jpg" align="center" /><br /><br />
                Oops! We encountered a fatal server error while processing your request. The details of the error have been sent to the site administrator.<br /><br />
                Please click <a href="/">here</a> to return to the main site. <br /><br />We apologize for any inconveniance.
                <div class="modal-footer" style="text-align:center;">
                    <i>&quot;No period of my life has been one of such unmixed happiness as the four years which have been spent within college walls.&quot;<br /> <b>Horatio Alger</b></i>
                </div>
            </div>
        </div>
    </body>  
</html> <?php }} ?>
