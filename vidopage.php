<?php

$titlepage = 'Видеоплеер';
require_once 'header.php';

$id = $_GET['id'];
$name = $_GET['name'];
$url_path = $_GET['url_path'];
$create_at = $_GET['create_at'];

$titlepage = 'Видео';
?>
<!-- НАЧАЛО ДЛЯ ШАБЛОНА  -->

<section>
    <div class="bg-block">
        <div class="text-player">
            <p><span><?=$name?></span></p>
        </div>
        <div class="player">
            <video src="<?=$url_path?>" controls autoplay></video>
        </div>
        <div class="text-player-desc">
            <p><span>Описание: </span></p>
            <p><?=$create_at?></p>
        </div>
    </div>
</section>



<!-- КОНЕЦ ДЛЯ ШАБЛОНА -->
<?php
require_once 'footer.php';
?>