<?php require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';

$orders = getAll("orders");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_SESSION['success'])) : ?>
                <h3 class="text-success text-center my-3">
                    <?= $_SESSION['success'] ?>
                </h3>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($orders && mysqli_num_rows($orders) > 0): ?>
                                    <?php $i = 1;
                                    while ($order = mysqli_fetch_assoc($orders)) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $order['created_at']; ?></td>
                                            <td><?= $order['status']; ?></td>
                                            <td>
                                                <?= $order['total_price']; ?>
                                            </td>
                                            <td>
                                                <a class="btn text-info" href="<?php echo url("view-order&id=" . $order['id']) ?>">
                                                    View
                                                </a>
                                                <a class="btn text-primary" href="<?php echo url("process-order&id=" . $order['id']) ?>">
                                                    Complete
                                                </a>
                                                <a class="btn text-danger" href="<?php echo url("cancel-order&id=" . $order['id']) ?>">
                                                    Close
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            لا توجد نتائج متاحة حالياً
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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