<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';

$db = new Database("localhost", "root", "", "ebook_project");
$id = $_GET['id'];
$author = $db->fetchAssociate("SELECT * FROM `authors` WHERE `id` = '$id'");
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Authors</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo url("dashboard") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Update Authors</li>
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
                        <form method="post" role="form" action="<?php echo url("edit-author&id=" . $author['id']); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputname">اسم المؤلف</label>
                                        <input type="text" class="form-control mt-1" id="title" name="author_name" value="<?= $author['name']; ?>">
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['author_name'] ?? ''; ?>
                                        </span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="inputmessage">الوصف</label>
                                        <textarea class="form-control mt-1" id="description" name="description" rows="8"><?= $author['description']; ?></textarea>
                                        <span class="text-danger">
                                            <?php echo $_SESSION['error']['description'] ?? ''; ?>
                                        </span>
                                    </div>
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
    </section>
</div>
<?php unset($_SESSION['error']); ?>
<?php unset($_SESSION['success']); ?>
<?php require_once ROOT_PATH . 'inc/dashboard/footer.php'; ?>