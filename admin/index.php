<?php

session_start();
// echo session_id(); // sse
$titlepage = 'Админ панель';
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
              <div class='table-content-login'>
                          <form method='post' id='login-form' class='login-form'>
                                        <input type='text' placeholder='Логин' class='input'
                                          name='login' required><br>
                                       <input type='password' placeholder='Пароль' class='input'
                                         name='password' required><br>
                                      <input type='submit' value='Войти' class='button'>
                        </form>
               </div>
  </div>
  </div>
  <style>
  .table{
    height:40vh;
    background-color:;
    text-align:center;
    width: 30vw;
    margin-right:auto;
    margin-left:auto;
    padding-top:35vh;
}
.table *{
    margin-top:10px;
}
  </style> 
  
  ";


  if (isset($_GET['meth'])) {
    
    //Удалить статью
    if ($_GET['meth'] == 'delit' && (isset($_SESSION['IsAdmin'])) && ($_SESSION['IsAdmin'] == '1')) {
      $echo = 'Удаление видосп';
      $id = $_GET['idvidos'];

      $db = mysqli_connect('localhost', 'root', 'root', 'webmland')
        or die('Error connecting to MySQL server.');
      $query = "DELETE FROM videos WHERE id = '$id'";

      mysqli_query($db, $query) or die("Ошибка " . mysqli_error($videos));
      // print_r('Удаление видоса');
      $_SESSION['IsAdmin'] = '0';
    }

    //Отредактировать статью
    elseif ($_GET['meth'] == 'redak' && (isset($_SESSION['IsAdmin'])) && ($_SESSION['IsAdmin'] == '1')) {
      
      
      // print_r($videos);
      $localId = $_GET['localId'];
      $tempVidos = $videos[$localId];
      //  print_r($tempVidos);
      
      $nameVideosTemp = $tempVidos['name'];
      $prewievVideosTemp = $tempVidos['prewiev_path'];
      $path_urlVideosTemp = $tempVidos['url_path'];
      $deskVideoTemp = $tempVidos['description'];


      $echo = "<form action='?lesson=ku&meth=redak&idvidos={$_GET['idvidos']}&localId={$localId}' method='post' >
      <h3>Название видео</h3>
      <input type='text' name='redakName' value='$nameVideosTemp'>
      <h3>Ссылка на превью</h3>
      <input type='text ' name='redakPrewievPath' value='$prewievVideosTemp'>
      <h3>Ссылка на видео</h3>
      <input type='text' name='redakVideoPath' value='$path_urlVideosTemp'>
      <h3>Описание видео</h3>
      <textarea name='redakVideoDesk' id='redakVideoDesk' cols='30' rows='10' >$deskVideoTemp</textarea>
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
          $echo = "<section class='articlenot' style='width:100vh; '> Статья с id = " . $id . " Отредактированна. <br> <a href='/admin' style='color:#000;'> Пойти на главную</a> </section>
          
          
          
          
          ";
            
          $db = mysqli_connect('localhost', 'root', 'root', 'webmland')
            or die('Error connecting to MySQL server.');

          $query = "UPDATE videos SET name='$redakName', description='$redakVideoDesk',prewiev_path='$redakPrewievPath',url_path='$redakVideoPath' WHERE id='$id'";

          mysqli_query($db, $query) or die("Ошибка " . mysqli_error($videos));
        }
      }
    } 

    //Добавить статью
    elseif ($_GET['meth'] == 'addArt' && (isset($_SESSION['IsAdmin'])) && ($_SESSION['IsAdmin'] == '1')) {
      $echo = "<form action='?meth=addArt&lesson=add' method='post' >
      <h3>Название видео</h3>
      <input type='text' name='addName'>
      <h3>Ссылка на превью</h3>
      <input type='text ' name='addPreview' value='https://blog.gelin.ru/2017/01/web.jpg'>
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

  //Вход в админку
  if ((isset($_POST['login']) && $_POST['password']) || (isset($gee))) {

    $_SESSION['IsAdmin'] = '1';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $_SESSION['LoginIn'] = 'true';

    if (($login == $loginch) && ($password == $passwordch)) { //успешный вход
      $_SESSION["AdminLogin"] = true;


      echo "<div class='oneLeft black'>
      <div class='sagolovok' style='font-size:36px; padding:20px; border-radius:10px;'>
      
      
          <h1>Статьи</h1>
      </div>
      
      <div class='articlenot black'>
          <table border='3' width='100%'>";
      $localId = 0;
      foreach ($videos as $video) {
        echo '<tr>';
        echo "<td>";
        $nameVid = "<div class='art-row'><br><br><h3>" . $video['name'] . '<span style="color: #fff;">________</span>Дата создания: ' . $video['create_at'] . "</h3><span style='color: #fff;'>________</span><a href='index.php?idvidos={$video['id']}&meth=delit&localId={$localId}' style='color: #000;'>Удалить</a><span style='color: #fff;'>__________</span><a href='index.php?idvidos={$video['id']}&meth=redak&localId={$localId}' style='color: #000;'>Редактироавние</a> </div class='art-row'>";
        echo $nameVid;
        echo "</td>";
        echo '</tr>';
        $localId += 1;
      }
      echo '<a href="index.php?meth=addArt" style="color: #000; font-size:36px; background-color:#e3faff; border:2px #000 solid; border-radius:10px;">Добавить статью</a>
      </table>
              </div>

          </div>
          <style>
          body{
              background-color: rgb(231, 231, 231);
              color: #000;
          }
          a{
              color: red;
              text-decoration: none;
          }
          .sagolovok{
              background-color:#000;
              color: #fff;
              padding-left: 20px;
          }
          section{
              background-color: rgb(255, 255, 255);
              color: #000;
              width: 100%;
          }
          .articlenot{
            padding: 20px 20px 0 20px;
            height: 90vh;
            background-color: #fff;
            margin: 20px 0;
            justify-items: center;
            border: 1px #dedede solid;
            border-radius: 10px;
        }
        .oneLeft {
          width:40vw;
          color: #000;
          margin-left: 10px;
          margin-top: 20px;
        }
        .art-row{
          border:1px black solid;
        }
          
          
      </style>';


      $echo = ""; // Вывод Админ панельки в echo Написать






      echo $echo;
    } else {
      echo "<div class='error-login'>
        <h1>НЕПРАВИЛЬНЫЙ ЛОГИН ИЛИ ПАРОЛЬ</h1>
      </div>
      <style>
      .error-login {
        position:absolute;
        width:30vw;
        text-align:center;
        margin-left:35vw;
        margin-top: 200px;
      }
      </style>";
    }
  }
  echo $echo;
}

login($users, $logNorm, $pasNorm, $videos);
echo'
  <link rel="stylesheet" href="../assets/css/reset.css">
  <link rel="stylesheet" href="../assets/css/main.css">
  
';
?>

<?php
require_once '../footer.php';
?>