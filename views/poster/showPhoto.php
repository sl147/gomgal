<?php if ($list['foto_p1']) :
	if (Auxiliary::isFile($file)) :?>
		<td><a class='fancybox' rel='group' href='/<?=$file?>'>
			<img class='postfotosize' src='/<?=$file?>'>
		</a></td>
	<?php else: 
		Poster::showNoPhoto(NO_PHOTO);
	endif; ?>				
<?php else:
	Poster::showNoPhoto(NO_PHOTO);
endif; ?>