<?php
/**
 *  traitAuxiliary
 */

//namespace classes;

trait traitAuxiliary
{
	public function formSql($atr,$value)
	{
		return " WHERE ".$atr." = '".$value."'";
	}

	public function getIntval ($i) : int
	{
        return intval($i) ?? 1;
	}

	public static function sendMail($subject,$to,$massage) {
		$from    = "info@gomgal.lviv.ua";
		$headers = "From: $from\r\nReplay-To: $from\r\nContent-Type: text/plain; charset=utf-8\r\n ";
		return mail($to,$subject,$massage,$headers);
	}
	
	public  function filterINT($type, $field)
	{
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_VALIDATE_INT);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_VALIDATE_INT); 
			break;

			default:
			break;
		}
		return $output;
	}

	public function filterTXT($type, $field)
	{
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 
			break;

			default:
			break;
		}

		return $output;
	}

	public function filterEmail($type, $field) {
		switch($type)
		{
			case 'get':
			$ouput = filter_input(INPUT_GET, $field, FILTER_VALIDATE_EMAIL);
			break;

			case 'post':
			$output = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL); 
			break;

			default:
			break;
		}
		return $output;
	}

	public function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => "",  'ы' => 'y',   'ъ' => "",
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
 
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => "",  'Ы' => 'Y',   'Ъ' => "",
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ' ' => '_',   'і' => 'y',  'І' => 'Y',
        'ї' => 'yi',   'Ї' => 'YI',
    );
    return strtr($string, $converter);		
	}
}
?>