<?php $this->layout('template', ['title' => 'News']) ?>


<div class="news-container">
    <?php foreach ($news as $new):?>
    <div class="news-card">
        <img src="images/<?=$new['img']?>" alt="">
        <p><?=$new["title"]?></p>
        <p><?=$new["descrip"]?></p>
        <p style="font-size: 10px; color:red"><?=$new["date"]?></p>
    </div>
    <?php endforeach;?>
</div>


<script src="js/news.js"></script>