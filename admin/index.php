<?php

require_once '../header.php';
$stmt = $pdo->query("select * from userlist");
$users = $stmt->FetchAll();
foreach ($users as $item => $valuee) {
  $logNorm = $valuee['login'];
  $pasNorm = $valuee['password'];
}












function login($db,$loginch,$passwordch){
  $echo = "<div class='table'>
  <div class='tale-wrapper'>
              <div class='table-title'>Войти в панель администратора</div>
              <div class='table-content'>
                          <form method='post' id='login-form' class='login-form'>
                                        <input type='text' placeholder='Логин' class='input'
                                          name='login' required><br>
                                       <input type='password' placeholder='Пароль' class='input'
                                         name='password' required><br>
                                      <input type='submit' value='Войти' class='button'>
                        </form>
               </div>
  </div>
  </div>";
  
    if(isset($_POST['login']) && $_POST['password']){
      $login = $_POST['login'];
      $password = $_POST['password'];
    
    
    if(($login == $loginch) && ($password == $passwordch)){ //успешный вход




      $echo = null; // Вывод Админ панельки в echo Написать
      





      echo $echo;


    }
    else {
      echo "ДОСТУП ЗАКРЫТ";
    }
    
  }
  echo $echo;
}

login($users,$logNorm,$pasNorm);

?>

<?php
require_once '../footer.php';
?>