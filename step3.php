<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/step3.php');
}

if($_POST['capcha'] !== $_SESSION['capcha']){
    header('Location: https://lider-finance.ru/step1.php');
}

if($_POST['activation'] == 1) {
// Страница регситрации нового пользователя
# Соединямся с БД
$client_firstname = $_POST['firstname'];
$client_lastname = $_POST['lastname'];
$client_email = $_POST['email'];
$client_phone = $_POST['phone'];
$client_secret = $_POST['secret'];
$client_country = $_POST['country'];
$client_answer = $_POST['answer'];
$client_pr = $_POST['pr'];
$client_on = 0;
$client_ip = $_SERVER['REMOTE_ADDR'];
// Символы, которые будут использоваться в пароле.
    $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
    mysql_select_db ("u6761949_default",$db);
    mysql_query("SET NAMES utf8");
    $result = mysql_query("SELECT client_email FROM users",$db);
    $error = 0;
    while($myrow = mysql_fetch_assoc($result)){
        if($myrow['client_email'] == $client_email){
            $error = 1;
        }
    }
if($error == 0){
function logins() 
{  
	$symbols = "QWERTYUIPASDFGHJKZXCVBNM"."qwertyuipasdfghjkzxcvbnm"."12345689"; 
	while($i<=6) {  
	$word .= $symbols[mt_rand(0, strlen($symbols)-4)]; 
	$i++;  
} 
	return $word;  
} 
$login = logins();
$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
// Количество символов в пароле. 
$max=10; 
// Определяем количество символов в $chars 
$size=StrLen($chars)-1; 
// Определяем пустую переменную, в которую и будем записывать символы. 
$password=null;  
// Создаём пароль. 
    while($max--) 
    $password.=$chars[rand(0,$size)]; 
$login = "u-".$login;	
$password = "p".$password;	
// Выводим созданный пароль. 
$hash = md5(md5($login.$password));
$to = "".$client_email."";
$subject = "Активация аккаунта на «Lider finance»";
$link = "http://lider-finance.ru/success.reg.php?code=$hash";
$message = "
<html>
<head>
<title>Активация аккаунта на «Lider finance»</title>
</head>
<body>
<h4>Команда «Lider finance» приветствует Вас!</h4>
<p>Данные для входа в систему:</p>
<p>Логин:".$login."</p>
<p>Пароль:".$password."</p>
</body>
</html>
";
//<p>Вы сможете зайти в систему только после активации своего аккаунта. Пожалуйста, пройдите по данной ссылке, чтобы активировать свой аккаунт.</p>
//<p><a href='".$link."' target='_blank'>Активация аккаунта.</a></p>
/*$message = 'Команда «Lider finance» приветствует Вас!'."\r\n".
           'Данные для входа в систему:'."\r\n".
           'Логин: '.$login."\r\n".
           'Пароль: '.$password;*/

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=utf-8";

// More headers
//$headers .= 'From: <club@lider-finance.ru>' . "\r\n";

mail($to,$subject,$message, $headers);

$system_address = "uto4kinv94eslav@gmail.com";
$system_subject = "Новый пользователь на Lider-Finance";
$system_message = "
<html>
<head>
<title>Новый пользователь на «Lider finance»</title>
</head>
<body>
<h4>Новый пользователь зарагестрировался на Lider-Finance</h4>
<p>Логин:".$login."</p>
<p>Пароль:".$password."</p>
<p>Имя: $client_firstname</p>
<p>Фамилия: $client_lastname</p>
<p>Почта: $client_email</p>
</body>
</html>
";
mail($system_address, $system_subject, $system_message, $headers);
$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
    mysql_select_db ("u6761949_default",$db);
mysql_query("SET NAMES utf8");
$result = mysql_query("INSERT INTO activating (act_login, act_pass, act_hash, act_email) VALUES ('".$login."', '".$password."','".$hash."', '".$client_email."')");
$result2 = mysql_query("INSERT INTO users (client_login, client_password, client_hash, client_email, client_firstname, client_lastname, client_secret, client_answer, client_country, client_pr, client_phone, client_on, client_ip) VALUES ('".$login."', '".$password."', '".$hash."', '".$client_email."', '".$client_firstname."', '".$client_lastname."', '".$client_secret."', '".$client_answer."', '".$client_country."', '".$client_pr."', '".$client_phone."', '".$client_on."', '".$client_ip."')");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Регистрация - Шаг 3</title>
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
    <?php if($error == 0){?>
    <div class="container">
	<div class="form-signin">
        <h2 class="form-signin-heading">Регистрация</h2>
		<h4>Шаг 3<small> - Активация аккаунта</small></h4>
		<p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
		<p class="text-center">Мы выслали на Ваш почтовый ящик логин и пароль для входа в нашу систему. Чтобы начать пользоваться системой, нужно ввести свой логин а пароль на главной странице сайта. Удачи Вам! </p>
		<p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
	<div class="row-fluid">
		<div class="span12 text-center">
			<a href="http://lider-finance.ru" class="btn btn-success" />Завершить регистрацию</a> 
		</div>
	</div>
	</div>
    </div> <!-- /container -->
	<?php } else {?>
        <div class="container">
            <div class="form-signin">
                <h2 class="form-signin-heading">Регистрация</h2>
                <h4>Ошибка</h4>
                <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
                <p class="text-center">Такой почтовый ящик уже используется</p>
                <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
                <div class="row-fluid">
                    <div class="span12 text-center">
                        <a href="http://lider-finance.ru/step1.php" class="btn btn-success" />Изменить данные</a>
                    </div>
                </div>
            </div>
        </div> <!-- /container -->
    <?php }?>
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
<?php

} else { 
	header('Location: step2.php');
}
?>