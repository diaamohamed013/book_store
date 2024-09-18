<?php
if (getSession("auth")) {
  redirect('home');
}
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
?>

<main>
  <div
    class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>حسابي</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="<?= url("home") ?>">الرئيسية</a> /
        <span class="text-gray">حسابي</span>
      </div>
    </div>
  </div>

  <div class="page-full pb-5">
    <div class="account account--login mt-5 pt-5">
      <div class="account__tabs w-100 d-flex mb-3">
        <div
          class="account__tab account__tab--login text-center fs-6 py-3 w-50">
          تسجيل الدخول
        </div>
        <div
          class="account__tab account__tab--register text-center fs-6 py-3 w-50">
          حساب جديد
        </div>
      </div>
      <div class="account__login w-100">
        <form class="mb-5" action="<?= url('login') ?>" method="POST">
          <div class="input-group rounded-1 mb-3">
            <input
              type="text"
              class="form-control p-3"
              placeholder="البريد الالكتروني"
              aria-label="Email"
              name = "email"
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
              name = "password"
              required
              aria-describedby="basic-addon1" />
            <span
              class="input-group-text login__input-icon"
              id="basic-addon1">
              <i class="fa-solid fa-key"></i>
            </span>
          </div>
          <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['password'] ?? ''; ?></span>
          <div class="login__bottom d-flex justify-content-between mb-3">
            <a class="login__forget-btn" href="">نسيت كلمة المرور؟</a>
            <div>
              <input type="checkbox" />
              <label for="">تذكرني</label>
            </div>
          </div>

          <button
            class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1" type="submit">
            تسجيل الدخول
          </button>
        </form>
      </div>
      <div class="account__register w-100">
        <form class="mb-5" method="POST" action="<?php echo url('send-user'); ?>">
          <div class="input-group rounded-1 mb-3">
            <span class="text-success fs-8 mb-3 d-block"><?php echo $_SESSION['success'] ?? ''; ?></span>
            <input
              type="text"
              class="form-control p-3"
              placeholder="الاسم كامل"
              aria-label="name"
              name="user_name"
              required
              aria-describedby="basic-addon1" />
            <span
              class="input-group-text login__input-icon"
              id="basic-addon1">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['user_name'] ?? ''; ?></span>
          <div class="input-group rounded-1 mb-3">
            <input
              type="text"
              class="form-control p-3"
              placeholder="البريد الالكتروني"
              aria-label="email"
              name="user_email"
              required
              aria-describedby="basic-addon1" />
            <span
              class="input-group-text login__input-icon"
              id="basic-addon1">
              <i class="fa-solid fa-envelope"></i>
            </span>
          </div>
          <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['user_email'] ?? ''; ?></span>
          <div class="input-group rounded-1 mb-3">
            <input
              type="password"
              class="form-control p-3"
              placeholder="كلمة السر"
              aria-label="password"
              name="user_password"
              required
              aria-describedby="basic-addon1" />
            <span
              class="input-group-text login__input-icon"
              id="basic-addon1">
              <i class="fa-solid fa-key"></i>
            </span>
          </div>
          <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['user_password'] ?? ''; ?></span>
          <button
            class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1" type="submit">
            حساب جديد
          </button>
        </form>
      </div>
      <div class="account__forget">
        <p>
          فقدت كلمة المرور الخاصة بك؟ الرجاء إدخال عنوان البريد الإلكتروني
          الخاص بك. ستتلقى رابطا لإنشاء كلمة مرور جديدة عبر البريد
          الإلكتروني.
        </p>
        <form action="<?php echo url('resetpassword'); ?>" method="POST">
          <div class="input-group rounded-1 mb-3">
            <input
              type="text"
              class="form-control p-3"
              placeholder="البريد الالكتروني"
              aria-label="email"
              name="email"
              required
              aria-describedby="basic-addon1" />
            <span
              class="input-group-text login__input-icon"
              id="basic-addon1">
              <i class="fa-solid fa-envelope"></i>
            </span>
          </div>
          <input
            type="submit"
            value ="Reset Password"
            class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1"
           
          /> اعادة تعيين كلمة المرور
        </form>
      </div>
    </div>
  </div>
</main>

<?php unset($_SESSION['error']); ?>
<?php unset($_SESSION['success']); ?>
<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>