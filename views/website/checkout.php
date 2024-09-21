<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';

require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';

?>

<main>
  <section
    class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>إتمام الطلب</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="<?= url("home") ?>">الرئيسية</a> /
        <span class="text-gray">إتمام الطلب</span>
      </div>
    </div>
  </section>

  <section class="section-container my-5 py-5 d-lg-flex">
    <div class="checkout__form-cont w-50 px-3 mb-5">
      <h4>الفاتورة </h4>
      <form class="checkout__form" action="<?= url('add-order') ?>"  method="post" >
        <div class="d-flex gap-3 mb-3">
          <div class="w-50">
            <label for="first-name">الاسم الأول <span class="required">*</span></label>
            <input class="form__input" type="text" id="first-name"name="fname" />
            <span class="text-danger">
                        <?php echo $_SESSION['error']['fname'] ?? ''; ?>
                    </span>
          </div>
          <div class="w-50">
            <label for="last-name">الاسم الأخير <span class="required">*</span></label>
            <input class="form__input" type="text" id="last-name" name="lname"/>
            <span class="text-danger">
                        <?php echo $_SESSION['error']['lname'] ?? ''; ?>
                    </span>
          </div>
        </div>
        <div class="mb-3">
          <label for="last-name">المدينة / المحافظة<span class="required">*</span></label>
          <select
            class="form__input bg-transparent"
            type="text"
            id="last-name">
            <option or$order="">القاهرة</option>
            <option or$order="">اسكندرية</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="last-name">العنوان بالكامل ( المنطقة -الشارع - رقم المنزل)<span
              class="required">*</span></label>
          <input
            class="form__input"
            placeholder="رقم المنزل او الشارع / الحي"
            type="text"
            id="last-name"
            name="address" />
            <span class="text-danger">
                        <?php echo $_SESSION['error']['address'] ?? ''; ?>
                    </span>
        </div>
        <div class="mb-3">
          <label for="last-name">رقم الهاتف<span class="required">*</span></label>
          <input class="form__input" type="text" id="last-name" name="phone" />
          <span class="text-danger">
                        <?php echo $_SESSION['error']['phone'] ?? ''; ?>
                    </span>
        </div>
        <div class="mb-3">
          <label for="last-name">البريد الإلكتروني (اختياري)<span class="required">*</span></label>
          <input class="form__input" type="text" id="last-name" name="email" />
          <span class="text-danger">
                        <?php echo $_SESSION['error']['email'] ?? ''; ?>
                    </span>
        </div>
        <div class="mb-3">
          <h2>معلومات اضافية</h2>
          <label for="last-name">ملاحظات الطلب (اختياري)<span class="required">*</span></label>
          <textarea
            class="form__input"
            placeholder="ملاحظات حول الطلب, مثال: ملحوظة خاصة بتسليم الطلب."
            type="text"
            id="last-name" name="info"></textarea>
            <span class="text-danger">
                        <?php echo $_SESSION['error']['info'] ?? ''; ?>
                    </span>
        </div>
        <button  class="primary-button w-100 py-2">تاكيد الطلب</button>
      </form>
      
    </div>
 
    <div class="checkout__order-details-cont w-50 px-3">
      <h4>طلبك</h4>
      <div>
        <table class="w-100 checkout__table">
          <thead>
            <tr class="border-0">
              <th>المنتج</th>
              <th>المجموع</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (getSession('cart') as $key => $value) : ?>
            <tr>
              <td><?= $value['title'] ?></td>
              <td>
                <div
                  class="product__price text-center d-flex gap-2 flex-wrap">
                  <span class="product__price product__price--old">
                  <?= $value['price'] ?>
                  </span>
                  <span class="product__price"><?= $value['price'] - (($value['price'] * $value['sale']) / 100) ?></span>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-green">
              <th>قمت بتوفير</th>
              <td class="fw-bolder">      <?php
                  $totalPrice = 0;
                  foreach (getSession('cart') as $$key => $value) {
                    $discountedPrice = (($value['price'] * $value['sale']) / 100) ;
                    $totalPrice += $discountedPrice;
                  }
                  echo $totalPrice . ' $';
                  ?> </td>
            </tr>
           
            <tr>
              <th>الإجمالي</th>
              <td class="fw-bolder"> 
                <?php
                  $totalPrice = 0;
                  foreach (getSession('cart') as $$key => $value) {
                    $discountedPrice = $value['price'] - (($value['price'] * $value['sale']) / 100);
                    $totalPrice += $discountedPrice;
                  }
                  echo $totalPrice . ' $';
                  ?>
            </tr>
           
          </tbody>
        </table>
      </div>



      <div class="checkout__payment py-3 px-4 mb-3">
        <p class="m-0 fw-bolder">الدفع نقدا عند الاستلام</p>
      </div>

      <p>الدفع عند التسليم مباشرة.</p>
    </div>
   x
  </section>
</main>

<?php
  

unset($_SESSION['error']); 

require_once ROOT_PATH . 'inc/website/footer.php'; ?>