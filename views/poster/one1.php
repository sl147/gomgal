<style>

	.close {

position: absolute;

right: 32px;

top: 32px;

width: 32px;

height: 32px;

opacity: 0.3;

}

.close:hover {

opacity: 1;

}

.close:before, .close:after {

position: absolute;

left: 15px;

content: ' ';

height: 33px;

width: 2px;

background-color: #333;

}

.close:before {

transform: rotate(45deg);

}

.close:after {

transform: rotate(-45deg);

}

</style>

<?php include 'views/poster/menuPoster.php';?>

<div class="container-fluid">

	<div class="row">

		<div class='posterTXT col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center'>

			№ оголошення: <?= $posterOne["id_poster"]?>

		</div>

		<div class="showLarge">

			<div class='posterTXT col-lg-4 col-md-4 col-sm-2 col-xs-2'>

				<?$p = new Poster();?>

				<?= $p->getTypePost($posterOne["type_p"])?>

			</div>

			<div class='posterTXT col-lg-4 col-md-4 col-sm-4 col-xs-4'>

				<?=$posterOne["date_p"]?>

			</div>

		</div>

	</div><br>

	

	<div class="row">

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

			<?=$p->showPhoto($posterOne);unset($p)?>

		</div>		

		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

			<div class="posterMSG">

				<?=$posterOne["msg_p"]?><br><br>

			Надіслав(ла): <?=$posterOne['name_p']?><br>

			e-mail: <?=$posterOne['email_p']?>

			</div>

					

		</div>

		<div class="close1"></div>

	</div>

</div>

<script>

	$('.close').on('click', function() {

		$('.row').toggle()

		//$('.posterTXT').css('display','none')

  // действия, которые будут выполнены при наступлении события...

  console.log($(this).text());

  alert($(this).text());

});

</script>