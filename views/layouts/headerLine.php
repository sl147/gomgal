<header>
	<div class="header_topline">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<!-- 					<img src="/image/gg.png" alt="Гомін Галичини" title="новини з Галичини оголошення" height="50" border="0"> -->
					<img src="/image/GG-logo-NY.webp" alt="Гомін Галичини" title="новини з Галичини оголошення" height="50" border="0">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<script type="text/javascript">datecurr()</script>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
					</div>							
				</div>
			</div>
		</div>													
	</div>
</header>