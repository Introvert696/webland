<?php
$titlepage = 'Главная страница';
    require_once 'header.php';
    
?>
    <section>
        <div class="flex">
            <?php foreach ($videos as $video): ?>
            <div class="article-block">
                <a href="/vidopage.php?id=<?=$video['id'] ?>&name=<?=$video['name']?>&url_path=<?=$video['url_path']?>&create_at=<?=$video['create_at']?>">
                    <img src="<?=$video['prewiev_path'] ?>" alt="">
                    <div class="text-art-box">
                        <p><span><?=$video['name'] ?></span></p>
                        <p><?=$video['description'] ?></p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
            
    </section>
    <section class="sect-bg">
        <div class="center">
            <!-- <div class="list-box">
                <p>Страница: 1</p> -->
                <div class="list bt-5">
                    <p>Страница: </p>
                </div>
            <div class="list">
                
                <div class="id">
                    <p><</p>
                </div>
                <div class="id">
                    <p>1</p>
                </div>
                <div class="id">
                    <p>2</p>
                </div>
                <div class="id">
                    <p>3</p>
                </div>
                <div class="id">
                    <p>4</p>
                </div>
                <div class="id">
                    <p>5</p>
                </div>
                <div class="id">
                    <p>...</p>
                </div>
                <div class="id">
                    <p>></p>
                </div>
            </div>
            </div>
        </div>
        
    </section>

<?php 
    require_once 'footer.php';
?>