<?php 
include('config.php');
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/vkladi.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Lider Finance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
	body {
	margin: 0;
	padding:0;
	}
	.prewie {
	margin: 0 auto;
	width: 100%;
	height: auto;
	background: url("assets/img/header2.png") no-repeat;
	background-size: cover;
	}
      /* Custom container */
      .container {
        margin: 0 auto;
		z-index: 50;
      }
	  .block {
	  max-width: 1000px;
	  margin: 0 auto;
	  }
      .container > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
      }
    .jumbotron2 {
        margin: 150px 0;
        background: rgba(87, 87, 87, 0.71);
        border-radius: 5px;
        box-shadow: 0px 0px 5px #555;
        padding: 10px;
    }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar .navbar-inner {
        padding: 0;
      }
      .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar .nav li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>

  <body>
	
    <div class="prewie">
      <div class="masthead block">
		<div class="row-fluid">
		<div class="span4 text-center" style="color: #fff; padding-top: 30px;">
			<h2><small style="color: #fff;"></small></h2>
        </div>
        <div class="span4 text-center">
			<p style="margin-top: 15px;"><img src="assets/img/logo.png"><p>
        </div>
            <div class="span3 offset1 text-center" style="color: #fff; padding-top: 10px;">
                <?php
                getStatistics($stat);
                echo $stat;
                ?>
            </div>
      </div>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <li><a href="index.php">Главная</a></li>
                <li><a href="news.php">Новости</a></li>
                <li class="active"><a href="vkladi.php">Вклады</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="supp.php">Поддержка</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>
		 <div class="row-fluid block">
        <div class="span8 text-center">
      <!-- Jumbotron -->
      <div class="jumbotron text-center" style="color: #fff; text-shadow: 0px 0px 30px #000;">
        <p><img src="assets/img/mac.png"></p>
        <p><img src="assets/img/vkladi.png"></p>
        <p><?php echo $reg_button; ?></p>
      </div>
		</div>
		<div class="span4">
		<?php echo $html; ?>
		</div>
</div></div>

      <!-- Example row of columns -->
	  <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hrvklad.png"><p>
      <div class="row-fluid block">
		<div class="span4 text-center">
		<img id="TheFastStart" class="img-circle"  alt="140x140" style="width: 140px; height: 140px;" src="assets/img/2pr.png">
		<h3>The Fast Start</h3>
		</div>
		<div class="span8 text-center">
		<h3>Инвестиционный план «The Fast Start»</h3>
		<p>Предоставляет <strong>114% дохода</strong> за вклад на 60 дней. Инвестиционный лимит по данному плану составляет <strong>25 — 300 USD</strong>. Открыть новый депозит по данному плану можно 1 раз в сутки. Начисления на внутренний счет вкладчика производятся автоматически, 1 раз в сутки (на общую сумму <strong>1.9%</strong> от суммы вклада). Вывод накоплений из нашей система осуществляется по вашему запросу и является моментальным.</p>
		
		</div>
	  </div>
	  <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
	  <div class="row-fluid block">
		<div class="span4 text-center">
			<img id="TheFirstCapital" class="img-circle"  alt="140x140" style="width: 140px; height: 140px;" src="assets/img/25pr.png">
			<h3>The First Capital</h3>
		</div>
		<div class="span8 text-center">
		<h3>Инвестиционный план «The First Capital»</h3>
		<p>Предоставляет <strong>120% дохода</strong> за вклад на 60 дней. Инвестиционный лимит по данному плану составляет <strong>301 — 1500 USD</strong>. Открыть новый депозит по данному плану можно 1 раз в сутки. Начисления на внутренний счет вкладчика производятся автоматически, 1 раз в сутки (на общую сумму <strong>2%</strong> от суммы вклада). Вывод накоплений из нашей система осуществляется по вашему запросу и является моментальным.</p>
		
		</div>
	  </div>
	  <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>
	  <div class="row-fluid block">
		<div class="span4 text-center">
			 <img id="Business" class="img-circle"  alt="140x140" style="width: 140px; height: 140px;" src="assets/img/3pr.png">
			 <h3>Business </h3>
		</div>
		<div class="span8 text-center">
		<h3>Инвестиционный план «Business»</h3>
		<p>Предоставляет <strong>126% дохода</strong> за вклад на 60 дней. Инвестиционный лимит по данному плану составляет <strong>1501 — 5000 USD</strong>. Открыть новый депозит по данному плану можно 1 раз в сутки, при условии, что данный план вписывается в автоматически установленный системой суточный лимит по депозитам. Начисления на внутренний счет вкладчика производятся автоматически, 1 раз в сутки (на общую сумму <strong>2.1%</strong> от суммы вклада). Вывод накоплений из нашей система осуществляется по вашему запросу и является моментальным.</p>
	
		</div>
	  </div>
	  <hr>
		<div class="row-fluid block">
		<div class="span12 text-center">
		<h3>Особенности системы</h3>
		<p>Комиссия на вывод составляет  1%, это и есть прибыль компании. Эти средства поступают на рекламу и развитие компании.</p>
		</div>
        <div class="span4 text-center">
            <img src="assets/img/logo3.png">
        </div>
        <div class="span8 text-center" style="float: right; margin-top: -40px;">
            <p>На данный момент все транзакции осуществляются при помощи платёжной системы <a href="https://perfectmoney.is/">Perfect Money</a></p>
        </div>
	  </div>
      <p style="margin-top: 15px;" class="text-center"><img src="assets/img/hr.png"><p>

      <footer class="block">
        <p class="pull-right"><a href="#">Вверх страницы</a></p>
          <p class="pull-left"><script type="text/javascript" src="https://seal.thawte.com/getthawteseal?host_name=lider-finance.ru&size=S&lang=en"></script></p>
        <span class="text-center"><p>© 2013 Lider-Finance.ru · <a href="#myModal" data-toggle="modal">Пользовательское соглашение</a></p></span>
      </footer>

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
    <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
