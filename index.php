<?  require "inc/init.php"; //auto load

    $books = [
        ['title' => 'John Lenno',
            'description' => 'Rhythm Guitar',
            'author' => 'abc',
            'imagefile' => 'php.jpg'],
        ['title' => 'John Lenno',
            'description' => 'Rhythm Guitar',
            'author' => 'abc',
            'imagefile' => 'php.jpg'],
        ['title' => 'John Lenno',
            'description' => 'Rhythm Guitar',
            'author' => 'abc',
            'imagefile' => 'php.jpg'],
    ];

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
            <? foreach($books as $b => $v):?>
                <tr>
                    <td><? echo $b + 1 ?></td>
                    <td><? echo $v['title']?></td>
                    <td><? echo $v['description']?></td>
                    <td><? echo $v['author']?></td>
                    <td>
                        <img src="uploads/ <? echo $v['imagefile']?>"
                            width=120 height=120>
        
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