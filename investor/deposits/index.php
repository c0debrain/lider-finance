<?php
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/investor/deposits/index.php');
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
				  <li class="active">Вклады</a></li>
				</ul>
        	</div>
        </div>
		<?php $investor->get_deposits_col($id,$vklad_on); ?>
      </div>
    </div>

    <?php $html->footer(); ?>

  </body>
</html>