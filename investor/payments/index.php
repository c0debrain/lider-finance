<?php
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/investor/payments/index.php');
}
if(isset($_POST['ok'])){
    setcookie('error', true, time()+60);
    setcookie('perfect_user', $_POST['payee'], time()+60);
    setcookie('payment', $_POST['payment'], time()+60);
    header('Location: https://lider-finance.ru/investor/payments/finish.php');
}
session_start();

error_reporting(0);

header('Content-Type: text/html; charset=utf-8');
$login = $_SESSION['login'];
$id = $_SESSION['id'];
$save = $_SESSION['save'];
if(empty($login) AND empty($id)) {
    header('Location: https://lider-finance.ru/');
}
include($_SERVER["DOCUMENT_ROOT"]."/investor/system/core.php");
$investor = new investor;//инициализация
$html = new html;
$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
    mysql_select_db ("u6761949_default",$db);
	mysql_query("SET NAMES utf8");
	$result = mysql_query("SELECT * FROM users WHERE client_login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysql_fetch_array($result);
    $review = $myrow['review'];
	$firstname = $myrow['client_firstname'];
	$lastname = $myrow['client_lastname'];
	$vklad_on = $myrow['vklad_on'];
	$investor->deposits_values($vklad_on, $id);
    $ok = $_POST['ok'];
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
    <link href="https://lider-finance.ru/investor/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
  </head>

  <body>

    <div id="wrap">
      <?php $html->nav($vklad_on); ?>
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
        			<legend>Вывод средств</legend>
                    <?php
                        if($vklad_on >= 1) {
                            $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
                            mysql_select_db ("u6761949_default",$db);
                            mysql_query("SET NAMES utf8");
                            $result = mysql_query("SELECT * FROM deposits WHERE investor_id='$id'",$db);
                            $sum = 0;
                            $sum_c = 0;
                            while($myrow = mysql_fetch_array($result)){
                                $capital = $myrow['income_deposits'];
                                $sum += $capital;
                                $capital_c = $myrow['out_deposits'];
                                $sum_c += $capital_c;
                            }
                    ?>
                    <p>Ваш депозит:<?php echo $sum;?>$</p><p>Ваш депозит(c коммисией):<?php echo $sum_c;?>$</p>
                    <form action='index.php' method='POST'>
                        <div class='form-group'>
                            <label for='exampleInputPassword'>Ваш аккаунт в Perfect Money</label>
                            <p><input class='form-control input-small' name='payee' type='text' required></p>
                            <label for='exampleInputPassword'>Переводимые средства</label>
                            <div class="input-group" style="max-width: 200px;">
                            <span class="input-group-addon">$</span>
                            <input type='number' name='payment' class='form-control' required onchange="if ((this.value > 0) && (this.value <= <?php echo $sum_c; ?>)) {getElementById('OutDeposit').disabled = false;}else{getElementById('OutDeposit').disabled = true;}""><br>
                            </div><br>
                            <p><button id='OutDeposit' type='submit' name='ok' class='btn btn-default btn-info'>Перевести средства на счет</button></p><br>
                        </div>
                    </form>
                    <?php
                        $investor->payment($id);
                    ?>
                    <hr><p>На данный момент вывод и ввод средст осуществляется при помощи платежной системы <a href='https://perfectmoney.is'>Perfect Money</a>.
                        Для вывода средств из нашей системы Вам необходимо знать лишь свой логин в данный платежной системе. Например, U*******.</p><br>
        			<?php
                        } else {
                            echo "
                                <p>У вас нет ни одного вклада, чтобы вывести средства.
        			            Для начала <a href='https://lider-finance.ru/investor/deposits'>откройте свой первый вклад
        			            </a>.</p><hr><p>На данный момент вывод и ввод средст осуществляется при помощи
        			            платежной системы <a href='https://perfectmoney.is'>Perfect Money</a>.
        			            Для вывода средств из нашей системы Вам необходимо знать лишь свой логин в
        			            данный платежной системе. Например, U*******.</p>";
                        }
                    ?>
        		</fieldset>
        	</div>
        	<div class="col-lg-3">
			   <div class="list-group">
				  <a href="https://lider-finance.ru/investor/" class="list-group-item">
				    Личный кабинет
				  </a>
				  <a href="https://lider-finance.ru/investor/history/bill/" class="list-group-item">
				    История счёта
				  </a>
				  <a href="https://lider-finance.ru/investor/payments/" class="list-group-item active">
                      Вывести средства
				  </a>
                   <a href="https://lider-finance.ru/investor/batch/" class="list-group-item">
                       Ввести batch код
                   </a>

                   <?php
                   if($vklad_on == 1 && $review == 'NULL'){
                   echo<<<HERE
                   <a href="https://lider-finance.ru/investor/review/" class="list-group-item">
                       Оставить отзыв
                   </a>
HERE;
                   }
                   ?>

				  <a href="https://lider-finance.ru/investor/exit.php" class="list-group-item">
                      Выход
				  </a>
				</div>
        	</div>
        </div>
      </div>
    </div>

<?php $html->footer(); ?>

  </body>
</html>