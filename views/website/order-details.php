<?php
if (!getSession("auth")) {
  redirect('account');
}
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
?>

<main>
  <div
    class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>تتبع طلبك</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="<?= url("home") ?>">الرئيسية</a> /
        <span class="text-gray">تتبع طلبك</span>
      </div>
    </div>
  </div>

  <section class="section-container my-5 py-5">
    <?php
    $db = new Database("localhost", "root", "", "ebook_project");
    $order_id = $_GET['order_id'];
    $sql = "SELECT * FROM `orders` WHERE `id` = '$order_id'";
    $order = $db->fetchAssociate($sql);
    if ($order['status'] == 'pending') {
      $order['status'] =  "قيد الانتظار";
    } elseif ($order['status'] == 'processing') {
      $order['status'] =  "قيد التحضير";
    } elseif ($order['status'] == 'delivered') {
      $order['status'] =  "تم التوصيل";
    } elseif ($order['status'] == 'shipped') {
      $order['status'] =  "تم الشخن";
    } else {
      $order['status'] =  "لم يتم تحديد الحالة";
    }
    ?>
    <p>
      تم تقديم الطلب <?= $order['order_number'] ?> في <?= $order['created_at'] ?> وهو الآن بحالة <?= $order['status'] ?>.
    </p>

    <section>
      <h2>تفاصيل الطلب</h2>
      <table class="success__table w-100 mb-5">
        <thead>
          <tr class="border-0 bg-danger text-white">
            <th>المنتج</th>
            <th class="d-none d-md-table-cell">السعر قبل الخصم</th>
            <th class="d-none d-md-table-cell">السعر بعد الخصم</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $db = new Database("localhost", "root", "", "ebook_project");
          $sql = "SELECT orders.* , books.* FROM orders INNER JOIN order_items
                  ON order_items.order_id = orders.id INNER JOIN books ON order_items.book_id = books.id WHERE orders.id = $order_id";
          $result = $db->sqlQuery($sql);
          while ($order_info = mysqli_fetch_assoc($result)):
          ?>
            <tr>
              <td>
                <div class="d-flex flex-wrap g-5 align-items-center mb-3">
                  <div style="width: 45px; height: 45px;">
                    <img src="<?= BASE_URL . 'assets/images/books/' .  $order_info['image'] ?>" alt="<?= $order_info['title'] ?>" style="width: 100%; height: 100%; object-fit:cover;">
                  </div>
                  <span class="mx-2"><?= $order_info['title'] ?></span>
                </div>
                <?php if ($order_info['sale_percentage']) : ?>
                  <div>
                    <span class="fw-bold">نسبة الخصم:</span>
                    <span>
                      <?= $order_info['sale_percentage'] ?>%
                    </span>
                  </div>
                <?php endif; ?>
              </td>
              <td>
                  <?= $order_info['price'] ?> $
              </td>
              <td>
                <?php if ($order_info['sale_percentage']) : ?>
                  <?= $order_info['price'] - (($order_info['price'] * $order_info['sale_percentage']) / 100) ?> $
                <?php else : ?>
                  <?= $order_info['price'] ?> $
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
          <tr>
            <th>الإجمالي:</th>
            <th></th>
            <td class="fw-bold">
              <?= $order['total_price'] ?> $
            </td>
          </tr>
        </tbody>
      </table>
    </section>
    <section class="mb-5">
      <h2>عنوان الفاتورة</h2>
      <div class="border p-3 rounded-3">
        <p class="mb-1">
          <?= $order['first_name'] ?> <?= $order['last_name'] ?>
        </p>
        <p class="mb-1">
          <?= $order['address'] ?>
        </p>
        <p class="mb-1">
          <?= $order['city'] ?>
        </p>
        <p class="mb-1">
          <?= $order['phone'] ?>
        </p>
        <p class="mb-1">
          <?= $order['email'] ?>
        </p>
      </div>
    </section>
  </section>
</main>

<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>