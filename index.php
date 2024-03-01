<?  require "inc/init.php"; //auto load

    $conn = require("inc/db.php");
    $books = Book::getAll($conn);

    require "inc/header.php";
?>

<!-- Thiet ke trang index o day -->
<div class="content">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Author</th>
                <th>Image</th>
            </tr>
        </thead>
        <!-- cac dong du lieu o day -->
        <tbody>
            <? static $i = 1;?>
            <? foreach($books as $b):?>
                <tr>
                    <td><? echo $i++ ?></td>
                    <td><? echo $b->title?></td>
                    <td><? echo $b->description?></td>
                    <td><? echo $b->author?></td>
                    <td> 
                        <? if (Auth::isLoggedIn()):?>
                            <div class="row">
                                <a href="editbook.php" class="btn">Sửa</a>
                                <a href="delbook.php" class="btn">xóa</a>
                            </div>
                        <? else: ?>
                            <img src="uploads/<? echo $b->imagefile?>" 
                                width="100" height="100">
                        <? endif;?>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Totals:</th>
                <th colspan="3"><? echo count ($books)?></th>
            </tr>
        </tfoot>
    </table>
</div>
>

<? require "inc/footer.php"?>