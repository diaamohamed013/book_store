<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';

$db = new Database("localhost", "root", "", "ebook_project");

$id = $_GET['id'];
$book = $db->fetchAssociate("SELECT books.* FROM `books` WHERE `id` = '$id'");
$category = $book['category_id'];
$lang = $book['lang_id'];
$auth = $book['auth_id'];
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Book</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Book</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="text-center py-2">
                <h3 class="text-success">
                    <?php echo $_SESSION['success'] ?? ''; ?>
                </h3>
            </div>
            <div class="row">
                <div class="col-md-9 m-auto">
                    <div class="card card-primary">
                        <form method="post" role="form" action="<?php echo url("edit-book&id=" . $book['id']); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">اسم الكتاب</label>
                                        <input type="text" class="form-control mt-1" id="title" name="title" value="<?= $book['title'] ?>">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['title'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">السعر</label>
                                        <input type="text" class="form-control mt-1" id="price" name="price" value="<?= $book['price'] ?>">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['price'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">نسبة الخصم</label>
                                        <input type="number" class="form-control mt-1" id="sale_percentage" name="sale_percentage" value="<?= $book['sale_percentage'] ?>">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['sale_percentage'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">الكمية</label>
                                        <input type="text" class="form-control mt-1" id="quantity" name="quantity" value="<?= $book['quantity'] ?>">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['quantity'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">اسم المؤلف</label>
                                        <select class="form-control select2" style="width: 100%;" name="auth_name">
                                            <?php
                                            $select_auth = "SELECT `id`,`author_name` FROM `authors`";
                                            $result_auth = mysqli_query($conn, $select_auth);
                                            foreach ($result_auth as $row_auth) {
                                            ?>
                                                <option <?php if ($auth == $row_auth['id']) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $row_auth['id']; ?>"><?php echo $row_auth['author_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['auth_name'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">لغة الكتاب</label>
                                        <select class="form-control select2" style="width: 100%;" name="book_lang">
                                            <?php
                                            $select_lang = "SELECT `id`,`lang_name` FROM `languages`";
                                            $result_lang = mysqli_query($conn, $select_lang);
                                            foreach ($result_lang as $row_lang) {
                                            ?>
                                                <option <?php if ($lang == $row_lang['id']) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $row_lang['id']; ?>"><?php echo $row_lang['lang_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">Category</label>
                                        <select class="form-control select2" style="width: 100%;" name="category">
                                            <?php
                                            $select_category = "SELECT `id`,`name` FROM `categories`";
                                            $result_category = mysqli_query($conn, $select_category);
                                            foreach ($result_category as $row_category) {
                                            ?>
                                                <option <?php if ($category == $row_category['id']) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $row_category['id']; ?>"><?php echo $row_category['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>صورة الغلاف</label>
                                        <div>
                                            <img style="width: 200px;height: 200px;" src="<?php echo BASE_URL . 'assets/images/books/' . $book['image']; ?>" alt="<?php echo $book['title']; ?>">
                                        </div>
                                        <input type="file" name="image" class="form-control mt-4" value="<?= $book['image'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php unset($_SESSION['error']); ?>
<?php unset($_SESSION['success']); ?>
<?php require_once ROOT_PATH . 'inc/dashboard/footer.php'; ?>