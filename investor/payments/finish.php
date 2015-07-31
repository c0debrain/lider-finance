<?php
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/investor/payments/finish.php');
}
error_reporting(0);

header('Content-Type: text/html; charset=utf-8');

$login = $_SESSION['login'];
$id = $_SESSION['id'];
$save = $_SESSION['save'];
include($_SERVER["DOCUMENT_ROOT"]."/investor/system/core.php");
$investor = new investor;//инициализация
$html = new html;
$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
mysql_select_db ("u6761949_default",$db);
mysql_query("SET NAMES utf8");
$result = mysql_query("SELECT * FROM users WHERE client_login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysql_fetch_array($result);
$firstname = $myrow['client_firstname'];
$lastname = $myrow['client_lastname'];
$vklad_on = $myrow['vklad_on'];
$investor->deposits_values($vklad_on, $id);
$perfect_user = $_COOKIE['perfect_user'];
$payment = $_COOKIE['payment'];
$error = $_COOKIE['error'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Вывод средств</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="https://lider-finance.ru/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 700px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="https://lider-finance.ru/assets/css/bootstrap-responsive.css" rel="stylesheet">


      <script src="http://lider-finance.ru/assets/js/html5shiv.js"></script>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://lider-finance.ru/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://lider-finance.ru/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://lider-finance.ru/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="https://lider-finance.ru/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="https://lider-finance.ru/assets/ico/favicon.png">
  </head>

  <body>

    <?php

    if($error == true){
    echo<<<HERE
                        <div class="container">
	                        <div class="form-signin">
                                <h2 class="form-signin-heading">Вывод средств</h2>
		                        <h4>Успех!</h4>
		                        <p style="margin-top: 15px;" class="text-center"><img src="https://lider-finance.ru/assets/img/hr.png"><p>
		                        <p class="text-center">Денежные средства в размере $payment$, были успешно переведены на счёт $perfect_user.<br> Деньги должны начислиться сразу. Если у вас возникли проблеммы, пожалуйста, обратитесь в <a href="https://lider-finance.ru/supp.php">службу поддержки</a>.<br>Спасибо за ваше доверие Lider-finance.</p>
		                        <p style="margin-top: 15px;" class="text-center"><img src="https://lider-finance.ru/assets/img/hr.png"><p>
	                            <div class="row-fluid">
		                            <div class="span12 text-center">
			                            <a href="https://lider-finance.ru/investor/" class="btn btn-success" />Перейти в личный кабинет</a>
		                            </div>
	                            </div>
	                        </div>
                        </div>
HERE;

    } else {
    echo<<<HERE
                        <div class="container">
	                        <div class="form-signin">
                                <h2 class="form-signin-heading">Oops</h2>
		                        <p style="margin-top: 15px;" class="text-center"><img src="https://lider-finance.ru/assets/img/hr.png"><p>
		                        <p class="text-center">Произошло что то не так. Вы либо не должны быть здесь, либо произошла ошибка Perfect Money при выводе средств.<br> Если у вас возникли проблеммы, пожалуйста, обратитесь в <a href="https://lider-finance.ru/supp.php">службу поддержки</a>.<br>Спасибо за ваше доверие Lider-finance.</p>
		                        <p style="margin-top: 15px;" class="text-center"><img src="https://lider-finance.ru/assets/img/hr.png"><p>
	                            <div class="row-fluid">
		                            <div class="span12 text-center">
			                            <a href="https://lider-finance.ru/investor/" class="btn btn-success" />Перейти в личный кабинет</a>
		                            </div>
	                            </div>
	                        </div>
                        </div>
HERE;
    }
    ?>

    <script src="https://lider-finance.ru/assets/js/jquery.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-transition.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-alert.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-modal.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-dropdown.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-scrollspy.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-tab.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-tooltip.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-popover.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-button.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-collapse.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-carousel.js"></script>
    <script src="https://lider-finance.ru/assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
