<div class="container-fluid">
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 textColor">
			<div class="container-fluid">
				<div class="row">
					<?php include 'views/layouts/hamburgerMenu.php';?>						
						<div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">	
							<div class="btn-group btn-group-justified">		
								<h1 class="text-center">контакти</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="showLarge">
				<p>Газета виходить з 26 липня 2002 року.</p>
				<p>Засновник  <b>ПП "Інфо-Промінь"</b></p>
				<p>Передплатний індекс <b>23784</b></p>
				<p>Реєстраційне свідоцтво <b>ЛВІ 747 від 21.02.2006 р</b></p>
				<p>Рахунок <b>UA523257960000026004300152803</b></p>
				<p>Головний редактор - <b>Анна Баневська</b></p>
				<p>тел./факс:(0324) 45 00 51  (067) 724-41-23</p>
			</div>
			<div class="showSmall">
				Газета виходить з 26 липня 2002 року.<br>
				<br>Засновник  <b>ПП "Інфо-Промінь"</b><br>
				<br>Передплатний індекс <b>23784</b></br>
				<br>Реєстраційне свідоцтво <b>ЛВІ 747 від 21.02.2006 р</b><br>
				<br>Рахунок <b>UA523257960000026004300152803</b><br>
				<br>Головний редактор - <b>Анна Баневська</b><br>
				<br>тел./факс:(0324) 45 00 51  (067) 724-41-23<br>
			</div>
			<p>Будем раді отримати від Вас пропозиції, побажання, відгуки про наш сайт.</p>
			<p>Також можна додати свою цікаву інформацію - будем вдячні і опублікуєм.</p>

			<form role="form" id = "auth3" method="POST">
				<fieldset>
					<legend class="text-center textColor">Додати повідомлення</legend>
					<label>Ім'я</label>
					<input class="form-control" name="nik_com" type="text" required><br>
					<label>E-mail<br>(необов’язково)</label>
					<input class="form-control" name="email_com" type="email"><br>
					<label>Повідомлення</label>
					<textarea class="form-control" style="width: 100%;" name = "txt_com" rows =7 required></textarea><br><br>
					<button name="submit" type="submit" class="btn-block btn btn-info btn-lg">
						Відправити
					</button>
				</fieldset>
			</form>
		</div>
	</div>
</div>