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
		<div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
			<nav class="main_menu clearfix">
				<?php include 'views/layouts/headerMenu.php' ?>
			</nav>
		</div>
	<!-- <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
		<?=Auxiliary::showReklRand()?>
	</div> -->

	</div>

<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"></div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<?=Auxiliary::showReklRand(true)?>
	</div>
	<div class="top_links">
		<?php if (User::isGuest()) :?>
			<?php if (User::isGuest()['admin'] == 1) :?>
				
					<div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
						<a href='/newsEdit'>
							адмінпанель
						</a>
					</div>
				<?php endif; ?>
				<div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
					<a href='/userChangedata' title='редагування своїх даних'>
						редагування
					</a>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
					<a href='/userUnreg'>
						вийти
					</a>
				</div>
			
		<?php endif; ?>
		</div>
	</div>
</div>