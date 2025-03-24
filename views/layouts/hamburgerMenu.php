<div class="showSmall">
	<div style="display: flex;justify-content: space-evenly;align-items: center;transition-duration: 2s;">
		<div>
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
			<div class='text-left'>		
				<a style="margin-top:0px;" href="#" tabindex="0" data-trigger="focus" class="btn btn-lg"
					data-container="body" role="button" data-toggle="popover" 
					data-placement="bottom" data-html="true" title = "<?=$nm?>" data-content="<?=$content?>">
					<i class="fa fa-bars fa-1x"></i>
				</a>
			</div>
		</div>
		<div>
			<?=Auxiliary::showReklRand()?>
		</div>
	</div>
</div>