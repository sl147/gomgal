<form id = "authlog" method="POST">

  <div class="input-group margin-bottom-sm">

    <span class="input-group-addon">

      <i class="fa fa-envelope-o fa-fw"></i>

    </span>

    <input class="btnwidth form-control" name="login" autofocus type="text" placeholder="Логін" required>

  </div>

  <div class="input-group">

    <span class="input-group-addon">

      <i class="fa fa-key fa-fw"></i>

    </span>

    <input class="btnwidth form-control" name="password" type="password" placeholder="Пароль" required>

  </div><br>

  <input name="_token" type="hidden" value="<?= $token?>">     

  <button name="submit" type="submit" class="btnwidth btn btn-success btn-sm">

    увійти

  </button>      

  <a href='/userAuthor' class="btnwidth btn btn-success btn-sm">

    реєстрація

  </a>

  <a href='/remember' class="btnwidth btn btn-success btn-sm">

    забули логін(пароль)

  </a>

</form>

<? if (isset($errors) && is_array($errors)) :?>

  <div class="alert alert-success alert-dismissible" role="alert">

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

      &times;

    </button>

    <ul>

      <?foreach ($errors as $error) :?>

      <li >

        <?=$error?>

      </li>   

      <?endforeach;?>

    </ul>

  </div>

<?endif;?>

<!-- <script>

  window.fbAsyncInit = function() {

    FB.init({

      appId      : '553789431437151',

      cookie     : true,

      xfbml      : true,

      version    : '{api-version}'

    });

      

    FB.AppEvents.logPageView();   

      

  };



  (function(d, s, id){

     var js, fjs = d.getElementsByTagName(s)[0];

     if (d.getElementById(id)) {return;}

     js = d.createElement(s); js.id = id;

     js.src = "https://connect.facebook.net/en_US/sdk.js";

     fjs.parentNode.insertBefore(js, fjs);

   }(document, 'script', 'facebook-jssdk'));

</script>



<script>    

FB.getLoginStatus(function(response) {

    statusChangeCallback(response);

    //alert(response.status)

});

</script>



<script>

<fb:login-button 

  scope="public_profile,email"

  onlogin="checkLoginState();">

</fb:login-button>

</script>



<script>

function checkLoginState() {

  FB.getLoginStatus(function(response) {

    statusChangeCallback(response);

  });

}

</script>



<div id="fb-root"></div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v9.0&appId=553789431437151&autoLogAppEvents=1" nonce="tWtmHtQ1"></script>



<div class="fb-login-button" data-width="400" data-size="large" data-button-type="continue_with" data-layout="rounded" data-auto-logout-link="true" data-use-continue-as="true"></div> -->