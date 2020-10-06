<?php
require_once ('../models/Relax.php');

$cat       = intval($_GET['cat']);
$page      = intval($_GET['page']);
$SHOWRELAX = intval($_GET['SHOWRELAX']);

$data = [];
$MK   = new Relax();
$pr   = $MK->getRelaxVue($cat,$page,$SHOWRELAX);

foreach ($pr as $item) {
  	$new_item = array(
		'id'      => $item["id"],
		'msg'     => $item["msg"],
		'countrl' => $item["countrl"],
	);
	array_push($data, $new_item);
}
//echo json_encode($data);
echo json_encode($data,JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP |JSON_UNESCAPED_UNICODE);
/*	switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - Ошибок нет';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Достигнута максимальная глубина стека';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Некорректные разряды или несоответствие режимов';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Некорректный управляющий символ';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Синтаксическая ошибка, некорректный JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
        break;
        default:
            echo ' - Неизвестная ошибка';
        break;
    }

    echo PHP_EOL;*/
?>