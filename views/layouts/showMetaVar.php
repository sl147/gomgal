<?php
$MT = new MetaTags();

if (isset($news))
{
	$MT->showMeta($metaTags,$news);
}
elseif (isset($posterOne))
{
	$MT->showMeta($metaTags,$posterOne);
}
else
{
	$MT->showMeta($metaTags);
}