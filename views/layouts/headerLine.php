<header>
	<div class="header_topline">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
 					<img src="/image/gg.png" alt="Гомін Галичини" title="новини з Галичини оголошення" height="50" border="0"> 
					<!--<img src="/image/GG-logo-NY.webp" alt="Гомін Галичини" title="новини з Галичини оголошення" height="50" border="0">-->
					<div style="padding-left: 60px; padding-top:5px; color:grey">
						<script type="text/javascript">datecurr()</script>	
					</div>

				</div>

				<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12"></div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<a href="/insurance" target="_blank">
							<img src="/image/autosmall.png" height="80" width="auto" alt="">
						<a/>
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
							<img src="/image/fb.png" height="30" width="auto" alt="">
						</a>
					</div>							
				</div>
			</div>
		</div>													
	</div>
</header>