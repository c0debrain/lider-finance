<?php 
include('config.php');
if($_SERVER['SERVER_PORT'] != '443') {
    header('Location: https://lider-finance.ru/faq.php');
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
	background: url("assets/img/header3.png") no-repeat;
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
                <li ><a href="news.php">Новости</a></li>
                <li><a href="vkladi.php">Вклады</a></li>
                <li class="active"><a href="faq.php">FAQ</a></li>
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
			<p><?php echo $html; ?></p>
		</div>
</div></div>

      <!-- Example row of columns -->

      <div class="row-fluid block">
      	<br><p><h3>FAQ</h3></p>
			<div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                      Я новичок в инвестировании. С чего мне начать?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapseOne" class="accordion-body collapse">
                    <div class="accordion-inner">
                      Очень рекомендуем ознакомиться с условиями , а так же с вопросами и ответами, расположенными на этой странице.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                      Что мне нужно сделать, чтобы зарегистрироваться в Lider finance?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                      Для регистрации вам необходимо заполнить форму, предоставленную на странице "Регистрация". Указать имя, фамилию, номер телефона, адрес электронной почты, страну и секретный вопрос с ответом, и принять правила участия в  Lider-Finance.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                      Как я могу инвестировать с Lider finance?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapseThree" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      Для того, чтобы инвестировать вы должны сначала стать членом Lider-Finance. Когда Вы зарегистрируетесь, вы можете создать свой первый депозит. Все вклады должны быть сделаны через личный кабинет. Вы можете войти, используя имя пользователя и пароль, которые Вы получите при регистрации.
Вам необходимо перейти во вкладку "Пополнить счет", которая находится в личном кабинете, пополнить баланс, а затем во вкладке "Инвестиционный план" выбрать инвестиционный план и внести необходимую сумму.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse4">
                      Я хотел бы инвестировать с Lider finance, но у меня нет никакого электронного счета. Что я должен делать?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse4" class="accordion-body  collapse">
                    <div class="accordion-inner">
                     Вы можете бесплатно открыть счет Perfect Money здесь: https://perfectmoney.is/
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse5">
                      Как мне открыть счет в Lider finance?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse5" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      Это довольно просто и удобно. Следуйте по этой <a href="step1.php">ссылке</a>, заполните данные в регистрационной форме и нажмите кнопку "Зарегистрироваться".
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse6">
                      Какие платежные системы вы поддерживаете?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse6" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      Мы поддерживаем следующие платежные системы: Perfect Money.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse7">
                      Как я могу забрать свои средства?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse7" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      Войдите в свой аккаунт, используя имя пользователя и пароль. Перейдите в раздел "Вывести средства".
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse8">
                      Могу ли я потерять деньги?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse8" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      Существует риск, связанный с инвестированием. Вы должны понимать, что только вы отвечаете за свои сбережения. Вам необходимо оценить все риски и принять решение самостоятельно.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse9">
                      Выплачивается ли прибыль на мой электронный счет?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse9" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      После запроса на вывод средств, прибыль автоматически поступит на Ваш электронный счет.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse10">
                     	Сколько потребуется времени для того чтобы создать депозит?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse10" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      Депозит будет зачислен на Ваш счет моментально.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse11">
                      После того как я сделаю запрос на вывод, когда средства будут доступны на моем электронном счете?
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse11" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      Наша система производит выплаты мгновенно.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse12">
                      Я не нашел ответ на свой вопрос.
                    </a>
                  </div>
                  <div style="height: 0px;" id="collapse12" class="accordion-body  collapse">
                    <div class="accordion-inner">
                      В этом случае обратитесь в службу технической поддержки, наши специалисты ответят на ваши вопросы в кратчайший срок.<br>
                        <a href="https://lider-finance.ru/supp.php">Служба поддержки</a>
                    </div>
                  </div>
                </div>
              </div>
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