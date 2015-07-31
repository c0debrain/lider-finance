<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/step2.php');
}

$client_firstname = $_POST['firstname'];
$client_lastname = $_POST['lastname'];
$client_email = $_POST['email'];
$client_phone = $_POST['phone'];
$client_secret = $_POST['secret'];
$client_country = $_POST['country1'];
$client_answer = $_POST['answer'];
$client_pr = $_POST['pr'];
$client_capcha = $_POST['capcha'];

if($client_capcha !== $_SESSION['capcha']){
    header("Location: https://lider-finance.ru/step1.php?wrong_capcha=1&firstname=$client_firstname&lastname=$client_lastname&email=$client_email&phone=$client_phone&secret=$client_secret&answer=$client_answer&pr=$client_pr");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Регистрация - Шаг 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
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
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>
    <div class="container">
	<div class="form-signin">
        <h2 class="form-signin-heading">Регистрация</h2>
		<h4>Шаг 2<small> - Проверьте введенные ранее данные.</small></h4>
		<p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
		<div class="row-fluid">
		<div class="span6 ">
			<p>Имя: <?php echo $client_firstname; ?></p>
			<p>Фамилия: <?php echo $client_lastname; ?></p>
			<p>Эл.почта: <?php echo $client_email; ?></p>
			<p>Телефон: +7 <?php echo $client_phone; ?></p>
			<p>Страна: <?php echo $client_country; ?></p>
			<p>Секретный вопрос: <?php echo $client_secret; ?></p>
			<p>Ответ на секретный вопрос: <?php echo $client_answer; ?></p>
			<p>Откуда узнал(a): <?php echo $client_pr; ?></p>
		</div>
		<div class="span6 text-center">
		</div>
		
		<p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
	<div class="row-fluid">
		<div class="span6 text-left">
		<form action="step1.php" method="post">
			<input type="hidden" name="edit" value="1"/>
			<input type="hidden" name="firstname" value="<?php echo $client_firstname; ?>"/>
			<input type="hidden" name="lastname" value="<?php echo $client_lastname; ?>"/>
			<input type="hidden" name="phone" value="<?php echo $client_phone; ?>"/>
			<input type="hidden" name="country" value="<?php echo $client_country; ?>"/>
			<input type="hidden" name="email" value="<?php echo $client_email; ?>"/>
			<input type="hidden" name="secret" value="<?php echo $client_secret; ?>"/>
			<input type="hidden" name="answer" value="<?php echo $client_answer; ?>"/>
			<input type="hidden" name="pr" value="<?php echo $client_pr; ?>"/>
			<input class="btn btn-info" type="submit" value="Изменить данные" /> 
		</form>
		</div>
		<div class="span6 text-right">
		<form action="step3.php" method="post">
			<input type="hidden" name="activation" value="1"/>
			<input type="hidden" name="firstname" value="<?php echo $client_firstname; ?>"/>
			<input type="hidden" name="lastname" value="<?php echo $client_lastname; ?>"/>
			<input type="hidden" name="phone" value="<?php echo $client_phone; ?>"/>
			<input type="hidden" name="country" value="<?php echo $client_country; ?>"/>
			<input type="hidden" name="email" value="<?php echo $client_email; ?>"/>
			<input type="hidden" name="secret" value="<?php echo $client_secret; ?>"/>
			<input type="hidden" name="answer" value="<?php echo $client_answer; ?>"/>
			<input type="hidden" name="pr" value="<?php echo $client_pr; ?>"/>
            <input type="hidden" name="capcha" value="<?php echo $client_capcha; ?>"/>
			<input class="btn btn-success" type="submit" value="Далее" /> 
		</form>
		</div>
	</div>
	</div>
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Пользовательское соглашение</h4>
  </div>
  <div class="modal-body">
    <p>Пожалуйста, прочтите следующие правила, прежде чем начать использовать наш сайт.
 Вы соглашаетесь с тем, что вы должны быть совершеннолетним в вашей стране, чтобы принять участие в этой программе, и во всех случаях ваш минимальный возраст должен быть 18 лет. Использовать данный сайт имеют право только физические лица. Каждый депозит считается частной сделкой между «Lider finance» и участником программы. Как частная сделка, эта программа освобождена от всех законов о ценных бумагах, от всех законов о бирже и инвестиционных компаниях и всех других норм, правил и изменений к ним. Мы не лицензированный банк или охранная фирма. Вы соглашаетесь с  тем, что вся информация, связь, материалы, поступающие от «Lider finance»  являются конфиденциальными и защищены от любого   распространения. Кроме того, информация, сообщения и материалы, содержащиеся в   настоящем документе, не должны рассматриваться как предложение, ходатайство для инвестиций. Вся информация, предоставленная партнерами «Lider finance», будет использована только в частном порядке и не передается третьим лицам. «Lider finance» не несет ответственности за любые потери данных. Вы соглашаетесь с тем, что все действия руководителей и партнеров освобождены от любой ответственности. Вы   вкладываете средства на свой страх и риск, и вы соглашаетесь, с  тем, что прошлые результаты не   являются гарантией таких же результатов в будущей деятельности. Вы соглашаетесь, что вся информация,   сообщения и материалы, которые Вы найдете на этом сайте, являются информацией для обозрения, а не инвестиционный совет. Мы оставляем за собой право вносить изменения в правила, комиссии и ставки программы   в любое время и по своему усмотрению без предварительного уведомления, особенно для того, чтобы   соблюдать интересы партнеров. Вы соглашаетесь с тем, что   принятие текущих условий является вашей личной ответственностью. «Lider finance»  не несет ответственности за любые убытки, потери и расходы, возникшие в результате нарушения условий и сроков или использования нашего сайта участником. Вы гарантируете «Lider finance», что вы не будете использовать этот сайт любым незаконным путем, и Вы соглашаетесь соблюдать ваши местные, национальные и международные законы. «Lider finance» оставляет за собой право принять или отклонить любого партнера без объяснения причин. Если вы не согласны с данными условиями сотрудничества, пожалуйста, покиньте сайт немедленно.</p>
  </div>
  <div class="modal-footer">
  </div>
</div>

    </div> <!-- /container -->
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
