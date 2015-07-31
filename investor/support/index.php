<?php
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/investor/support/index.php');
}
if    (empty($_SESSION['login']) AND empty($_SESSION['id'])) 
{
header('Location: index.php');
}
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


$supp = <<<HERE
    <div class="container"">
        <div class="form-supp">
            <h2 class="form-supp-heading">Служба технической поддержки Lider-finance</h2>
		    <h4><small>Пожалуйста, прочтите <a href='https://lider-finance.ru/faq.php'>FAQ</a> до того, как задавать свой вопрос. Возможно на ваш вопрос уже ответили.</small></h4>
		    <form method='post' action='https://lider-finance.ru/supp.php#bottom'>
		        <select class="form-control" name='select'>
                    <option value='Техническая поддержка'>Техническая поддержка</option>
                    <option value='Пополнение/вывод средств'>Пополнение/вывод средств</option>
                    <option value='Реклама и мониторинг'>Реклама и мониторинг</option>
                    <option value='Отзывы и предложения'>Отзывы и предложения</option>
                </select><br>
		        <input type="email" class="form-control" id="email" name="email" required placeholder="Введите вашу эл. почту"><br>
		        <textarea name='text' placeholder='Сообщение' class='form-control' style='width: 100%;' required rows='6' cols='60'></textarea><br>
		        <input type='submit' class='btn btn-success' name='send' value='Отправить письмо'>
		    </form>
	    </div>
    </div>
HERE;

if($_POST['send']){
    $to = 'support@lider-finance.ru';
    //$to = 'steelwill.mark@yandex.ru';
    $subject = $_POST['select']." от ".$_POST['email']." «Lider finance»";
    $message = $_POST['text'];
    mail($to,$subject,$message);
    $supp = <<<HERE
    <div class="container">
        <div class="form-supp">
            <div class="text-center">
            <h2 class="form-supp-heading">Служба технической поддержки Lider-finance</h2></div>
		    <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
            <p class="text-center">Письмо успешно отправленно в службу технической поддержки, ожидайте ответа в течении нескольких дней</p>
	        <div class="row-fluid">
		        <div class="span12 text-center">
			        <a href="https://lider-finance.ru" class="btn btn-success" />На главную страницу</a>
		        </div>
	        </div>
	    </div>
    </div>
HERE;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lider finance - Кабинет инвестора</title>

    <!-- Bootstrap core CSS -->
    <link href="https://lider-finance.ru/investor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://lider-finance.ru/investor/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
      <style type="text/css">
          body {
              margin: 0;
              padding:0;
          }

          .form-supp {
              margin: 0 auto 0;
              background-color: #fff;
              border: 0px solid #e5e5e5;
              -webkit-border-radius: 5px;
              -moz-border-radius: 5px;
              border-radius: 5px;
              -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
              -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
              box-shadow: 0 1px 2px rgba(0,0,0,.05);
          }
          .form-supp .form-supp-heading,
          .form-supp .checkbox {
              margin-bottom: 10px;
          }
          .form-supp input[type="text"],
          .form-supp input[type="password"] {
              font-size: 16px;
              height: auto;
              margin-bottom: 15px;
              padding: 7px 9px;
          }
      </style>
  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">

     <?php $html->nav($vklad_on); ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <div class="row">
        <div class="col-lg-8">
          <h4><?php echo "Добро пожаловать, уважаемый ".$firstname." ".$lastname; $investor->user_get_balance_1($vklad_on,$id); ?></h4>
        </div>
        <div class="col-lg-4"></div>
      </div>
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<ul class="breadcrumb">
				  <li><a href="https://lider-finance.ru/investor/">Профиль</a></li>
				  <li class="active">Поддержка</a></li>
				</ul>
        	</div>
        </div>
		<?php echo $supp; ?>
      </div>
    </div>

    <?php $html->footer(); ?>

  </body>
</html>