<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';

$db = new Database("localhost", "root", "", "ebook_project");
$result = $db->sqlQuery("SELECT * FROM `authors`");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Authors</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Authors</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- <?php if (isset($_SESSION['success'])) : ?>
                <h3 class="text-success text-center my-3">
                    <?= $_SESSION['success'] ?>
                </h3>
            <?php endif; ?> -->
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المؤلف</th>
                                    <th>الوصف</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                    <?php $i = 1;
                                    while ($author = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?= $author['author_name'];  ?>
                                            </td>
                                            <td>
                                                <?= $author['description'];  ?>
                                            </td>
                                            <td>
                                                <a class="btn text-info" href="<?php echo url("update-author&id=" . $author['id']) ?>">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a class="btn text-danger" href="<?php echo url("delete-author&id=" . $author['id']) ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">
                                            لا توجد نتائج متاحة حالياً
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 my-4">
                    <div class="text-center">
                        <a class="btn btn-primary" href="<?php echo url("add-author") ?>">
                            Add Author
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php unset($_SESSION['success']); ?>
<?php require_once ROOT_PATH . 'inc/dashboard/footer.php'; ?>