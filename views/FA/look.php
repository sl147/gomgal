<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.fotoLook").lazyload({
      effect: "fadeIn"
    });
  });
</script>

<?php include 'views/layouts/hamburgerMenu.php';?>

<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 class="text-center">
						ФОТОАЛЬБОМИ
					</h2>
				</div>
			</div>
		</div>
<table class="table table-responsive table-striped table-hover">
	<tbody>
		<?php $j=true; foreach ($faList as $item) :?>
					<?php if($j) :?>
						<?php $j=false;?>
			<tr><td style="width: 100%;"><?=Auxiliary::getAdSence()?></td></tr>
			<?php endif;?>
			<tr>
				<td>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<a href="/FAlookOne/<?=$item ['id']?>" title="<?$item['name']?>">
								<img class="fotoLook" src="<?=$item ['foto']?>">
							</a>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<a href="/FAlookOne/<?=$item ['id']?>" title="<?$item['name']?>">
								<?=$item['name']?>
							</a>
						</div>
					</div>									
				</td>
			</tr>

		<?php endforeach; ?>
	</tbody>
</table>
<?php if ($this->total > SHOWFA_BY_DEFAULT) :?>
<div class="text-center"><?php echo $pagination->get(); ?></div>
<?php endif ;?>