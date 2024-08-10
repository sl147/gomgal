<?php
//session_start();

function get_mask_ip( $ip ) {
   $tmp = explode(".", $ip);
   $ip_new = "";
   for ($i=0; $i < 2; $i++) { 
      $ip_new .= $tmp[$i]. ".";
   }
   return $ip_new . $tmp[2];
}

function getUsersOnline() {  
   $count = 0;  
  
   $handle = opendir(session_save_path());  
   if ($handle == false) return -1;  
  
   while (($file = readdir($handle)) != false) {  
       if (preg_match("/^sess/", $file)) $count++;  
   }  
   closedir($handle);  
  
   return $count;  
}

//$usercount = getUsersOnline();
//echo  'Сейчас на сайте: <b>'.$usercount.'</b> человек.';

$ips        = new classGetData('ips');
$visits     = new classGetData('visits');
$session_id = session_id();
$visitor_ip = get_mask_ip($_SERVER['REMOTE_ADDR']);
$date       = date("Y-m-d");
//echo "<br>uri:".$_SERVER['REQUEST_URI'];;
// Узнаем, были ли посещения за сегодня
$count_visits = $visits->selectCount( false, array( 'date' => $date) );
// Если сегодня еще не было посещений
if ($count_visits == 0) {
    // Очищаем таблицу ips
   $del = $ips->deleteDataFromTable( array() );
   //$del = $ips->deleteDataFromTable( array("id_session"=>$session_id) );
    // Заносим в базу IP-адрес текущего посетителя
   $ips->insertDataToTable( array( $session_id, $visitor_ip), array( 'id_session', 'ip_address'));
    // Заносим в базу дату посещения и устанавливаем кол-во просмотров и уник. посещений в значение 1
   $visits->insertDataToTable( array( $date, 1, 1), array('date', 'hosts', 'views'));
}
// Если посещения сегодня уже были
else {
    // Проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
   $current_ip = $ips->selectCount( false, array( 'ip_address' => $visitor_ip) );
   //$current_ip = $ips->selectCount( false, array( 'id_session' => $session_id) );
    // Если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель)
   if ( $current_ip == 1) {
        // Добавляем для текущей даты +1 просмотр (хит)
      $views = $visits->selectDataFromTable( array('date'=>$date), '', 0, 'DESC', false,false, true)['views'];
      $visits->updateDataInTable( array('views'=>$views + 1), array( 'date'=>$date ));
    }
    // Если сегодня такого IP-адреса еще не было (т.е. это уникальный посетитель)
    else {
        // Заносим в базу IP-адрес этого посетителя
      $ips->insertDataToTable( array( $session_id, $visitor_ip), array( 'id_session', 'ip_address') );
        // Добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
      $tmp = $visits->selectDataFromTable( array('date'=>$date), '', 0, 'DESC', false,false, true);
      $visits->updateDataInTable( array( 'hosts'=>$tmp['hosts'] + 1, 'views'=>$tmp['views'] + 1), array( 'date'=>$date ));
    }
}