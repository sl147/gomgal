<br><br>
<div class = 'text-center' style='color: red;'><b>Що ще читають на цю тему</b></div> 

<?php foreach ($newsOther as $it) :?>
	<a class='adecor' href='/Fullnew/<?=$it["id"]?>'>
		<h4>
			<?=$it["title"]?>
		</h4>
	</a>
<?php endforeach; ?>
<br><br><br>