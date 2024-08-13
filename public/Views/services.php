<?php $this->layout('template', ['title' => 'Services']) ?>


<div class="services-container">
    <i class="fa fa-question-circle-o"></i>
    <h1>Akramooo Services</h1>
    <?php foreach ($services as $service):?>
    <div class="service-card">
        <img src="/images/<?=$service["image"]?>" alt="service_img">
        <p><?=$service["description"]?></p>
    </div>
    <?php endforeach;?>
</div>

<script src="js/services.js"></script>