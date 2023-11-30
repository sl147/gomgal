<script src="js/showcontent.js" type="text/javascript"></script>
<script>	
	function getRadioGroupValue(radioGroupObj)
	{
		for (var i=0; i < radioGroupObj.length; i++)
			if (radioGroupObj[i].checked) return radioGroupObj[i].value;
		return null;
	}	
</script>
<div id="contentBody">
	<p align='center'><?=$vote['name']?></p>
	<form name='vote_form'>
		<?php foreach ($txtVote as $item) :?>	
			<div style='color:blue; font-size:16px;'>
				<b>
					<input type='radio' name='vote' value='<?=$item['id']?>'><?=$item['msg']?><br>	
				</b>
			</div>
		<?php endforeach; ?>
		<br>
		<input type='button' onclick='js/showContent(\"vote.php?select=\"+getRadioGroupValue(document.vote_form.vote));' value='Проголосувати'>
	</form>
</div>
<div id="loading" style="display: none">
	завантажуєм...
</div>