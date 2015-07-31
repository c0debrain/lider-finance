<?php
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/investor/deposits/the-first-capital/index.php');
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
				  <li><a href="https://lider-finance.ru/investor/deposits/">Вклады</a></li>
				  <li class="active">Вклад: "The First Capital"</li>
				</ul>
        	</div>
        </div>
		<div class="row">
        	<div class="col-lg-3 text-center">
        	 <ul class="list-group">
				  <a href="#" class="list-group-item active">
				    <h4>Вклад: The First Capital</h4>
				</a>
				  <li class="list-group-item">
				  	120% дохода за вклад на 60 дней
				  </li>
				  <li class="list-group-item">
				  	Инвестиционный лимит 301 — 1500 USD. 
				  </li>
				  <li class="list-group-item">
				  	Начисления на внутренний счет  1 раз в сутки <br>(на общую сумму 2% от суммы вклада).
				  </li>
			 </ul>
			</div>
			<div class="col-lg-6">
				<fieldset>
        			<legend>Открытие вклада</legend>
        			<p>Открытие счета производится одновременно с взносом денежных средств. Данный вклад ограничивается лимитом взноса средств.(301 — 1500 USD)</p>
				    <form class="form-horizontal" action='https://perfectmoney.com/api/step1.asp' method='POST' onkeypress="if(event.keyCode == 13) return false;">
					    <div class="control-group">
						    <label class="control-label">Сумма взноса:</label>
						    <div class="controls">
						    	<div class="input-group" style="max-width: 200px;">
								  <span class="input-group-addon">$</span>
								  <input type="number" name='PAYMENT_AMOUNT' class="form-control" onchange="if ((this.value >= 301) && (this.value <= 1500)) {getElementById('OutDeposit').disabled = false;}else{getElementById('OutDeposit').disabled = true;}">
								  <span class="input-group-addon">.00</span>
								</div>
							    <p class="help-block">Сумма взноса должна быть в диапозне от 301 — 1500 USD.</p>
						    </div>
					    </div>
					    <input type='hidden' name='PAYEE_ACCOUNT' value='U1875378'/>
				        <input type='hidden' name='PAYEE_NAME' value='Lider finance'/>
				        <input type='hidden' name='PAYMENT_ID' value='<?php echo $id."-thefirstcapital"; ?>'/>
				        <input type='hidden' name='PAYMENT_UNITS' value='USD'/>
				        <input type='hidden' name='STATUS_URL' value='https://lider-finance.ru/perfectmoney/status.php'/>
				        <input type='hidden' name='PAYMENT_URL' value='https://lider-finance.ru'/>
				        <input type='hidden' name='PAYMENT_URL_METHOD' value='POST'/>
				        <input type='hidden' name='NOPAYMENT_URL' value='https://lider-finance.ru'/>
				        <input type='hidden' name='NOPAYMENT_URL_METHOD' value='POST'/>
				        <input type='hidden' name='SUGGESTED_MEMO' value='Взнос средств на открытие вклада The First Capital.'/>
                        <p><button id='OutDeposit' type='submit' name='PAYMENT_METHOD' class='btn btn-default btn-info' disabled>Перейти к взносу средств</button></p><br>
				    </form>

        		</fieldset>
			</div>
			<div class="col-lg-3">
				
			</div>
        </div>
      </div>
    </div>
<?php $html->footer(); ?>
  </body>
</html>