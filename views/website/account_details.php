<?php
if (!getSession("auth")) {
  redirect('home');
}
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
?>

<main>
  <section
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
  </section>

  <section
    class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
    <div class="profile__right">
      <div class="profile__user mb-3 d-flex gap-3 align-items-center">
        <div class="profile__user-img rounded-circle overflow-hidden">
          <img class="w-100" src="assets/images/user.png" alt="" />
        </div>
        <div class="profile__user-name">
          <h4><?= $_SESSION['auth']["name"] ?></h4>
        </div>
      </div>
      <ul class="profile__tabs list-unstyled ps-3">
        <li class="profile__tab <?php if ($_GET['page'] == "profile"): ?> <?php echo 'active' ?> <?php endif; ?>">
          <a class="py-2 px-3 text-black text-decoration-none" href="<?= url("profile") ?>">لوحة التحكم</a>
        </li>
        <li class="profile__tab <?php if ($_GET['page'] == "orders"): ?> <?php echo 'active' ?> <?php endif; ?>">
          <a class="py-2 px-3 text-black text-decoration-none" href="<?= url("orders") ?>">الطلبات</a>
        </li>
        <li class="profile__tab <?php if ($_GET['page'] == "account_details"): ?> <?php echo 'active' ?> <?php endif; ?>">
          <a class="py-2 px-3 text-black text-decoration-none" href="<?= url("account_details&name=" . $_SESSION['auth']["name"]) ?>">تفاصيل الحساب</a>
        </li>
        <li class="profile__tab <?php if ($_GET['page'] == "favourites"): ?> <?php echo 'active' ?> <?php endif; ?>">
          <a class="py-2 px-3 text-black text-decoration-none" href="<?= url("favourites") ?>">المفضلة</a>
        </li>
        <li class="profile__tab <?php if ($_GET['page'] == "logout"): ?> <?php echo 'active' ?> <?php endif; ?>">
          <a class="py-2 px-3 text-black text-decoration-none" href="<?= url("logout") ?>">تسجيل الخروج</a>
        </li>
      </ul>
    </div>
    <div class="profile__left mt-4 mt-md-0 w-100">
      <div class="text-center py-2">
        <h3 class="text-success">
          <?php echo $_SESSION['success'] ?? ''; ?>
        </h3>
      </div>
      <div class="profile__tab-content active">
        <form class="profile__form border p-3" method="post" action="<?= url("edit-user&name=" . $_SESSION['auth']["name"]) ?>">
          <div class="w-100">
            <label class="fw-bold mb-2" for="displayed-name">
              الإسم كامل<span class="required">*</span>
            </label>
            <input type="text" class="form__input" id="displayed-name" name="user_name_new" />
          </div>
          <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['user_name_new'] ?? ''; ?></span>

          <div class="w-100 mb-3">
            <label class="fw-bold mb-2" for="email">
              البريد الالكتروني<span class="required">*</span>
            </label>
            <input type="email" class="form__input" id="email" name="user_email_new" />
          </div>
          <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['user_email_new'] ?? ''; ?></span>

          <button class="primary-button" type="sumbit">تعديل</button>
        </form>
        <form method="post" action="<?= url("edit-password&name=" . $_SESSION['auth']["name"]) ?>">
          <fieldset>
            <legend class="fw-bolder">تغيير كلمة المرور</legend>
            <div class="w-100 mb-3">
              <label class="fw-bold mb-2" for="curr-password">
                كلمة المرور الحالية (اترك الحقل فارغاً إذا كنت لا تودّ
                تغييرها)
              </label>
              <input type="password" class="form__input" id="curr-password" name="old_pass" />
            </div>
            <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['old_pass'] ?? ''; ?></span>
            <div class="w-100 mb-3">
              <label class="fw-bold mb-2" for="curr-password">
                كلمة المرور الجديدة (اترك الحقل فارغاً إذا كنت لا تودّ
                تغييرها)
              </label>
              <input type="password" class="form__input" id="new-password" name="new_pass" />
            </div>
            <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['new_pass'] ?? ''; ?></span>
            <div class="w-100 mb-3">
              <label class="fw-bold mb-2" for="curr-password">
                تأكيد كلمة المرور الجديدة
              </label>
              <input type="password" class="form__input" id="new-password-cur" name="new_pass_cur" />
            </div>
            <span class="text-danger fs-8 mb-3 d-block"><?php echo $_SESSION['error']['new_pass_cur'] ?? ''; ?></span>
            <button class="primary-button" type="submit">تغيير كلمة المرور</button>
          </fieldset>
        </form>
      </div>
    </div>
  </section>
</main>
<?php unset($_SESSION['error']); ?>
<?php unset($_SESSION['success']); ?>
<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>