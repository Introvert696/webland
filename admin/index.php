<?php
session_start();
// echo session_id(); // sse
require_once '../header.php';
$stmt = $pdo->query("select * from userlist");
$users = $stmt->FetchAll();

foreach ($users as $item => $valuee) {
  $logNorm = $valuee['login'];
  $pasNorm = $valuee['password'];
}
print_r($_GET);


/**
 * 
 *  <?php foreach ($videos as $video): ?>
 *           <div class="article-block">
 *               <a href="/vidopage.php?id=<?=$video['id'] ?>&name=<?=$video['name']?>&url_path=<?=$video['url_path']?>&create_at=<?=$video['create_at']?>">
 *                  <img src="<?=$video['prewiev_path'] ?>" alt="">
 *                  <div class="text-art-box">
 *                      <p><span><?=$video['name'] ?></span></p>
 *                      <p><?=$video['description'] ?></p>
 *                 </div>
 *             </a>
 *          </div>
 *          <?php endforeach; ?>
 */







function delete($id)
{
  $query = "DELETE FROM userlist WHERE id = '$id'";
  echo ' dfdfdf';
}

function login($db, $loginch, $passwordch, $videos)
{
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
  if(isset($_GET['meth'])) {
    delete($_GET['idvidos']);
    // $update = mysqli_query($videos,"UPDATE videos SET title='$_POST[title]', description='$_POST[description]', text='$_POST[text]' WHERE id='$id'");
    echo 'Типо удалил';

  }
  if ((isset($_POST['login']) && $_POST['password']) || (isset($gee))){
    $gee = 1;
    $login = $_POST['login'];
    $password = $_POST['password'];
    $_SESSION['LoginIn'] = 'true';

    if (($login == $loginch) && ($password == $passwordch)) { //успешный вход
      $_SESSION["AdminLogin"] = true;
     

      echo "<div class='oneLeft'>
      <div class='sagolovok'>
          <h1>Статьи</h1>
      </div>
      
      <div class='article-block'>
          <table border='3' width='100%'>";

      foreach ($videos as $video) {
        echo '<tr>';
        echo "<td>";
        $nameVid = '<h3>' . $video['name'] . '________Дата создания: ' . $video['create_at'] . "</h3>________<a href='index.php?idvidos={$video['id']}&meth=dlit'>Удалить</a>";
        echo $nameVid;
        echo "</td>";
        echo '</tr>';
      }
      echo '</table>
              </div>

          </div>
          <style>
          body{
              background-color: rgb(231, 231, 231);
          }
          a{
              color: #000;
              text-decoration: none;
          }
          .sagolovok{
              background-color:#000;
              color: #fff;
              padding-left: 20px;
          }
          section{
              background-color: rgb(255, 255, 255);
              width: 40vw;
          }
          
          
      </style>';


      $echo = ""; // Вывод Админ панельки в echo Написать






      echo $echo;
    } else {
      echo "ДОСТУП ЗАКРЫТ";
    }
  }
  echo $echo;
}

login($users, $logNorm, $pasNorm, $videos);

?>

<?php
require_once '../footer.php';
?>