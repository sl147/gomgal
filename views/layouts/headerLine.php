<header>
	<div class="header_topline">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
					<a href="/main">
 						<img src="/image/gg.png" alt="Гомін Галичини" title="новини з Галичини оголошення" height="50" width="auto"> 
 					</a>
					<div class="datecurr">
						<script type="text/javascript">datecurr()</script>	
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-6 col-xs-12"></div>
				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<?=Auxiliary::showReklRand()?>		
<!-- 					<a href="/insurance" target="_blank">
						<img src="/image/autosmall.png" height="80" width="auto" alt="Калькулятор страхування цивільної відповідальності">
					<a/> -->
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="top_links">
						<?php if (User::isGuest()) :?>
							Привіт <b><?=User::isGuest()['name']?> </b><br>
							<?php if (User::isGuest()['admin'] == 1) :?>
								<a href='/newsEdit'>
									адмін |
								</a>
							<?php endif; ?>
							<a href='/userChangedata' title='редагування своїх даних'>
								редагування |
							</a>
							<a href='/userUnreg'>
								вийти
							</a>
						<?else :?>
							Привіт <b>відвідувач</b><br>	
						<?php endif; ?>
					</div><br><br>
					<div class="text-right">
						<a href="https://www.facebook.com/Гомін-Галичини-398431253663801" target="_blank">
							<img src="/image/fb.png" height="30" width="auto" alt="Facebook Гомін Галичини" title="Фейсбук Гомін Галичини">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>