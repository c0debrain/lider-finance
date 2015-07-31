<?php
class investor {

    var $perfect_money_login = "2528382";
    var $perfect_money_password = "herov4lensatana666";

    public function review($id, $review){
        $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
        mysql_select_db ("u6761949_default",$db);
        mysql_query("SET NAMES utf8");
        $result = mysql_query("SELECT * FROM users WHERE client_id = '$id'",$db);
        $myrow = mysql_fetch_assoc($result);
        if($myrow['review'] == 'NULL'){
            mysql_query("UPDATE users SET review = '$review' WHERE client_id = '$id'");
            echo "Вы успешно оставили отзыв <br><br>";
        } else {
            echo "Вы уже оставляли отзыв, нельзя оставлять больше одного отзыва <br><br>";
        }
    }

    public function batch($id, $batch){
        $unix_start = time() - 1728000;
        $year_start = date('Y', $unix_start);
        $month_start = date('m', $unix_start);
        $day_start = date('d', $unix_start);

        $year = date('Y', time());
        $month = date('m', time());
        $day = date('d', time());

        $login = $this->perfect_money_login;
        $password = $this->perfect_money_password;
        $f=fopen("https://perfectmoney.is/acct/historycsv.asp?startmonth=$month_start&startday=$day_start&startyear=$year_start&endmonth=$month&endday=$day&endyear=$year&AccountID=$login&PassPhrase=$password", 'rb');
        if($f===false){
            $error = 'Ошибка открытия Perfect Money';
        }
        $lines=array();
        while(!feof($f)){
            array_push($lines, trim(fgets($f)));
        }
        fclose($f);
        $ar=array();
        $n=count($lines);
        $success = 0;
        for($i=1; $i<$n; $i++){
            $item=explode(",", $lines[$i], 9);
            if(count($item)!=9) continue;
            $item_named['Time']=$item[0];
            $item_named['Type']=$item[1];
            $item_named['Batch']=$item[2];
            $item_named['Currency']=$item[3];
            $item_named['Amount']=$item[4];
            $item_named['Fee']=$item[5];
            $item_named['Payer Account']=$item[6];
            $item_named['Payee Account']=$item[7];
            $item_named['Memo']=$item[8];
            if($item_named['Batch'] == $batch){
                $success = 1;
                $amount = $item_named['Amount'];
                $payer = $item_named['Payer Account'];

            }
            array_push($ar, $item_named);
        }


        if($success == 0){
            $error = "Введённый вами batch код отсутствует";
        } else {
            if($amount >= 25 && $amount <= 350){
                $type_deposit = 'thefaststart';
                $nakoplenie = 1.9;
            } elseif($amount > 350 && $amount <= 1500) {
                $type_deposit = 'thefirstcapital';
                $nakoplenie = 2;
            } elseif($amount > 1500 && $amount <= 5000){
                $type_deposit = 'business';
                $nakoplenie = 2.1;
            } else {
                $type_deposit = 'thefaststart';
            }
        }

        $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
        mysql_select_db ("u6761949_default",$db);
        mysql_query("SET NAMES utf8");
        $result = mysql_query("SELECT * FROM perfect",$db);
        while($myrow = mysql_fetch_assoc($result)){
            if($myrow['batch'] == $batch){
                $error = 'Такой batch уже использован';
                $success = 0;
            }
        }

        if($success == 1){
            $date = date('d-m-Y', time());
            $unix_date = time();

            $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
            mysql_select_db ("u6761949_default",$db);
            mysql_query("SET NAMES utf8");

            mysql_query("INSERT INTO deposits (investor_id, type_deposits, sum_deposits, date_deposits,
                     income_deposits, out_deposits, procent_deposits, day, work, counter) VALUES ('$id', '$type_deposit',
                     '$amount', '$date', 0, 0, 0, 0, 1, '$unix_date')");

            mysql_query("UPDATE users SET vklad_on = 1 WHERE client_id = '$id'");

            $date = date('Y-m-d', time());
            mysql_query("INSERT INTO perfect (amount, batch, payer, time, type_deposits, id_investor) VALUES
                      ('$amount', '$batch', '$payer', '$date', '$type_deposit', '$id')");

            mysql_query("INSERT INTO history_bill (investor_id, date_bill, description_bill,
                    id_deposits, sum_deposits) VALUES ('$id', '$date', 'Вклад', 0,
                    '$amount')");

            echo "Вы успешно открыли депозит";

        } else {
            echo $error;
        }
    }

	public function user_cookie($login,$id,$save) {
		if($save == 1) {
			$_COOKIE['login'] = $login;
			$_COOKIE['id'] = $id;
		} 
		echo $_COOKIE['login'];
    }

    public  function  get_deposit_status($id, $vklad_on){
        if($vklad_on == 1){
        $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
        mysql_select_db ("u6761949_default",$db);
        mysql_query("SET NAMES utf8");
        $result = mysql_query("SELECT * FROM deposits WHERE investor_id = '$id' AND sum_deposits > 0",$db);
        /* Collapse begin */
        echo '<div class="accordion" id="accordion">';
        /* Collapse content */
        $counter = 0;
        while($myrow = mysql_fetch_array($result)){
            $type_deposits = $myrow['type_deposits'];
            $sum = $myrow['sum_deposits'];
            $date = $myrow['date_deposits'];
            $date = strtotime($date);
            $day = date('d', $date);
            $month = date('m', $date);
            $year = date('Y', $date);
            $date = "$day.$month.$year";
            if($type_deposits =='thefaststart') {
                $percentage = 1.9;
                $nakoplenie = round(($sum/100) * $percentage, 2);
                $vklad_name = "The Fast Start";
                $img = '<img src="https://lider-finance.ru/assets/img/2pr.png" align="left" width="50" margin-right="10">';
            } elseif ($type_deposits =='thefirstcapital'){
                $percentage = 2;
                $nakoplenie = round(($sum/100) * $percentage, 2);
                $vklad_name = "The First Capital";
                $img = '<img src="https://lider-finance.ru/assets/img/25pr.png" align="left" width="50" margin-right="10">';
            } elseif ($type_deposits =='business'){
                $percentage = 2.1;
                $nakoplenie = round(($sum/100) * $percentage, 2);
                $vklad_name = "Business";
                $img = '<img src="https://lider-finance.ru/assets/img/3pr.png" align="left" width="50" margin-right="10">';
            }
            $RemTime = ($myrow['counter'] + 86400);
            $HTime = date('H', $RemTime);
            $ITime = date('i', $RemTime);
            $days = 60 - $myrow['day'];
            $deposit = $myrow['sum_deposits'];
            $profit = $nakoplenie * 60;
            if($myrow[work] == 1){
                $status = 'background: rgba(0, 239, 62, 0.23);';
                $message = "Вклад $deposit$ <span style='float: right;'>Предпологаемая прибыль $profit$</span>
                                    <br>Следующая выплата в: $HTime:$ITime    <span style='float: right;'>Дней осталось: $days</span>";
            } else {
                $status = 'background: rgba(239, 0, 1, 0.15);';
                $message = "Вклад $deposit$ <span style='float: right;'>Прибыль $profit$</span><br>
                                    Время работы вклада истекло";
            }

            echo <<<HERE
                <div class="accordion-group">
                  <div class="accordion-heading" style="$status">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#$counter">
                      $img<div style="margin-left: 70px;"><p align="left"><strong>$vklad_name </strong><span style='float: right;'>$date</span>
                      <br/>Ежедневные начисления по $nakoplenie$.</p></div>
                    </a>
                  </div>
                  <div style="height: 0px;" id="$counter" class="accordion-body collapse">
                    <div class="accordion-inner">
                        $message
                    </div>
                  </div>
                </div>
HERE;
            $counter++;
        }
        /* Collapse End */
        echo '</div>';
        } else {
            echo 'Вы пока не сделали ни одного вклада. Чтобы сделать вклад, нажмите в верхнем меню пункт "Вклады".';
        }
    }

	public function get_deposits_col(){
			echo <<<HERE
		<div class="row">
        	<div class="col-lg-4">
        	 <div class="thumbnail text-center">
			      <img src="https://lider-finance.ru/assets/img/2pr.png" style="max-height: 170px; max-width: 170px;" alt="">
			      <div class="caption">
			        <h3>The Fast Start</h3>
			        <!--<p>Предоставляет <strong>114% дохода</strong> за вклад на 60 дней. Инвестиционный лимит по данному плану составляет <strong>25 — 300 USD</strong>. Открыть новый депозит по данному плану можно 1 раз в сутки. Начисления на внутренний счет вкладчика производятся автоматически, 1 раз в сутки (на общую сумму <strong>1.9%</strong> от суммы вклада). Вывод накоплений из нашей система осуществляется по вашему запросу и является моментальным.</p>-->
			        <hr>
			        <p><a href="https://lider-finance.ru/investor/deposits/the-fast-start/" class="btn btn-info">Открыть вклад</a></p>
			      </div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="thumbnail text-center">
			      <img src="https://lider-finance.ru/assets/img/25pr.png" style="max-height: 170px; max-width: 170px;" alt="">
			      <div class="caption">
			        <h3>The First Capital</h3>
			        <!--<p>Предоставляет <strong>138% дохода</strong> за вклад на 60 дней. Инвестиционный лимит по данному плану составляет <strong>301 — 1500 USD</strong>. Открыть новый депозит по данному плану можно 1 раз в сутки. Начисления на внутренний счет вкладчика производятся автоматически, 1 раз в сутки (на общую сумму <strong>2.3%</strong> от суммы вклада). Вывод накоплений из нашей система осуществляется по вашему запросу и является моментальным.</p>-->
			        <hr>
			        <p><a href="https://lider-finance.ru/investor/deposits/the-first-capital/" class="btn btn-info">Открыть вклад</a></p>
			      </div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="thumbnail text-center">
			      <img src="https://lider-finance.ru/assets/img/3pr.png" style="max-height: 170px; max-width: 170px;" alt="">
			      <div class="caption">
			        <h3>Business</h3>
			        <!--<p>Предоставляет 180% дохода за вклад на 60 дней. Инвестиционный лимит по данному плану составляет 1501 — 5000 USD. Открыть новый депозит по данному плану можно 1 раз в сутки, при условии, что данный план вписывается в автоматически установленный системой суточный лимит по депозитам. Начисления на внутренний счет вкладчика производятся автоматически, 1 раз в сутки (на общую сумму 3% от суммы вклада). Вывод накоплений из нашей система осуществляется по вашему запросу и является моментальным.</p>-->
			        <hr>
			        <p><a href="https://lider-finance.ru/investor/deposits/business/" class="btn btn-info">Открыть вклад</a></p>
			      </div>
				</div>
			</div>
        </div>	
HERE;
		}

	public function payment($id){
        if(isset($_POST['ok'])){
            $perfect_user = $_POST['payee'];
            $payment = $_POST['payment'];
            $login = $this->perfect_money_login;
            $password = $this->perfect_money_password;
            $f=fopen("https://perfectmoney.is/acct/confirm.asp?AccountID=$login&PassPhrase=$password&Payer_Account=U1875378&Payee_Account=$perfect_user&Amount=$payment&PAY_IN=$payment", "rb");
            if($f===false){
                $error = 2;
            }

            $out=array(); $out="";
            while(!feof($f)) $out.=fgets($f);

            fclose($f);

            $ar="";
            foreach($result as $item){
                $key=$item[1];
                $ar[$key]=$item[2];
            }

            $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
            mysql_select_db ("u6761949_default",$db);
            mysql_query("SET NAMES utf8");

            $capital = 0 - $payment;
            $out_capital = 0 - $payment;
            mysql_query("INSERT INTO deposits (investor_id, type_deposits,
            income_deposits, out_deposits) VALUES ('$id', 'payment_out', '$capital', '$out_capital')");

            $date = date('Y-m-d', time());
            mysql_query("INSERT INTO history_bill (investor_id, date_bill, description_bill,
            id_deposits, sum_deposits) VALUES ('$id', '$date', 'Вывод', 0,
            '$payment')");
        }
    }





	public function get_user_invest_info($id, $vklad_on) {
		if($vklad_on >= 1) {
			$this->user_get_balance_2($vklad_on,$id);
		} else {
			echo <<<HERE
			  <li class="list-group-item">
			  	<p>У вас нет ни одного вклада.</p>
			  </li>		
HERE;
		}
	}

	public function get_history_bill($login, $id, $vklad_on){
		if($vklad_on == 1){
			$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
		    mysql_select_db ("u6761949_default",$db);
			mysql_query("SET NAMES utf8");
			$result = mysql_query("SELECT * FROM history_bill WHERE investor_id='$id'",$db);
                echo "
		            <div class='over_table'>
		            <table class='table' style='overflow: scroll;'>
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>Дата</th>
                    <th>Операции</th>
                    <th>Депозит</th>
                    </tr>
                    </thead>
                    <tbody>
                    </div>";
                $i = 1;
                while($row = mysql_fetch_array($result)){
                    echo "<tr><td>$i</td><td>".$row['date_bill']."</td><td>".$row['description_bill']."</td><td>".$row['sum_deposits']."</td></tr>";
                    $i++;
                }
                echo <<<HERE
			</tbody>
      </table>
HERE;

		} else {
			echo "Мы не можем предоставить Вам историю платежей, так как у вас нет ни одного вклада и платежа. Для начала <a href='https://lider-finance.ru/investor/deposits'>откройте свой первый вклад</a>.";
		}
	}



    public function deposits_values($vklad_on, $id){
        if($vklad_on >= 1){
            $db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
            mysql_select_db ("u6761949_default",$db);
            mysql_query("SET NAMES utf8");
            $result = mysql_query("SELECT * FROM deposits WHERE investor_id = $id", $db);
            while($myrow=mysql_fetch_array($result)){
                //Проверка работы выплат
                if($myrow['work'] == 1){
                    $deposit_id = $myrow['id_deposits'];
                    $type_deposits = $myrow['type_deposits'];
                    //Определение типа вклада
                    if($myrow['type_deposits']=='thefaststart') {
                        $nakoplenie = 1.9;
                    } elseif ($myrow['type_deposits']=='thefirstcapital'){
                        $nakoplenie = 2;
                    } elseif ($myrow['type_deposits']=='business'){
                        $nakoplenie = 2.1;
                    } else {
                        $nakoplenie = 0;
                    }
                    //Вложения
                    $sum = $myrow['sum_deposits'];
                    //Подсчёт капитала за 1 день
                    $procent = ($sum/100) * $nakoplenie;
                    $procent = round($procent, 2);
                    //Количество выплачиваемых дней
                    $day = $myrow['day'];
                    //Дата предыдущих начислений или дата вклада
                    $start = $myrow['counter'];
                    //Определение настроящего времени
                    $time = time();
                    //Подсчёт дней выплат
                    $days = (int)(((($time - $start) / 86400))); //ИЗМЕНЯТЬ ВРЕМЯ ЗДЕСЬ
                    //Если сумма пропущенных дней выплат и уже оплаченных дней больше 60
                        if(($day+$days) > 60){
                            //Вычет лишних дней
                            $days = $days - ($day+$days-60);
                        }
                        //Если дней меньше или равно 60
                        if($day <= 60){
                            //Если уже прошёл 1 день с предыдущей выплаты
                        if(($time-$start) >= 86400){
                            //Текущий депозит
                            $capital = $myrow['income_deposits'];
                            //Увеличение текущего депозита в зависимости от процентов и пропущенный дней
                            $capital = $capital + $procent * $days;
                            $capital = round($capital, 2);
                            //Увеличение дней
                            $day += $days;
                            //Новая точка отчёта
                            $time = $time - ($time-$start-86400*$days);
                            //Подсчёт капитала на вывод 1% вычитается
                            $capital_out = $capital - ($capital / 100);
                            $capital_out = round($capital_out, 2);
                            //Отмена выплат если дней больше 60
                            if($day >= 60){
                                $work = 0;
                                $procent = 0;
                            } else {
                                $work = 1;
                            }
                            mysql_query("UPDATE deposits SET counter = '$time', income_deposits = '$capital',
                            out_deposits = '$capital_out', procent_deposits = '$procent', day = '$day', work = '$work'
                            WHERE investor_id = '$id' AND id_deposits = '$deposit_id'");
                            for($i = 1; $i <= $days; $i++){
                                $date_bill = date('Y-m-d', ($start + $days*86400) - 86400*($days-$i));
                                mysql_query("INSERT INTO history_bill (investor_id, date_bill, description_bill,
                                id_deposits, sum_deposits) VALUES ('$id', '$date_bill', 'Начисление', '$deposit_id',
                                '$procent')");
                            }
                        }
                    }
                }
            }
        }
    }


	public function user_get_balance_1($vklad_on,$id) {
		if($vklad_on >= 1){
			$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
		    mysql_select_db ("u6761949_default",$db);
			mysql_query("SET NAMES utf8");
			$result = mysql_query("SELECT * FROM deposits WHERE investor_id='$id'",$db); 
			$capital_sum = 0;
            $sum_sum = 0;
            while($myrow = mysql_fetch_array($result))
            {
			$capital = $myrow['income_deposits'];
            $capital_sum +=  $capital;
			$sum = $myrow['sum_deposits'];
            $sum_sum += $sum;
            }
			echo <<<HERE
			<small> Депозит: <span class="text-success">$capital_sum $</span> / Инвестированно: <span class="text-info"> $sum_sum $</span></small>
HERE;
		} else {
			echo "<small> Вы еще не открыли ни одного вклада. Для начала <a href='https://lider-finance.ru/investor/deposits'>откройте свой первый вклад</a>.</small>";
		}
	}
	public function user_get_balance_2($vklad_on,$id) {
		if($vklad_on == 1){
		$db = mysql_connect ("localhost","u6761949_default","heilhitler1488");
	    mysql_select_db ("u6761949_default",$db);
		mysql_query("SET NAMES utf8");
		$result = mysql_query("SELECT * FROM deposits WHERE investor_id='$id'",$db);
        $invest_sum = 0;
        $capital = 0;
        $procent = 0;
        $komisia = 0;
        while($myrow = mysql_fetch_array($result)){
            $invest_sum += $myrow['sum_deposits'];
            $capital += $myrow['income_deposits'];
            $komisia += $myrow['out_deposits'];
            $procent += $myrow['procent_deposits'];

        }

		echo <<<HERE
			<li class="list-group-item">
			    <span class="badge">$invest_sum$</span>
			    Инвестированно
			</li>
			<li class="list-group-item">
			    <span class="badge">$capital$</span>
			    Текущий депозит
			</li>
			<li class="list-group-item">
			    <span class="badge">$komisia$</span>
			    С коммисией
			</li>
			<li class="list-group-item">
			    <span class="badge">+$procent$</span>
			    Доход на сегодня
			</li>
			<li class="list-group-item">
		  	<div class="row">
		  		<div class="col-lg-6">
		  			<a href="https://lider-finance.ru/investor/payments" class="btn btn-small btn-info" >Вывести средства</a>
		  		</div>
		  	</div>
		  	</li>
HERE;
		} else {

			echo <<<HERE
			<li class="list-group-item">
			    <span class="badge">$capital$</span>
			    Текущий депозит
			</li>
			<li class="list-group-item">
			    <span class="badge">+$nakoplenie%</span>
			    Доход на сегодня
			</li>
			<li class="list-group-item">
			  	<div class="row">
			  		<div class="col-lg-12 text-center">
			  			<a href="https://lider-finance.ru/investor/payments" class="btn btn-small btn-info" >Вывод средств</a>
			  		</div>
			  	</div>
			  </li>
HERE;
		}
	}
}
class html {

	public function footer(){
        //<script type="text/javascript" src="https://seal.thawte.com/getthawteseal?host_name=lider-finance.ru&size=S&lang=en"></script>
		echo <<<HERE
			    <div id="footer">
      <div class="container">
        <p class="text-muted credit"><span style="float: left; margin-right: 50px;">© 2013 Lider-finance.ru</span>  <a href="https://perfectmoney.is/"><img src="https://lider-finance.ru/assets/img/logo3.png" style="float:right;" width="150px"></a></p>
      </div>
    </div>
HERE;
	}
	
	public function nav(){
		echo <<<HERE
	<!-- Fixed navbar -->
      <div class="navbar navbar-fixed-top" style="background: #f1f1f1; box-shadow: 0px 0px 3px #333;">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://lider-finance.ru/" style="width: 200px; height: 51px; background: url(https://lider-finance.ru/investor/bootstrap/img/logo-cab.png);"></a>
          <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="https://lider-finance.ru/investor/">Профиль</a></li>
              <li><a href="https://lider-finance.ru/investor/deposits/">Вклады</a></li>
              <li><a href="https://lider-finance.ru/investor/news/">Новости</a></li>
              <li><a href="https://lider-finance.ru/investor/support/">Поддержка</a></li>
              <li><a href="https://lider-finance.ru/investor/exit.php">Выход</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
HERE;

	}
}
?>