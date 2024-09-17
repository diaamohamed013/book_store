<?php
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = Getonerow('categories', $id);  
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">  
                    <h1 class="m-0">Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </div>
            </div>
        </div>
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
                        <form method="post" role="form" action="<?php echo url('cat-edit&id=' . $category['id']); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">Edit Category</label>
                                        <input type="text" class="form-control mt-1" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>">
                                        <span class="text-danger">
                                            
                                            <?php echo $_SESSION['error'] ?? ''; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <!-- Use a proper submit button instead of an anchor tag -->
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
