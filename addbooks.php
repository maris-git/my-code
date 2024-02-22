<? require "inc/init.php";?>

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