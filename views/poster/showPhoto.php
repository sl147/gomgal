<?php
$p = new Poster();
 if ($list['foto_p1']) :
	if (file_exists($file)) :?>
		<td class="showLarge"><a class='fancybox' rel='group' href='/<?=$file?>'>
			<img class='postfotosize' src='/<?=$file?>'>
		</a></td>
	<?php else: 
		$p->showNoPhoto(NO_PHOTO);
	endif; ?>				
<?php else:
	$p->showNoPhoto(NO_PHOTO);
endif;
unset($p); ?>