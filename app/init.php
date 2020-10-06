<?php
  session_start();
  require_once 'vendor/autoload.php';

  Facebook\FacebookSession::setDefaultApplication('553789431437151', '8174d68853d30433d2f8f965b7605f62');
  $facebook = new Facebook\FacebookRedirectLoginHelper('www.gomgal.lviv.ua');

  try {
   if($session = $facebook->getSessionFromRedirect()) {
    $_SESSION['facebook'] = $session->getToken();
    header('Location index.php');
   }

   if(isset($_SESSION['facebook'])) {
    $session = new Facebook\FacebookSession($_SESSION['facebook']);
    $request = new Facebook\FacebookRequest($session, 'GET', '/me');
    $request = $request->execute();
    $user = $request->getGraphObject()->asArray();
   }

  } catch(Facebook\FacebookRequestException $e) {
   // если facebook вернул ошибку
  } catch(\Exception $e) {
   // Локальная ошибка
  }
?>