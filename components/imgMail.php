<?
// Отправляем заголовки картинки  
header('Content-type: image/jpeg');

// Получаем имя, домен и зону для адреса электронной почты
$name 	= ( !isSet( $_GET['name'] ) or empty( $_GET['name'] ) ) ? 'noname' : $_GET['name'];
$domain	= ( !isSet( $_GET['domain'] ) or empty( $_GET['domain'] ) ) ? 'noserver' : $_GET['domain'];
$zone	= ( !isSet( $_GET['zone'] ) or empty( $_GET['zone'] ) ) ? 'no' : $_GET['zone'];

// Получаем цвета (красный, зелёный, голубой) для фона. Значение для цветов должно быть в пределах 0...255.
$bgR		= ( !isSet( $_GET['bgr'] ) or empty( $_GET['bgr'] ) ) ? 255 : ( ( (int)$_GET['bgr'] < 0 or (int)$_GET['bgr'] > 255 ) ? 255 : (int)$_GET['bgr'] );
$bgG		= ( !isSet( $_GET['bgg'] ) or empty( $_GET['bgg'] ) ) ? 255 : ( ( (int)$_GET['bgg'] < 0 or (int)$_GET['bgg'] > 255 ) ? 255 : (int)$_GET['bgg'] );
$bgB		= ( !isSet( $_GET['bgb'] ) or empty( $_GET['bgb'] ) ) ? 255 : ( ( (int)$_GET['bgb'] < 0 or (int)$_GET['bgb'] > 255 ) ? 255 : (int)$_GET['bgb'] );

// Получаем цвета (красный, зелёный, голубой) для текста. Значение для цветов должно быть в пределах 0...255.
$txR		= ( !isSet( $_GET['txr'] ) or empty( $_GET['txr'] ) ) ? 0 : ( ( (int)$_GET['txr'] < 0 or (int)$_GET['txr'] > 255 ) ? 0 : (int)$_GET['txr'] );
$txG		= ( !isSet( $_GET['txg'] ) or empty( $_GET['txg'] ) ) ? 0 : ( ( (int)$_GET['txg'] < 0 or (int)$_GET['txg'] > 255 ) ? 0 : (int)$_GET['txg'] );
$txB		= ( !isSet( $_GET['txb'] ) or empty( $_GET['txb'] ) ) ? 0 : ( ( (int)$_GET['txb'] < 0 or (int)$_GET['txb'] > 255 ) ? 0 : (int)$_GET['txb'] );

// Склеиваем адрес электронной почты
$str	= $name.'@'.$domain.'.'.$zone;

// Вычисляем длинну адреса
$width = strlen( $str );
// Устанавливаем высоту картинки
$height= 18;

// Создаём картинку 
$img	= imagecreate( $width*12, $height );
// Устанавливаем цвет фона
$bg 	= imagecolorallocate( $img, $bgR, $bgG, $bgB );
// Получаем цвет шрифта
$textColor = imagecolorallocate( $img, $txR, $txG, $txB );


// Устанавливаем размер текста
$size 	= 8;
//  Устанавливаем отступ от левого края картинки
$xText  = 8;
// Устанавливает отступ от нижнего края картинки
$yText	= -1;

// Рисуем на картинке текст
imagestring( $img, $size, $xText, $yText, $str, $textColor); 
// Выводим картинку
imagejpeg( $img, null, 85 );
// Очищаем память
imagedestroy( $img );

?>