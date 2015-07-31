<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
if (!empty($_SESSION['login']) AND !empty($_SESSION['id'])) {
	$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
    mysql_select_db ("u6761949_default",$db);
	mysql_query("SET NAMES utf8");
	$login = $_SESSION['login'];
	$id = $_SESSION['id'];
	$result = mysql_query("SELECT * FROM users WHERE client_login='$login' AND client_id='$id'",$db); 
	$row = mysql_fetch_array($result);
	$firstname = $row['client_firstname'];
	$lastname = $row['client_lastname'];
	$access_on = 1;
	$html = <<<HERE
	<div class="col-lg-12 form-signin jumbotron2 text-center">
		<p>
		    <h5><span style='color:#fff;'>Вы вошли как $firstname $lastname</span></h5>
		</p>
	  			<p><a href="https://lider-finance.ru/investor/" class="btn btn-small btn-success" >Перейти в кабинет</a></p>
	  			<p><a href="https://lider-finance.ru/investor/exit.php" class="btn btn-small btn-info" >Выйти из профиля</a></p>
   	</div>
    <div class="form-signin text-center" style="margin: -150px 0 0 0;">
		        <h4><small style='color: #f6fcff;'>Мы здесь</small></h4>
                <a href="https://vk.com/liderfinance"><img src="https://lider-finance.ru/assets/ico/vk.png"></img></a>
                <a href="#ok"><img src="https://lider-finance.ru/assets/ico/odnoklassniki.png"></img></a>
                <a href="#fb"><img src="https://lider-finance.ru/assets/ico/facebook.ico"></img></a>
                <a href="#tw"><img src="https://lider-finance.ru/assets/ico/twitter.ico"></img></a>
                <a href="skype:SkypeUser"><img src="https://lider-finance.ru/assets/ico/skype.ico"></img></a>
	</div>
HERE;
} else {
	$access_on = 0;
    if($_POST['enter'] != ''){
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            if ($login == '') {
                unset($login);
            }
        }
        //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
        if (isset($_POST['password'])) {
            $password=$_POST['password'];
            if ($password =='') {
                unset($password);
            }
        }
        //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $login = stripslashes($login);
        $login = htmlspecialchars($login);
	    $password = stripslashes($password);
        $password = htmlspecialchars($password);
        //удаляем лишние пробелы
        $login = trim($login);
        $password = trim($password);
        // подключаемся к базе
	    $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
        mysql_select_db ("u6761949_default",$db);
	    mysql_query("SET NAMES utf8");
	    $result = mysql_query("SELECT * FROM users WHERE client_login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
        $myrow = mysql_fetch_array($result);
        if (empty($myrow['client_password'])) {
            //если пользователя с введенным логином не существует
        $html = <<<HERE
	        <form class="form-signin jumbotron2" method="post">
                <p><img style="width:300px; height: 50px;" src="assets/img/vhod.png"></p>
                <p>Извините, введённый вами login или пароль неверный.<p>
                <input type="text" name="login" class="input-block-level" placeholder="Введите логин">
                <input type="password" name="password" class="input-block-level" placeholder="Введите пароль">
                <input type="hidden" name="enter" value="1">
                <label class="checkbox">
                <input type="checkbox" name="save" value="1"><span style='color:#c1c1c1;'>Запомнить меня?</span>
                <a href="#myModalRec" data-toggle="modal"  style="float: right; font-size: 10px;">Забыли пароль?</a>
                </label>
                <button class="btn btn-success" type="submit">Войти</button>
		    </form>
	        <div class="form-signin text-center" style="margin: -150px 0 0 0;">
		        <h4><small style='color: #f6fcff;'>Мы здесь</small></h4>
                <a href="https://vk.com/liderfinance"><img src="https://lider-finance.ru/assets/ico/vk.png"></img></a>
                <a href="#ok"><img src="https://lider-finance.ru/assets/ico/odnoklassniki.png"></img></a>
                <a href="#fb"><img src="https://lider-finance.ru/assets/ico/facebook.ico"></img></a>
                <a href="#tw"><img src="https://lider-finance.ru/assets/ico/twitter.ico"></img></a>
                <a href="skype:SkypeUser"><img src="https://lider-finance.ru/assets/ico/skype.ico"></img></a>
		    </div>

            <div id="myModalRec" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="myModalLabel">Восстановление логина и пароля</h4>
                </div>
                <form id="MyForm" class="form-signin" action="recovery.php" method="post">
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="control-group">
                                <p>Если вы здесь, это значит, что вы забыли свой логин или пароль.</p>
                                <p>Для продолжения процедуры восстановления введите свой @-mail.</p><br/>
                                <div class="controls">
                                    <input type="email" class="form-control" value="$client_email" id="email" name="email" placeholder="Введите вашу эл. почту">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="submit_login" type="submit" value="Далее" />
                    </div>
                </form>
            </div>
HERE;
    } else {
        //если существует, то сверяем пароли
        if ($myrow['client_password']==$password) {
            //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
            $_SESSION['login']=$myrow['client_login'];
            $_SESSION['id']=$myrow['client_id'];
            //эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
            $save_me = $_POST['save'];
            $_SESSION['save'] = $save_me;
            header('Location: https://lider-finance.ru/investor/index.php');
        }
	}
    } else {
	    $html = <<<HERE
	    <form class="form-signin jumbotron2" method="post" style="margin: 150px 0 0 0">
            <p><img style="width:300px; height: 50px;" src="assets/img/vhod.png"></p>
            <input type="text" name="login" class="input-block-level" placeholder="Введите логин">
            <input type="password" name="password" class="input-block-level" placeholder="Введите пароль">
            <input type="hidden" name="enter" value="1">
            <label class="checkbox">
            <input type="checkbox" name="save" value="1"><span style='color:#c1c1c1;'>Запомнить меня?</span>
            <a href="#myModalRec" data-toggle="modal"  style="float: right; font-size: 10px;">Забыли пароль?</a>
            </label>
                <button class="btn btn-success" type="submit">Войти</button>
		    </form>
	        <div class="form-signin text-center" style="margin: -150px 0 0 0;">
		        <h4><small style='color: #f6fcff;'>Мы здесь</small></h4>
                <a href="https://vk.com/liderfinance"><img src="https://lider-finance.ru/assets/ico/vk.png"></img></a>
                <a href="#ok"><img src="https://lider-finance.ru/assets/ico/odnoklassniki.png"></img></a>
                <a href="#fb"><img src="https://lider-finance.ru/assets/ico/facebook.ico"></img></a>
                <a href="#tw"><img src="https://lider-finance.ru/assets/ico/twitter.ico"></img></a>
                <a href="skype:SkypeUser"><img src="https://lider-finance.ru/assets/ico/skype.ico"></img></a>
		    </div>

		    <div id="myModalRec" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="myModalLabel">Восстановление логина и пароля</h4>
                </div>
                <form id="MyForm" action="recovery.php" method="post">
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="control-group">
                                <p>Если вы здесь, это значит, что вы забыли свой логин или пароль.</p>
                                <p>Для продолжения процедуры восстановления введите свой @-mail.</p><br/>
                                <div class="controls">
                                    <input type="email" class="form-control" value="$client_email" id="email" name="email" placeholder="Введите вашу эл. почту">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="submit_login" class="btn btn-success" type="submit" value="Далее"/>
                </div>
            </form>
        </div>
HERE;
}
    $html = <<<HERE
	<form class="form-signin jumbotron2" method="post">
        <p><img style="width:300px; height: 50px;" src="assets/img/vhod.png"></p>
        <input type="text" name="login" class="input-block-level" placeholder="Введите логин">
        <input type="password" name="password" class="input-block-level" placeholder="Введите пароль">
        <input type="hidden" name="enter" value="1">
        <label class="checkbox">
          <input type="checkbox" name="save" value="1"><span style='color:#c1c1c1;'>Запомнить меня?</span>
          <a href="#myModalRec" data-toggle="modal"  style="float: right; font-size: 10px;">Забыли пароль?</a>
        </label>
            <button class="btn btn-success" type="submit">Войти</button>
		</form>
	    <div class="form-signin text-center" style="margin: -150px 0 0 0;">
		        <h4><small style='color: #f6fcff;'>Мы здесь</small></h4>
                <a href="https://vk.com/liderfinance"><img src="https://lider-finance.ru/assets/ico/vk.png"></img></a>
                <a href="#ok"><img src="https://lider-finance.ru/assets/ico/odnoklassniki.png"></img></a>
                <a href="#fb"><img src="https://lider-finance.ru/assets/ico/facebook.ico"></img></a>
                <a href="#tw"><img src="https://lider-finance.ru/assets/ico/twitter.ico"></img></a>
                <a href="skype:SkypeUser"><img src="https://lider-finance.ru/assets/ico/skype.ico"></img></a>
		</div>

        <div id="myModalRec" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel">Восстановление логина и пароля</h4>

            </div>
            <form id="MyForm" class="form-signin" action="recovery.php" method="post">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="control-group">
                            <p>Если вы здесь, это значит, что вы забыли свой логин или пароль.</p>
                            <p>Для продолжения процедуры восстановления введите свой @-mail.</p><br/>
                            <div class="controls">
                                <input type="email" class="form-control" value="$client_email" id="email" name="email" placeholder="Введите вашу эл. почту">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="submit_login" type="submit" value="Далее" />
                </div>
            </form>
        </div>
HERE;
}


if($access_on == 1) {
	$reg_button = <<<HERE
	
HERE;
} else {
	$reg_button = <<<HERE
	<a class="btn btn-large btn-success" href="step1.php">Зарегистрироваться</a>
HERE;
}


function getStatistics(&$html_var){
    $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
    mysql_select_db ("u6761949_default",$db);
    mysql_query("SET NAMES utf8");

    $result = mysql_query("SELECT COUNT(*) AS 'count' FROM users");
    $row = mysql_fetch_array($result);
    $all_users = $row['count']+14;
    $result = mysql_query("SELECT SUM(sum_deposits) AS 'sum' FROM deposits");
    $row = mysql_fetch_array($result);
    $all_deposits = $row['sum']+643;

    $html_var = <<<HERE
        <h3><small style="color: #fff;">Сейчас </small>$all_users<small style="color: #fff;"> участников</small></h3>
        <h3><small style="color: #fff;">Cумма депозитов </small>$all_deposits<small style="color: #fff;">$</small></h3>
HERE;
}

?>