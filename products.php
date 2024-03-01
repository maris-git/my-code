<?
    require "inc/init.php";
    //sau nay se doc tu BOOKS trong DB
    $conn = require("inc/db.php");
    $books = Book::getAll($conn);

    require "inc/header.php";
?>
<!-- trinh bay san pham dang card -->
<div class="content">
    <? foreach($books as $b):?>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="filp-card-front">
                    <img src="uploads/ <?echo $b->imagefile?>" alt="<?echo $b->title?>">
                </div>
                <div class="filp-card-back">
                    <h2><? echo $v['title']?></h2>
                    <p><? echo $v['description']?></p>
                    <p><? echo $v['author']?></p>
                </div>
            </div>
        </div>
    
    <? endforeach;?>
</div>