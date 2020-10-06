<?
//  require "../libfunc.php";
//  require "../dblinc.php";
require "libfunc.php";
require "dblinc.php";
if($_GET['code']) {
$result = get_token($_GET['code']);
if($result) {
		print_r(get_data($result));
		$pt=get_data($result);

if (isset($pt['id'])) {
	$pt = $pt;

        echo "Социальный ID пользователя: " . $pt['id'] . '<br />';
        echo "Имя пользователя: " . $pt['name'] . '<br />';
//        echo "first name: " . $pt['first_name'] . '<br />';
		echo "Email: " . $pt['email'] . '<br />';
        echo "Ссылка на профиль пользователя: " . $pt['link'] . '<br />';
        echo "Пол пользователя: " . $pt['gender'] . '<br />';
        echo "ДР: " . $pt['birthday'] . '<br />';
		echo "hometown: " . $pt['hometown']['name'] . '<br />';
		echo "hometown: " . $pt['hometown'] . '<br />';
        echo '<img src="http://graph.facebook.com/' . $pt['id'] . '/picture?type=large" />'; echo "<br />";
		echo '<img src="http://graph.facebook.com/' . $pt['id'] . '/picture?type=small" />'; echo "<br />";

}
if (!isset($pt['id'])) {echo "Noooooooooo";}
	}
}
else {
exit('Ошибка параметров');
}

?>
<p>HIIIIIIIIIIIII</p>
