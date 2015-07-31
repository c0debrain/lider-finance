<?php
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/investor/history/bill/index.php');
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
	$investor->deposits_values($vklad_on, $id);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lider finance - Кабинет инвестора</title>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link href="https://lider-finance.ru/investor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="https://lider-finance.ru/investor/bootstrap/js/bootstrap.js"></script>
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
          <h4><?php echo "Добро пожаловать, уважаемый ".$firstname." ".$lastname;$investor->user_get_balance_1($vklad_on,$id); ?></h4>
        </div>
        <div class="col-lg-4"></div>
      </div>
        </div>
        <div class="row">
        	<div class="col-lg-3">
    			<a href="#" class="list-group-item active">
				    <h4><?php echo $firstname." ".$lastname; ?></h4>
				</a>
        	  	<ul class="list-group">
				  <?php $investor->get_user_invest_info($id,$vklad_on); ?>
				</ul>
        	</div>
        	<div class="col-lg-6" style="max-height: 300px">
        		<fieldset>
        			<legend>История счета</legend>
        				<?php $investor->get_history_bill($login,$id,$vklad_on); ?>
        		</fieldset>
        	</div>
        	<div class="col-lg-3">
			   <div class="list-group">
				  <a href="https://lider-finance.ru/investor/" class="list-group-item">
				    Личный кабинет
				  </a>
				  <a href="https://lider-finance.ru/investor/history/bill/" class="list-group-item active">История счета
				  </a>

				  <a href="https://lider-finance.ru/investor/payments/" class="list-group-item">Вывести средства
				  </a>

                   <a href="https://lider-finance.ru/investor/batch/" class="list-group-item">
                       Ввести batch код
                   </a>

                   <?php
                   if($vklad_on == 1 && $myrow['review'] == 'NULL'){
                   echo<<<HERE
                   <a href="https://lider-finance.ru/investor/review/" class="list-group-item">
                       Оставить отзыв
                   </a>
HERE;
                   }
                   ?>

                   <a href="https://lider-finance.ru/investor/exit.php" class="list-group-item">Выход
				  </a>
				</div>
        	</div>
        </div>
      </div>
    </div>

<?php $html->footer(); ?>

  </body>
</html>