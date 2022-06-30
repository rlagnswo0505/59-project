<?php
    include_once "db/db_list.php";
    $result = sel_categories();
    $ckeck = "";

?>

<div class="top__list swiper-wrapper">
    <div class="top__item swiper-slide">
        <input type="radio" name="top__item" id="모두보기">
        <label for="모두보기">모두보기</label>
    </div>
    <?php
        while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="top__item swiper-slide">
                <input type="radio" name="top__item" id="<?= $row['cate_nm'] ?>">
                <label for="<?= $row['cate_nm'] ?>"><?= $row['cate_nm'] ?></label>
            </div>
        <?php } ?>
</div>
<div class="list__main__list">
    <a href="store-detail.php?store_num=<?=$row['store_num']?>">
        <div class="list__item">
            <div class="list__store__img"><img src="img/store/<?=$row['store_nm']?>/Main_img/<?=$row['store_photo']?>"></div>
            <div class="list__store__info">
                <div class="store__info__nm"><?=$row['store_nm']?></div>
                <div class="store__info__info">가게 정보</div>
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
</div>
