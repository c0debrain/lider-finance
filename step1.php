<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/step1.php');
}
	if($_POST['edit'] == 1) {
		$client_firstname = $_POST['firstname'];
		$client_lastname = $_POST['lastname'];
		$client_email = $_POST['email'];
		$client_phone = $_POST['phone'];
		$client_secret = $_POST['secret'];
		$client_country = $_POST['country'];
		$client_answer = $_POST['answer'];
		$client_pr = $_POST['pr'];
	}

    if($_GET['wrong_capcha'] == 1) {
        $client_firstname = $_GET['firstname'];
        $client_lastname = $_GET['lastname'];
        $client_email = $_GET['email'];
        $client_phone = $_GET['phone'];
        $client_secret = $_GET['secret'];
        $client_country = $_GET['country'];
        $client_answer = $_GET['answer'];
        $client_pr = $_GET['pr'];
    }

$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
mysql_select_db ("u6761949_default",$db);
mysql_query("SET NAMES utf8");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Регистрация - Шаг 1</title>
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
    <form id="MyForm" class="form-signin" action="step2.php" method="post"> 
        <h2 class="form-signin-heading">Регистрация</h2>
		<h4>Шаг 1<small> - Введите необходимые данные для открытия вклада.</small></h4>
		<p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
		<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
    <label class="control-label" for="inputPassword">Имя</label>
    <div class="controls">
      <input type="text" value="<?php echo $client_firstname; ?>" id="firstname" name="firstname" placeholder="Введите свое имя">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="lastname">Фамилия</label>
    <div class="controls">
      <input type="text" value="<?php echo $client_lastname; ?>" id="lastname" name="lastname" placeholder="Введите свою фамилию">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">Эл. почта</label>
    <div class="controls">
      <input type="text" value="<?php echo $client_email; ?>" id="email" name="email" placeholder="Введите вашу эл. почту">
    </div>
  </div>


            <div class="control-group">
                <label class="control-label" for="country1">Страна</label>
                <div class="controls">
                    <select class="form-control" name="country1">
                        <option disabled selected>Выберете страну</option>
                        <?php
                        $request = mysql_query("SELECT * FROM system_countries", $db);
                        while($con = mysql_fetch_assoc($request)){
                            $name = $con['name_ru'];
                            echo "<option value='$name'>$name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="contol-gruop">
                <label class="control-label" for="capcha">Капча</label>
                <div class="controls">
                    <img style="border: 1px solid gray; background: url('bg_capcha.png'); margin-bottom: 10px" src = "captcha.php" width="120" height="40"/>
                    <input class="span10" id="prependedInput" type="text" value="" id="capcha" name="capcha"><br>
                    <? if($_GET['wrong_capcha'] == 1) echo "Вы неправильно ввели капчу"; ?>
                </div>
            </div>

  </div>
  <div class="span6">
  <div class="control-group">
    <label class="control-label" for="phone">Телефон</label>
	<p><small>Номер телефона вводится только цыфрами и без 8-ки.</small></p>
    <div class="input-prepend">
		<span class="add-on" style="padding: 7px;">+7</span>
		<input class="span10" id="prependedInput" type="text" value="<?php echo $client_phone; ?>" id="phone" name="phone" >
	</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="secret">Секретный вопрос</label>
    <div class="controls">
      <select class="form-control" name="secret">
	  <option disabled selected>Выберите вопрос</option>
        <option value="Где вы в детсве проводили лето?">Где вы в детсве проводили лето?</option>
        <option value="Как зовут вашего любимого питомца?">Как зовут вашего любимого питомца?</option>
        <option value="В каком городе познакомились Ваши родители?">В каком городе познакомились Ваши родители?</option>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="answer">Ответ на секретный вопрос</label>
    <div class="controls">
      <input type="text" value="<?php echo $client_answer; ?>" name="answer"  id="answer" placeholder="Введите ответ">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pr">Откуда вы узнали о Lider-finance?</label>
    <div class="controls">
       <textarea id="pr" name="pr" rows="3"><?php echo $client_pr; ?></textarea>
</label>
    </div>
  </div>
  </div>
  <div class="row-floid">
  <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
  <div class="span12 ">
        <label class="checkbox">
          <input type="checkbox" name="accept" value="enter-system"> Я согласен с <a href="#myModal" data-toggle="modal">Пользовательским соглашением</a>. 
        </label>
         
		<input id="submit_login" class="btn btn-success" type="submit" value="Далее" name="submit"/>
	</div>
      </form>
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Пользовательское соглашение</h4>
  </div>
  <div class="modal-body">
    <p>Пожалуйста, прочтите следующие правила, прежде чем начать использовать наш сайт.
        <br>Перед регистрацией в онлайн – инвестиционном проекте Lider-Finance , мы настоятельно рекомендует Вам прочесть следующие условия.
        <br>Здесь описываются все основные, обязательные правила обеих сторон, права и обязанности, а также условия взаимодействия клиентов с онлайн - инвестиционным проектом «Lider-Finance» (далее «LF» ) .
        <br>Регистрация в данном проекте доступна только после принятия данных условий:
        <br>1. Право зарегистрироваться в «LF»  имеют все лица, которые не относятся к следующим категориям:
        <br>1.1 Несовершеннолетние (в соответствии с законодательством страны проживания);
        <br>2. Ответственность за решение присоединиться к LF, за все свои действия (соблюдение / несоблюдение правил, финансовые операции и др.) лежит на клиенте.
        <br>3. Права и обязанности клиента «LF»:
        <br>3.1. Каждый клиент «LF»  наравне с другими такими клиентами имеет право на все услуги, предоставляемые «LF»: инвестировать и получать доход в соответствии с условиями инвестиционного вклада, обращаться за помощью в службу поддержки «LF».
        <br>3.2. Во время регистрации клиент обязан указать строго достоверную информацию о себе, потому что в дальнейшем, при необходимости, администрация «LF»  может попросить подтвердить свои данные и, если выяснится, что данные регистрации недостоверны, он будет немедленно заблокирован со всеми средствами на нем.
        <br>3.3. Клиент обязуется обеспечить полную конфиденциальность любой информации, полученной от администрации «LF».
        <br>3.4. Клиент обязуется не разглашать свои регистрационные данные третьим лицам. В случае, если клиент предоставляет свой пароль третьим лицам, в результате чего данные действия приведут к изменениям и потери счета, ответственность несет только клиент.
        <br>3.5. Клиент соглашается с тем, что только он несет ответственность за защиту своего компьютера, планшета, смартфона или любого другого устройства, с которого обеспечивается вход в личный кабинет. В случае кражи средств с аккаунта клиента при отсутствии надлежащей защиты, «LF» не несет ответственность.
        <br>3.6. Клиент самостоятельно принимает решение о выборе инвестиционного вклада и осознает, что любые инвестиции связаны с определенным риском, и следовательно, при любом исходе не станет предъявлять претензий «LF». Клиент вкладывает средства на свой страх и риск и соглашается с тем, что прошлые результаты не являются гарантией таких же результатов в будущей деятельности.
        <br>3.7. Клиенту рекомендуется осуществлять периодический доступ к своему счету в течение срока действия инвестиционного плана для мониторинга безопасности его счета. Если клиент обнаружил признаки несанкционированного доступа к своему счету, ему стоит немедленно обратиться в службу поддержки «LF».
        <br>3.8. Клиент обязан соблюдать правила в полном объеме. В случае нарушения любого пункта данных условий, «LF»  имеет право прекратить сотрудничество с клиентом в одностороннем порядке.                                                   3.9.  Клиент соглашается с тем, что все действия администрации и партнеров проекта освобождены от любой ответственности.
        <br>4. Права и обязанности администрации проекта «LF»:
        <br>4.1. «LF»  гарантирует своим клиентам предоставление всех заявленных услуг в полном объеме и в соответствии с указанными условиями.
        <br>4.2. «LF»  обязуется обеспечивать работоспособность своего проекта, предоставлять консультационную поддержку своим клиентам, оперативно исправлять любые технические проблемы, вызвавшие трудности работы клиента с проектом.
        <br>4.3. «LF»  предоставляет своим клиентам самый высокий уровень защиты персональных данных и вложенных средств.
        <br>4.4. «LF»  обязуется обеспечить конфиденциальность личной информации клиента, полученной при регистрации, а также за весь период участия клиента в проекте.
        <br>4.5. В случае мошенничества со стороны клиента (попытки взлома счетов других клиентов, представление себя в качестве сотрудника «LF») или нарушение любого из пунктов данных условий, администрация «LF» имеет право в одностороннем порядке прекратить предоставление инвестиционных услуг данному клиенту, блокировать его счет (счета) без возможности возвращения его в данный проект. В случае незначительных нарушений со стороны клиента или возникновения спорных ситуаций, администрация имеет право временно заблокировать счет клиента. В дальнейшем с ним свяжется представитель «LF»  для решения ситуации.
        <br>4.6. Администрация «LF» имеет право по своему усмотрению изменить содержание данных условий без предварительного согласия клиента. Изменения будут доведены до сведения клиентов в частном порядке или на сайте проекта. Клиент имеет право не принимать изменения, но тогда придется сообщить об этом в поддержку проекта или непосредственно к администрации. Сотрудничество с клиентом будет прекращено по взаимному соглашению.
        <br>4.7. «LF» имеет все права на содержание, а также любую информацию и материалы, размещенные на веб-сайте проекта. Любое несанкционированное использование личной информации и прав интеллектуальной собственности защищены авторским правом.                                                                                                                                 4.8. Конфликтные / спорные ситуации (не входящие в пункт 4.5. данных условий) любого рода между клиентом и администрацией проекта «LF» должны быть решены путем переговоров с заключением взаимовыгодного соглашения.
        <br>4.9. «LF» не несет ответственность за проблемы связанные с вводом/выводом денежных средств в проект/из проекта, если эти проблемы связанны с сервисом платежных систем, с помощью которых осуществляются операции с денежными средствами.
        <br>5. Все условия получения прибыли клиентом оговорены в содержании инвестиционного вклада, который клиент выбирает самостоятельно.
        <br>6. В случае форс-мажорных обстоятельств (обстоятельствах, не зависящих от «LF» ) администрация «LF» освобождается от ответственности перед своими клиентами за невыполнение всех заявленных функций и услуг . Клиент не имеет права предъявлять претензии и требовать от «LF» финансовой компенсации в случае, если в связи с действием данных обстоятельств, результат участия клиента в проекте не будет соответствовать ожидаемому.
    </p>
  </div>
  <div class="modal-footer">
  </div>
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
	<!-- Validate plugin -->
		<script src="../assets/js/jquery.validate.js"></script>
<!-- Scripts specific to this page -->
		<script src="../assets/js/script.js"></script>

		<script>
			// Activate Google Prettify in this page
				addEventListener('load', prettyPrint, false);

			$(document).ready(function(){

				// Add prettyprint class to pre elements
					$('pre').addClass('prettyprint linenums');

			});

		</script>
  </body>
</html>
