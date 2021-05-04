<?php
/**
* 
*/
class ClickButtonController {

	use traitAuxiliary;

	public function actionGov($type)
	{
		if (!empty($_SERVER['HTTP_REFERER']))
        {
        	$this->plusClickButton($type);
        }
		
		switch ($type) {
			case '1':
				$this->formMail('сайт COVID');
				header("Location: https://covid19.rnbo.gov.ua");
				break;

			case '2':
				$this->formMail('сайт президента');
				header("Location: https://www.president.gov.ua");
				break;

			case '3':
				$this->formMail('сайт верховної ради');
				header("Location: https://rada.gov.ua");
				break;

			case '4':
				$this->formMail('сайт кму');
				header("Location: https://www.kmu.gov.ua");
				break;

			case '5':
				$this->formMail('сайт державних послуги');
				header("Location: https://igov.org.ua");
				break;
			
			case '6':
				$this->formMail('сайт webcams online');
				header("Location: https://drohobych-rada.gov.ua/webcams");
				break;

			default:
				# code...
				break;
		}
	}

	public static function showWeather() {
			include ('views/layouts/showWeather.php');
	}

	public function actionCountClickButton()
	{
		$result = $this->getCountClickButton();
		while ($row = $result->fetch()) {
			$countButton[]   = $row;
		}
		
		require_once ('views/admin/viewClickButton.php');
		return true;
	}
}
?>