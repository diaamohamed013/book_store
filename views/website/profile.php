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

  <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
    <div class="profile__right mb-5">
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
      <div class="profile__tab-content active">
        <p class="mb-5">
          مرحبا <span class="fw-bolder"><?= $_SESSION['auth']["name"] ?></span> (لست
          <span class="fw-bolder"><?= $_SESSION['auth']["name"] ?></span>?
          <a class="text-danger" href="<?= url("logout") ?>">تسجيل الخروج</a>)
        </p>

        <p>
          من خلال لوحة تحكم الحساب الخاص بك، يمكنك استعراض
          <a class="text-danger" href="<?= url("orders") ?>">أحدث الطلبات</a>،
          والفواتير
          الخاصة بك، بالإضافة إلى
          <a class="text-danger" href="<?= url("account_details") ?>">تعديل كلمة المرور وتفاصيل حسابك</a>.
        </p>
      </div>
    </div>
  </section>
</main>


<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>