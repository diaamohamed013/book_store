<nav class="nav">
    <div class="section-container w-100 d-flex align-items-center gap-4 h-100">
        <div class="nav__categories-btn align-items-center justify-content-center rounded-1 d-none d-lg-flex">
            <button class="border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#nav__categories">
                <i class="fa-solid fa-align-center fa-rotate-180"></i>
            </button>
        </div>
        <div class="nav__logo">
            <a href="<?= url("home") ?>">
                <img class="h-100" src="assets/images/logo.png" alt="">
            </a>
        </div>
        <div class="nav__search w-100">
            <input class="nav__search-input w-100" type="search" placeholder="أبحث هنا عن اي شئ تريده...">
            <span class="nav__search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
        <ul class="nav__links gap-3 list-unstyled d-none d-lg-flex m-0">
            <!-- <li class="nav__link nav__link-user">
              <a class="d-flex align-items-center gap-2">
                حسابي
                <i class="fa-regular fa-user"></i>
                <i class="fa-solid fa-chevron-down fa-2xs"></i>
              </a>
              <ul class="nav__user-list position-absolute p-0 list-unstyled bg-white">
                <li class="nav__link nav__user-link"><a href="profile.html">لوحة التحكم</a></li>
                <li class="nav__link nav__user-link"><a href="orders.html">الطلبات</a></li>
                <li class="nav__link nav__user-link"><a href="account_details.html">تفاصيل الحساب</a></li>
                <li class="nav__link nav__user-link"><a href="favourites.html">المفضلة</a></li>
                <li class="nav__link nav__user-link"><a href="">تسجيل الخروج</a></li>
              </ul>
            </li> -->
            <li class="nav__link d-flex align-items-center gap-2 flex-direction-row">
                <?php if (!getSession("auth")) : ?>
                    <a class="d-flex align-items-center gap-2" href="<?= url("account") ?>">
                        تسجيل الدخول
                        <i class="fa-regular fa-user"></i>
                    </a>
                <?php else : ?>
                    <a class="d-flex align-items-center gap-2" href="<?= url("profile") ?>">
                        <?php echo getSession("auth")['name']; ?>
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="<?php echo url("logout"); ?>">
                        <i class="fa fa-fw fa-sign-out-alt text-dark mr-3"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="<?php echo url("orders"); ?>">
                        <i class="fa fa-fw fa-box text-dark mr-3"></i>
                    </a>
                <?php endif; ?>

            </li>
            <li class="nav__link">
                <a class="d-flex align-items-center gap-2" href="<?= url("favourites") ?>">
                    المفضلة
                    <div class="position-relative">
                        <i class="fa-regular fa-heart"></i>
                        <div class="nav__link-floating-icon">
                        <?php if (getSession("favourites")): ?>
                            <?php echo count(getSession("favourites")) ?>
                        <?php else: ?>
                            0
                        <?php endif; ?>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav__link">
                <a href="<?= url('cart')?>" class="d-flex align-items-center gap-2" data-bs-target="#nav__cart">
                    عربة التسوق
                    <div class="position-relative">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <div class="nav__link-floating-icon">
                        <?php if (getSession("cart")): ?>
                            <?php echo count(getSession("cart")) ?>
                        <?php else: ?>
                            0
                        <?php endif; ?>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="nav-mobile fixed-bottom d-block d-lg-none">
        <ul class="nav-mobile__list d-flex justify-content-around gap-2 list-unstyled  m-0 border-top">
            <li class="nav-mobile__link">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="<?= url("home") ?>">
                    <i class="fa-solid fa-house"></i>
                    الرئيسية
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                data-bs-target="#nav__categories">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="<?= url("shop") ?>">
                <i class="fa-solid fa-align-center fa-rotate-180"></i>
                الاقسام
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="<?= url("profile") ?>">
                    <i class="fa-regular fa-user"></i>
                    حسابي
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="<?= url("favourites") ?>">
                    <i class="fa-regular fa-heart"></i>
                    المفضلة
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                data-bs-target="#nav__cart">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="<?= url("cart") ?>">
                <i class="fa-solid fa-cart-shopping"></i>
                السلة
                </a>
            </li>
        </ul>
        <!--  -->
    </div>
</nav>

<div class="nav__categories offcanvas offcanvas-start px-4 py-2" tabindex="-1" id="nav__categories"
    aria-labelledby="nav__categories">
    <div class="nav__categories-header offcanvas-header justify-content-end">
        <button type="button" class="border-0 bg-transparent text-danger nav__close" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="fa-solid fa-x fa-1x fw-light"></i>
        </button>
    </div>
    <div class="nav__categories-body offcanvas-body pt-0">
        <div class="nav__side-logo mb-2">
            <img class="w-100" src="assets/images/logo.png" alt="">
        </div>
        <ul class="nav__list list-unstyled">
            <li class="nav__link nav__side-link">
                <a href="index.php?page=shop&nr_page=1" class="py-3">
                    جميع المنتجات
                </a>
            </li>
            <?php
            $select_language = "SELECT `id`,`lang_name` FROM `languages`";
            $result_language = mysqli_query($conn, $select_language);
            foreach ($result_language as $row_language) : ?>
                <li class="nav__link nav__side-link">
                    <a href="index.php?page=shop&id=<?= $row_language['id'] ?>&nr_page=1" class="py-3">
                        <?php echo $row_language['lang_name']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


</div>
</div>
<!-- News Content Start -->
<section class="sales text-center p-2 d-block d-lg-none">
    شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
</section>
<!-- News Content End -->
</div>
<!-- Header Content End -->