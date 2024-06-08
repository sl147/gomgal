<?php
 if ($list['foto_p1']) :
	if (file_exists($file)) :?>
		<td class="showLarge"><a class='fancybox' rel='group' href='/<?=$file?>'>
			<img class='postfotosize' src='/<?=$file?>'>
		</a></td>
	<?php else: 
		?>
		<td class="showLarge"><a class='fancybox' rel='group' href='<?php echo NO_PHOTO?>'>
			<img class='postfotosize' src='<?php echo NO_PHOTO?>'>
		</a></td>
<?php
	endif; ?>
<?php else:
	?>
		<td class="showLarge"><a class='fancybox' rel='group' href='<?php echo NO_PHOTO?>'>
			<img class='postfotosize' src='<?php echo NO_PHOTO?>'>
		</a></td>
<?php
endif;