<script src="/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("img.imgLazy").lazyload({
      effect: "fadeIn"
    });
  });
</script>
<br><br>
<div class = 'text-center' style='color: red;'><b>Що ще читають на цю тему</b></div> 
<div class="container-fluid">
	<div class="row">
		<?php foreach ($newsOther as $item) :?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class='bordLeft media'>
						<?php if ($item['foto']) :?>
							<?php if (file_exists("NewsFoto/".$item['foto'])) :?>
								<a style='text-decoration: none;' class='media-left media-top' href='/Fullnew/<?=$item["id"]?>'>
									<img class="imgLazy" alt='фото новини' width='80' height='auto' src='<?="/NewsFoto/".$item['foto']?>' title='<?=$item["title"]?>'>
								</a>
							<?php endif; ?>
						<?php endif; ?>
						<a style='text-decoration: none;' class='media-body ' href='/Fullnew/<?=$item["id"]?>' title='<?=$item["title"]?>'>
							<?=$item["title"]?>						
						</a>
					</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<br><br><br>