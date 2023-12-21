<div class="row ">
<div class="col-lg-0 col-md-0 col-sm-2 col-xs-2">
	<?php
		$content ="<div class='text-center' >
		    <a href='/' title='ГОЛОВНА' class='text-menu btn btn-info'>ГОЛОВНА</a>
		    <a href='/relax/1' title='ДОЗВІЛЛЯ' class='text-menu btn btn-info'>ДОЗВІЛЛЯ</a>
		    <a href='/posterCat' title='оголошення' class='text-menu btn btn-info'>оголошення</a>
		    <a href='/FAlook' title='перегляд фотоальбомів Галичини' class='text-menu btn btn-info'>ФОТОАЛЬБОМИ</a>
		    <a href='/video' title='відео' class='text-menu btn btn-info'>відео</a>
		    <a href='/contakt' title='контакти' class='text-menu btn btn-info'>контакти</a>
		</div>";
		$nm = "меню";
	?>
	<div class='showSmall text-left'>		
			<a style="margin-top:0px;" href="#" tabindex="0" data-trigger="focus" class="btn btn-lg"
				data-container="body" role="button" data-toggle="popover" 
				data-placement="bottom" data-html="true" title = "<?=$nm?>" data-content="<?=$content?>">
				<i class="fa fa-bars fa-1x"></i>
			</a>			
	</div>
</div>
<div class='col-lg-0 col-md-0 col-sm-10 col-xs-10'>
	<?=Auxiliary::showReklRand()?>	
<!-- 			<a href="https://www.gomgal.lviv.ua/insurance" target='_blank'>
				<img class='insImgSize' height="50" width="auto" src="../image/autosmall.png" alt="калькулятор автоцивілки">
			</a>	 -->	
</div>
</div>