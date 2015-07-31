<?php
header('Content-Type: text/html; charset=utf-8');
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/recovery.php');
}
$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
mysql_select_db ("u6761949_default",$db);
mysql_query("SET NAMES utf8");

$client_email = $_POST['email'];
$sql = "SELECT * FROM users WHERE client_email = '$client_email'";
$query = mysql_query($sql);
$row = mysql_fetch_array($query);

function showNotRegistered(&$html_var, $email){
    $html_var = <<<HERE
    <div class="container">
        <div class="form-signin">
            <h2 class="form-signin-heading">Восстановление данных</h2>
            <h4>Не верный электронный адрес.</h4>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
            <p class="text-center">Электронный адрес [$email] не зарегистрирован.</p>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
            <div class="row-fluid">
                <div class="span12 text-center">
                    <a href="index.php" class="btn btn-primary">Вернуться на главную</a>
                    <a href="step1.php" class="btn btn-success">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </div>
HERE;
}

function showQuestionErr(&$html_var,$record){
    $question = $record['client_secret'];
    $a = $_POST['email'];
    $html_var = <<<HERE
    <div class="container">
        <form id="MyForm" class="form-signin" method="post">
            <h2 class="form-signin-heading">Восстановление логина и пароля</h2>
            <h4>Шаг 1<small> - Вопрос</small></h4>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"></p>
            <div class="row-fluid">
                <div class="text-center">
                    <div class="control-group">
                        <p>$question</p>
                        <div class="controls">
                            <input type="text" value="" name="answer" placeholder="Введите ваш ответ">
                            <input type="hidden" value="$email" name="email">
                            <span class="help-block">Неверный ответ.</span>
                        </div>
                    </div>
                </div>
            </div>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
            <div class="row-fluid">
                <div class="span12 text-center">
                    <input id="submit_login" class="btn btn-success" type="submit" value="Далее" />
                </div>
            </div>
        </form>
    </div>
HERE;
}

function showQuestion(&$html_var,$record){
    $question = $record['client_secret'];
    $email = $_POST['email'];
    $html_var = <<<HERE
    <div class="container">
        <form id="MyForm" class="form-signin" method="post">
            <h2 class="form-signin-heading">Восстановление логина и пароля</h2>
            <h4>Шаг 1<small> - Вопрос</small></h4>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"></p>
            <div class="row-fluid">
                <div class="text-center">
                    <div class="control-group">
                        <p>$question</p>
                        <div class="controls">
                            <input type="text" value="" name="answer" placeholder="Введите ваш ответ">
                            <input type="hidden" value="$email" name="email">
                        </div>
                    </div>
                </div>
            </div>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
            <div class="row-fluid">
                <div class="span12 text-center">
                    <input id="submit_login" class="btn btn-success" type="submit" value="Далее" />
                </div>
            </div>
        </form>
    </div>
HERE;
}

function showSuccess(&$html_var,$record){
    $email = $record['client_email'];
    $html_var = <<<HERE
    <div class="container">
        <div class="form-signin">
            <h2 class="form-signin-heading">Восстановление данных</h2>
            <h4>Шаг 2<small> - Письмо</small></h4>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
            <p class="text-center">Мы выслали на Ваш почтовый ящик [$email] логин и пароль для входа в нашу систему. Чтобы продожить пользоваться системой, перейдите по ссылке, которая в письме с логином и паролем от аккаунта. Удачи Вам! </p>
            <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
            <div class="row-fluid">
                <div class="span12 text-center">
                    <a href="http://lider-finance.ru" class="btn btn-success" />Вернуться на главную</a>
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
    <title>Восстановление логина и пароля</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
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
<?php

if(isset($_POST['answer']))
{
    $user_answer = $_POST['answer'];
    $server_answer = $row['client_answer'];
    if ($user_answer == $server_answer){
        $to = $row['client_email'];
        $user_firstname = $row['client_firstname'];
        $user_login = $row['client_login'];
        $user_password = $row['client_password'];
        $subject = "Восстановление аккаунта на «Lider-Finance.ru»";
        $message = "
        <html>
            <head>
                <title>Активация аккаунта на «Lider finance»</title>
            </head>
            <body>
                <h4>Команда «Lider finance» приветствует Вас!</h4>
                <p>Здравствуйте ".$user_firstname."!</p>
                <br/>
                <p>Вы получили это письмо потому, что вы (либо кто-то, выдающий себя за вас)</p>
                <p>сделали запрос на восстановление логина и пароля к вашей учётной записи на <a href='http://lider-finance.ru/'>Lider Finance</a></p>
                </br>
                <p>Данные для входа в систему:</p>
                <p>Логин: ".$user_login."</p>
                <p>Пароль: ".$user_password."</p>
                <br/>
                <p>Для входа в личный кабинет воспользуйтесь ссылкой: <a href='http://lider-finance.ru/'>http://lider-finance.ru/</a></p>
                <br/>
                <p>Если вы не запрашивали процедуру восстановления, проигнорируйте это письмо,</p>
                <p>если подобные письма будут продолжать приходить, обратитесь к администраторам Lider Finance.</p>
                <br/>
                <p>--</p>
                <p>С уважением Администрация Lider-Finance.RU</p>
            </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=utf-8". "\r\n";
        $eol="\n";
        $mail = 'Rogergreen131@gmail.com';
        $headers .= 'From: MyName <'.$mail.'>'.$eol;
        $headers .= 'Reply-To: MyName <'.$mail.'>'.$eol;
        $headers .= 'Return-Path: MyName <'.$mail.'>'.$eol;    // these two to set reply address
        $headers .= "Errors-To: ".$mail.$eol;

        mail($to,$subject,$message,$headers);

        showSuccess($html,$row);
        echo $html;
    }
    else{
        showQuestionErr($html, $row);
        echo $html;
    }
}
else
{
    if (!empty($row)){
        showQuestion($html, $row);
        echo $html;
    }
    else{
        showNotRegistered($html, $client_email);
        echo $html;
    }
}
?>

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
    <!-- Validate plugin -->
    <script src="../assets/js/jquery.validate.js"></script>
    <!-- Scripts specific to this page -->
    <script src="../assets/js/script.js"></script>
</body>
</html>