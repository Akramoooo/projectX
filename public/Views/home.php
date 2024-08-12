<?php $this->layout('template', ['title' => 'Home']) ?>
<div class="main-home-container">
    <ul>
        <li>
            <i class="fa fa-question-circle-o" ></i>
            <h1>Made by Akramooo</h1>
                <p><time id="currentTime"></time></p>
        </li>
    </ul>

    <div class="search-container">
        <ul>
            <li class="search-li"><input type="search" placeholder="Search" name="search" id="search"></li>
            <li class="filter-li">
                <select id="filter-select" onChange="getSelectedCategory(this)" selected>
                    <option value="*">Все</option>
                    <?php foreach ($categories as $category):?>
                        <option value="<?=$category["id"]?>"><?=$category["name"]?></option>
                    <?php endforeach;?>
                </select>
            </li>
        </ul>
    </div>

    <div class="card-container">
        <?php foreach($cards as $card):?>
        <div class="card">
            <img src="images/green1.jpg" alt="">
            <ul class="card-info">
                <li class="card-name"><?=$card['name']?></li>
                <li class="card-price"><?=$card["price"]?></li>
                <li class="card-desc"><?=$card["desc"]?></li>
                <li>Category: <span class="categoryName"><?=$categories[$card["category"] - 1]["name"]?></span></li>
            </ul>
            <ul>
                <li><button>buy</button></li>
            </ul>
        </div> 
        <?php endforeach;?>       
    </div>
    
</div>

<script src="/js/home/home.js"></script>
<script src="js/home/search.js"></script>