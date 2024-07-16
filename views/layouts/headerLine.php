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
							<!-- Привіт <b>відвідувач</b><br> -->	
						<?php endif; ?>
					</div><br><br>
					<div class="text-right">
						<a href="https://www.facebook.com/Гомін-Галичини-398431253663801" target="_blank">
							<!-- <i class="fa-brands fa-facebook-f"></i> -->
							<img src="/image/fb.png" height="30" width="auto" alt="Facebook Гомін Галичини" title="Фейсбук Гомін Галичини">
<!-- 							<div style="width: 10px;height: auto;">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/></svg>
							</div> -->
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>