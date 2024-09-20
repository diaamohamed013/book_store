<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
$token = $_GET["token"];

$token_hash = hash("sha256", $token);


$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}
 ?>


<section class="section-container" style ="margin-top: 10rem; margin-bottom: 10rem">
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h3 class="text-center mb-4" style ="color: #04a6a8">اعادة تعيين كلمة المرور</h3>

            <form method="POST" action="<?php echo url('process-reset-password') ?>" class="text-white p-4 rounded" style ="background-color: #04a6a8">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور الجديدة</label>
                    <input type="password" id="password" name="password" class="form-control rounded-pill">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control rounded-pill">
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-pill">تأكيد</button>
            </form>
        </div>
    </div>
</div>

</section>

<?php
  require_once ROOT_PATH . 'inc/website/footer.php'; ?>