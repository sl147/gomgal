<?php
$p = new Poster();
 if ($list['foto_p1']) :
	if (Auxiliary::isFile($file)) :?>
		<td><a class='fancybox' rel='group' href='/<?=$file?>'>
			<img class='postfotosize' src='/<?=$file?>'>
		</a></td>
	<?php else: 
		$p->showNoPhoto(NO_PHOTO);
	endif; ?>				
<?php else:
	$p->showNoPhoto(NO_PHOTO);
endif;
unset($p); ?>