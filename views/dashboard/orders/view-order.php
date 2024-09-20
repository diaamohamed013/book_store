<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">View Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Start Contact -->
        <div class="container-fluid">
            <div class="row py-5">
                <div class="col-12">
                    <?php
                    $db = new Database("localhost", "root", "", "ebook_project");
                    $order_id = $_GET['id'];
                    $sql = "SELECT * FROM `orders` WHERE `id` = '$order_id'";
                    $order = $db->fetchAssociate($sql);
                    ?>
                    <div class="row mx-0">
                        <div class="col-lg-12 mx-auto mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Order Info</h5>
                                    <p class="mb-1">
                                        <?= $order['first_name'] ?> <?= $order['last_name'] ?>
                                    </p>
                                    <p class="mb-1">
                                        <?= $order['address'] ?>
                                    </p>
                                    <p class="mb-1">
                                        <?= $order['city'] ?>
                                    </p>
                                    <p class="mb-1">
                                        <?= $order['phone'] ?>
                                    </p>
                                    <p class="mb-1">
                                        <?= $order['email'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <?php
                        $db = new Database("localhost", "root", "", "ebook_project");
                        $sql = "SELECT orders.* , books.* FROM orders INNER JOIN order_items
                                ON order_items.order_id = orders.id INNER JOIN books ON order_items.book_id = books.id WHERE orders.id = $order_id";
                        $result = $db->sqlQuery($sql);
                        while ($order_info = mysqli_fetch_assoc($result)):
                        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 mt-3">
                                <div class="card">
                                    <div style="width: 100%; height: 315px;">
                                        <img src="<?php echo BASE_URL . 'assets/images/books/' . $order_info['image']; ?>" class="card-img-top" alt="<?= $order_info['title']; ?>" style="width: 100%; height: 100%; object-fit:cover;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Products Info</h5>
                                        <p class="card-text">
                                            Title: <?= $order_info['title']; ?>
                                        </p>
                                        <p>
                                            <?php if ($order_info['sale_percentage']) : ?>
                                                <?= $order_info['price'] - (($order_info['price'] * $order_info['sale_percentage']) / 100) ?> $
                                            <?php else : ?>
                                                Price: <?= $order_info['price']; ?> $
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once ROOT_PATH . 'inc/dashboard/footer.php'; ?>