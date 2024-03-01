<? 
    require "inc/init.php";
    // Auth::requireLogin();

    /* Xu li upload 
        return:
        null ==> fail
        ten file ==> success
    */
    function upload_file(){
        try{
            if (empty($_FILES)) {
                Dialog::show('Khong the load tap tin');
                return null;
            }

            $rs = Errorfileupload::err($_FILES['file'][error]);
            if ($rs != 'OK') {
                Dialog::show($rs);
                return null;
            }

            // Gioi han kich thuoc file <=2M
            $filemaxsize = FILE_MAX_SIZE;
            if($_FILES['file']['size'] > $filemaxsize) {
                // throw new Exception('Kich thuoc tap tin phai <= ' / $filesize);
                Dialog::show('Kich thuoc tap tin phai <='.$filemaxsize);
                return null;
            }

            $mime_type = FILE_TYPE;
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_mime_type = finfo_file($fileinfo, $_FILES['file']['tmp_name']);
            if (! in_array($file_mime_type, $mime_type)) {
                Dialog::show('Kieu tap tin phai la hinh anh');
                return null;
            }

            /*
            Thuc hien upload file len thu muc uploads tren server
            */
            // Chuan hoa ten file truoc khi upload len server
            $pathinfo = pathinfo($_FILES['file']['name']);
            $filename = $pathinfo['filename'];
            $filename = preg_replace('/[^a-zA-Z0-9_-]/','_',$filename);

            // Xu ly ghi de
            $fullname = $filename . '.' .$pathinfo['extension'];
            // Tao duong dan den thu muc uploads tren server
            $fileToHost = "uploads/" .$fullname;
            $i = 1;
            while(file_exists($fileToHost)){
                $fullname = $filename . "$i." .$pathinfo['extension'];
                $fileToHost = "uploads/" .$fullname;
                $i++;
            }
            // Lay file tam trong bo nho de dua len host
            $fileTmp = $_FILES['file']['tmp_name'];
            if (move_uploaded_file($fileTmp, $fileToHost)) {
            } else{
                return null;
            }

        } catch(PDOException $e) {
            // throw new Exception($rs);
            Dialog:: show($e->getMessage());
            return false;
        } 
    }
    /*
        1. Goi upload_file ==> Nhan ket qua
        2. Neu thanh cong ==> insert record vao books
            2.1. Neu thanh cong ==> chuyen vao trang index.php
            2.2. That bai ==> xoa hinh da upload
    */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = require "inc/db.php";
        try{
            $fullname = upload_file();
            if(!empty($fullname)) {
                // doc du lieu tu form nhap
                $title = $_POST['title'];
                $description = $_POST['description'];
                $author = $_POST['author'];
                $book = new Book($title, $description, $author, $fullname);
                if ($book->add($conn)) {
                    header("Location: index.php");
                } else{
                    unlink("uploads/$fullname");
                }
            }
        } catch(PDOException $e) {
            // throw new Exception($e->getMessage());
            // Dialog:: show($e->getMessage());
            // return false;
            header("Location: 404.php?error=$e");
        } 
    }
?>

<? require "inc/header.php";?>
<!-- tao form nhap book -->
    <div class="content">
        <form method = "post" id = "frmADDBOOK" enctype = "multipart/form-data">
            <fieldset>
                <legend>Add Book</legend>
                <div class="row">
                    <label for = "Title">Title:</label>
                    <span class='error'>*</span>
                    <input type="text" name="Title" placeholder="Title">
                </div>
                <div class="row">
                    <label for = "description">description:</label>
                    <span class='error'>*</span>
                    <input type="text" name="description" placeholder="description">
                </div>
                <div class="row">
                    <label for = "author">Author:</label>
                    <span class='error'>*</span>
                    <input type="text" name="author" placeholder="Author">
                </div>
                <div class="row">
                    <label for = "file">File hinh anh</label>
                    <input type="file" name="file" placeholder="file">
                </div>
                <div class="row">
                    <input type="submit" value="Save" class="btn">
                    <input type="reset" value="Cancel" class="btn">
                </div>
            </fieldset>
        </form>
    </div>
<? require "inc/footer.php";?>