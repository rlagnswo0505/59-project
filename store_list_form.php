<a href="store-detail.php?store_num=<?=$row['store_num']?>">
    <div class="list__item">
        <div class="list__store__img"><img src="img/store/<?=$row['store_nm']?>/Main_img/<?=$row['store_photo']?>"></div>
        <div class="list__store__info">
            <div class="store__info__nm"><?=$row['store_nm']?></div>
            <div class="store__info__info"><?=$row['info']?></div>
            <?php 
            if ($star == "") { ?>
                <div class='store__info__star_rating'><i class='fa-solid fa-star'></i></div>
            <?php } else { ?>
                <div class='store__info__star_rating'><i class='fa-solid fa-star'><?=intval($star)?></i></div>
            <?php } ?>
        </div>
        <div class="list__store__location"><i class="fa-solid fa-location-dot"></i> 1.0 KM</div>
    </div>
</a>