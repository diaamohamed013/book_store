<?php
require_once ROOT_PATH . 'inc/dashboard/header.php';
require_once ROOT_PATH . 'inc/dashboard/navbar.php';


$categories = getAll('categories');
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row w-100">
        <div class="col-8 mx-auto">
        <div class="text-center py-2">
                <h3 class="text-success">
                    <?php echo $_SESSION['success'] ?? ''; ?>
                </h3>
            </div> 
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
                        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                            <tr>
                                <td><?= htmlspecialchars($category['id']) ?></td>
                                <td><?= htmlspecialchars($category['name']) ?></td>
                                <td>
                                    <a href="<?= url('cat-delete&id=' . $category['id']) ?>" class="btn btn-danger">Delete</a>
                                    <a href="<?= url('edit-cat&id=' . $category['id']) ?>" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No categories found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php unset($_SESSION['success']); ?>

<?php require_once ROOT_PATH . 'inc/dashboard/footer.php'; ?>
