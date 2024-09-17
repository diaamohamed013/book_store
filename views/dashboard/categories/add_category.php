<?php
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">  
                    <h1 class="m-0">Add category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add category</li>
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
                        <form method="post" role="form" action="<?php echo url("store-cat"); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">اضف تصنيف</label>
                                        <input type="text" class="form-control mt-1" id="cat_name" name="cat_name">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['cat_name'] ?? ''; ?>
                                        </span>
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