<?php
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
?>

<main>
    <div>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-7 mx-auto shadow bg-white">
                    <form class="mb-5 py-4" action="<?= url('login-fn-dashboard') ?>" method="POST">
                        <div class="input-group rounded-1 mb-3">
                            <input
                                type="text"
                                class="form-control p-3"
                                placeholder="البريد الالكتروني"
                                aria-label="Email"
                                name="email"
                                required
                                aria-describedby="basic-addon1" />
                            <span
                                class="input-group-text login__input-icon"
                                id="basic-addon1">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                        </div>
                        <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['email'] ?? ''; ?></span>
                        <div class="input-group rounded-1 mb-3">
                            <input
                                type="password"
                                class="form-control p-3"
                                placeholder="كلمة السر"
                                aria-label="Password"
                                name="password"
                                required
                                aria-describedby="basic-addon1" />
                            <span
                                class="input-group-text login__input-icon"
                                id="basic-addon1">
                                <i class="fa-solid fa-key"></i>
                            </span>
                        </div>
                        <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['password'] ?? ''; ?></span>

                        <button
                            class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1" type="submit">
                            تسجيل الدخول
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>