<?php
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';
$categories = getAll("categories");
$products = getAll("books");
$languages = getAll("languages");

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Book</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Book</li>
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
                        <form method="post" role="form" action="<?php echo url("store-book"); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">اسم الكتاب</label>
                                        <input type="text" class="form-control mt-1" id="title" name="title">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['title'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">السعر</label>
                                        <input type="text" class="form-control mt-1" id="price" name="price">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['price'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">اسم المؤلف</label>
                                        <input type="text" class="form-control mt-1" id="auth_name" name="auth_name">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['auth_name'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">الكمية</label>
                                        <input type="text" class="form-control mt-1" id="quantity" name="quantity">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['quantity'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">نسبة الخصم</label>
                                        <input type="number" class="form-control mt-1" id="sale_percentage" name="sale_percentage">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['sale_percentage'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">لغة الكتاب</label>
                                        <select class="form-control select2 mt-1" style="width: 100%;" name="book_lang">
                                            <option selected="selected">اختر لغة الكتاب</option>
                                            <?php while ($lang = mysqli_fetch_assoc($languages)) : ?>
                                                <option value="<?= $lang['id'] ?>">
                                                    <?= $lang['lang_name'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['book_lang'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">التصنيف</label>
                                        <select class="form-control select2 mt-1" style="width: 100%;" name="category">
                                            <option selected="selected">اختر التصنيف</option>
                                            <?php while ($cat = mysqli_fetch_assoc($categories)) : ?>
                                                <option value="<?= $cat['id'] ?>">
                                                    <?= $cat['name'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['category'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <label>صورة الغلاف</label>
                                        <input type="file" name="image" class="form-control mt-1">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
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