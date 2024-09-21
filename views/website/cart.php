<?php
if (!getSession("auth")) {
  $_SESSION['added-to-cart'] = "Please log in frist";
  redirect("account");
}

require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';

?>

<main>
  <div
    class="page-top d-flex justify-content-center align-values-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>عربةالتسوق</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="<?= url("home") ?>">الرئيسية</a> /
        <span class="text-gray">عربة التسوق</span>
      </div>
    </div>
  </div>

  <div class="my-5 py-5">
    <section class="section-container favourites">
      <?php if (getSession('cart')): ?>
        <table class="w-100">
          <thead>
            <th class="d-none d-md-table-cell"></th>
            <th class="d-none d-md-table-cell"></th>
            <th class="d-none d-md-table-cell">الاسم</th>
            <th class="d-none d-md-table-cell">السعر</th>
            <th class="d-none d-md-table-cell">تاريخ الاضافه</th>
            <th class="d-none d-md-table-cell">الكمية</th>
            <th class="d-none d-md-table-cell">المخزون</th>
            <th class="d-table-cell d-md-none">product</th>
          </thead>
          <tbody class="text-center">
            <?php foreach (getSession('cart') as $key => $value): ?>
              <tr>
                <td class="d-block d-md-table-cell">
                  <a href="<?= url('remove&id=' . $key) ?>" class="favourites__remove m-auto">
                    <i class="fa-solid fa-xmark"></i>
                  </a>
                </td>
                <td class="d-block d-md-table-cell favourites__img">
                  <img src="<?php echo BASE_URL . 'assets/images/books/' . $value['image'] ?>" alt="" />
                </td>

                <td class=""><?= $value['title'] ?> </td>
                <td class="d-block d-md-table-cell">
                  <span class="product__price product__price--old"><?= $value['price'] ?> جنية</span>
                  <span class="product__price"><?= $value['price'] - (($value['price'] * $value['sale']) / 100) ?> جنية</span>
                </td>
                <td class="d-block d-md-table-cell"><?= date('Y-m-d') ?></td>
                <td class="d-block d-md-table-cell">

                  <span class="d-inline-block d-md-none d-lg-inline-block"><?= $value['quantity'] ?> </span>
                </td>

                <td class="d-block d-md-table-cell">
                  <span class="me-2"><i class="fa-solid fa-check"></i></span>
                  <span class="d-inline-block d-md-none d-lg-inline-block">متوفر بالمخزون</span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <!-- Total Row -->
            <tr>
              <td colspan="5" class="text-end fw-bold">إجمالي:</td>
              <td colspan="2" class="text-end fw-bold">
                <strong>
                  <?php
                  $totalPrice = 0;
                  foreach (getSession('cart') as $$key => $value) {
                    $discountedPrice = $value['price'] - (($value['price'] * $value['sale']) / 100);
                    $totalPrice += $discountedPrice;
                  }
                  echo $totalPrice . ' $';
                  ?>
                </strong>
              
              </td>
            </tr>

            <tr>
              <td colspan="7" class="text-end">
                <a href="<?= url('checkout&id=' . $key) ?>" class="btn btn-primary btn-lg" style="background-color: #20c997; border-color: #20c997;">
                  إتمام الشراء
                </a>
                <a href="<?= url('shop&nr_page=1') ?>" class="btn btn-primary btn-lg" style="background-color: #20c997; border-color: #20c997;">
                  تابع التسوق
                </a>
              </td>
            </tr>
          </tfoot>

        </table>
      <?php else: ?>
        <div class="d-flex justify-content-center align-values-center ">
          <div class="page-center__title mb-3">
            <h2>لاتوجد منتجات في عربة التسوق</h2>
          </div>
        </div>
      <?php endif; ?>
    </section>
  </div>

</main>

<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>