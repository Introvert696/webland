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


  if (isset($_GET['meth'])) {
    // print_r($_GET);
    // $update = mysqli_query($videos,"UPDATE videos SET title='$_POST[title]', description='$_POST[description]', text='$_POST[text]' WHERE id='$id'");

    if ($_GET['meth'] == 'delit' && (isset($_SESSION['IsAdmin'])) && ($_SESSION['IsAdmin'] == '1')) {
      $echo = 'Удаление видосп';
      $id = $_GET['idvidos'];

      $db = mysqli_connect('localhost', 'root', 'root', 'webmland')
        or die('Error connecting to MySQL server.');
      $query = "DELETE FROM videos WHERE id = '$id'";

      mysqli_query($db, $query) or die("Ошибка " . mysqli_error($videos));
      // print_r('Удаление видоса');
      $_SESSION['IsAdmin'] = '0';
    } elseif ($_GET['meth'] == 'redak' && (isset($_SESSION['IsAdmin'])) && ($_SESSION['IsAdmin'] == '1')) {
      $echo = "<form action='?lesson=ku&meth=redak&idvidos={$_GET['idvidos']}' method='post' >
      <h3>Название видео</h3>
      <input type='text' name='redakName'>
      <h3>Ссылка на превью</h3>
      <input type='text ' name='redakPrewievPath'>
      <h3>Ссылка на видео</h3>
      <input type='text' name='redakVideoPath'>
      <h3>Описание видео</h3>
      <textarea name='redakVideoDesk' id='redakVideoDesk' cols='30' rows='10'></textarea>
      <input type='submit' value='Редактировать' class='button'>
      </form>";
      // echo $echo;

      $redakName = '0';
      $redakDescription = '0';
      $redakPrewievPath = '0';
      $redakVideoPath = '0';
      $redakVideoDesk = '0';




      //  print_r($redakName.$redakPrewievPath.$redakVideoPath.$redakVideoDesk);

      if (isset($redakName) && isset($redakPrewievPath) && isset($redakVideoDesk) && isset($redakVideoPath)) {
        // echo $_GET['lesson'];
        if (isset($_GET['lesson']) && ($_GET['lesson'] == 'ku')) {
          $redakName = $_POST['redakName'];
          $redakPrewievPath = $_POST['redakPrewievPath'];
          $redakVideoPath = $_POST['redakVideoPath'];
          $redakVideoDesk = $_POST['redakVideoDesk'];
          // print_r($redakName . $redakPrewievPath . $redakVideoPath . $redakVideoDesk);
          $id = $_GET['idvidos'];
          $echo = 'Статья с id = ' . $id;

          $db = mysqli_connect('localhost', 'root', 'root', 'webmland')
            or die('Error connecting to MySQL server.');

          $query = "UPDATE videos SET name='$redakName', description='$redakVideoDesk',prewiev_path='$redakPrewievPath',url_path='$redakVideoPath' WHERE id='$id'";

          mysqli_query($db, $query) or die("Ошибка " . mysqli_error($videos));
        }
      }
    } elseif ($_GET['meth'] == 'addArt' && (isset($_SESSION['IsAdmin'])) && ($_SESSION['IsAdmin'] == '1')) {
      $echo = "<form action='?meth=addArt&lesson=add' method='post' >
      <h3>Название видео</h3>
      <input type='text' name='addName'>
      <h3>Ссылка на превью</h3>
      <input type='text ' name='addPreview'>
      <h3>Ссылка на видео</h3>  
      <input type='text' name='addVideoLink'>
      <h3>Описание видео</h3>
      <textarea name='addDesc' id='addDesc' cols='30' rows='10'></textarea>
      <input type='submit' value='Добавить' class='button'>
  </form>";

      $addName = '0';
      $addDesc = '0';
      $addPreview = '0';
      $addVideoLink = '0';

      

      if (isset($_GET['lesson']) && ($_GET['lesson'] == 'add')) {
        


        $db = mysqli_connect('localhost', 'root', 'root', 'webmland')
          or die('Error connecting to MySQL server.');

        //экспонирование для sql

        $addName =$_POST['addName'];
        $addDesc =$_POST['addDesc'];
        $addPreview =$_POST['addPreview'];
        $addVideoLink =$_POST['addVideoLink'];




        $query = "INSERT INTO videos (name, description, prewiev_path, url_path) VALUES ('$addName', '$addDesc', '$addPreview','$addVideoLink')";
        mysqli_query($db, $query);

        $echo = 'Запись ' .$addName .' добавлена <br> <a href="index.php"> Главная страница</a>';
      }
    } else {
      echo '<h1>ВЫ НЕ АДМИН</h1>';
    }
  }

  if ((isset($_POST['login']) && $_POST['password']) || (isset($gee))) {
    $_SESSION['IsAdmin'] = '1';
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
        $nameVid = '<h3>' . $video['name'] . '________Дата создания: ' . $video['create_at'] . "</h3>________<a href='index.php?idvidos={$video['id']}&meth=delit'>Удалить</a>__________<a href='index.php?idvidos={$video['id']}&meth=redak'>Редактироавние</a>";
        echo $nameVid;
        echo "</td>";
        echo '</tr>';
      }
      echo '<a href="index.php?meth=addArt">Добавить статьб</a>
      </table>
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