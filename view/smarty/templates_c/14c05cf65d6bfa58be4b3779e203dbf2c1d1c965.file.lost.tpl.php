<?php /* Smarty version Smarty-3.1.17, created on 2015-02-17 13:30:30
         compiled from "view/smarty/templates/lost.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34390449654e388c6ae3b38-39086018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14c05cf65d6bfa58be4b3779e203dbf2c1d1c965' => 
    array (
      0 => 'view/smarty/templates/lost.tpl',
      1 => 1424137337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34390449654e388c6ae3b38-39086018',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54e388c6b0dbe6_83606239',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e388c6b0dbe6_83606239')) {function content_54e388c6b0dbe6_83606239($_smarty_tpl) {?><!DOCTYPE html>  
<html>  
    <head>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <title>Kenyon EX Collegian</title>
        <!-- Bootstrap -->  
        <link href="../view/bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
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
                    <h1 class="text-center">Lost?</h1>
                </div>
                <img src="../img/crest.jpg" align="center" /><br /><br />
                You tried to access a URL that does not exist. Perhaps this was an accident, but if not please refrain from attempting to construct your own URL on this site.<br /><br />
                If you get this error too many times, we will ban you from the site as a security risk. Please click <a href="/">here</a> to return to the main page.
                <div class="modal-footer" style="text-align:center;">
                    <i>&quot;No period of my life has been one of such unmixed happiness as the four years which have been spent within college walls.&quot;<br /> <b>Horatio Alger</b></i>
                </div>
            </div>
        </div>
    </body>  
</html> <?php }} ?>
