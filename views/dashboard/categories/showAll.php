<?php
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';


$categories = getAll('categories');
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
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($categories && mysqli_num_rows($categories) > 0): ?>
                                    <?php $i = 1;
                                    while ($category = mysqli_fetch_assoc($categories)): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= htmlspecialchars($category['name']) ?></td>
                                            <td>
                                                <a href="<?= url('cat-delete&id=' . $category['id']) ?>" class="btn text-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="<?= url('edit-cat&id=' . $category['id']) ?>" class="btn text-primary">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">
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
                        <a class="btn btn-primary" href="<?php echo url("add_category") ?>">
                            Add Category
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