<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';

$db = new Database("localhost", "root", "", "ebook_project");

$id = $_GET['id'];
$single_book = $db->fetchAssociate("SELECT * FROM `books` WHERE `id` = '$id'");
$category = $single_book['category_id'];
$lang_name = $single_book['lang_id'];
$auth_name = $single_book['auth_id'];

?>


<main>
  <!-- Product details Start -->
  <section class="section-container my-5 pt-5 d-md-flex gap-5">
    <div class="single-product__img w-100" id="main-img">
      <img class="img-fluid" src="<?= BASE_URL . 'assets/images/books/' . $single_book['image'] ?>" alt="<?= $single_book['title'] ?>">
    </div>
    <div class="single-product__details w-100 d-flex flex-column justify-content-between">
      <div>
        <h4><?= $single_book['title'] ?></h4>
        <div class="product__author">
          <?php
          $select_auth_name = "SELECT `id`,`author_name` FROM `authors`";
          $result_auth_name = mysqli_query($conn, $select_auth_name);
          foreach ($result_auth_name as $row_auth_name) : ?>
            <?php if ($auth_name == $row_auth_name['id']) : ?>
              <?php echo $row_auth_name['author_name']; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <div class="product__author text-primary">
          <?php
          $select_lang_name = "SELECT `id`,`lang_name` FROM `languages`";
          $result_lang_name = mysqli_query($conn, $select_lang_name);
          foreach ($result_lang_name as $row_lang_name) : ?>
            <?php if ($lang_name == $row_lang_name['id']) : ?>
              <a href="<?= url("shop&id=" . $row_lang_name['id']) ?>">
                <?php echo $row_lang_name['lang_name']; ?>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <div>
          <p>
            كمية المنتج :
            <span class="text-muted"><?= $single_book['quantity'] ?></span>
          </p>
        </div>
        <div class="product__price mb-3 text-center d-flex gap-2">
          <span class="product__price product__price--old fs-6 <?php echo $single_book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
            <?= $single_book['price']; ?>
            $
          </span>
          <span class="product__price fs-5">
            <?= $single_book['price'] - (($single_book['price'] * $single_book['sale_percentage']) / 100) ?>
            $
          </span>
        </div>
        <div class="d-flex w-100 gap-2 mb-3">
          <div class="single-product__quanitity position-relative">
            <input class="single-product__input text-center px-3" type="number" value="1" placeholder="---">
            <button class="single-product__increase border-0 bg-transparent position-absolute end-0 h-100 px-3">+</button>
            <button class="single-product__decrease border-0 bg-transparent position-absolute start-0 h-100 px-3">-</button>
          </div>
          <a href="<?= url("cart&id=" . $single_book['id']) ?>" class="single-product__add-to-cart primary-button w-100 text-decoration-none text-center">اضافه الي السلة</a>
        </div>
        <a href="<?= url("favourites&id=" . $single_book['id']) ?>">
          <div class="single-product__favourite d-flex align-items-center gap-2 mb-4">
            <i class="fa-regular fa-heart"></i>
          </div>
        </a>
      </div>
    </div>
  </section>
  <!-- Product details End -->

  <!-- Description and questions Start -->
  <section class="section-container">
    <nav class="mb-0 ">
      <div class="nav nav-tabs single-product__nav pb-0 gap-2" id="nav-tab" role="tablist">
        <button class="single-product__tab nav-link active" id="single-product__describtion-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
          الوصف
        </button>
        <button class="single-product__tab nav-link" id="single-product__questions-tab" data-bs-toggle="tab" data-bs-target="#single-product__questions" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
          الاسئلة الشائعة
        </button>
      </div>
    </nav>
    <div class="tab-content pt-4" id="nav-tabContent">
      <div class="tab-pane show active" id="nav-description" role="tabpanel" aria-labelledby="single-product__describtion-tab" tabindex="0">
        <?= $single_book['title'] ?>
      </div>
      <div class="questions tab-pane" id="single-product__questions" role="tabpanel" aria-labelledby="single-product__questions-tab" tabindex="0">
        <div class="questions__list accordion" id="question__list">
          <div class="questions__item accordion-item">
            <h2 class="questions__header accordion-header" id="question1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                الشحن بيوصل خلال قد ايه؟
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="question1" data-bs-parent="#question__list">
              <div class="accordion-body">
                خلال 3 ايام داخل القاهرة والجيزة و7 ايام خارج القاهرة والجيزة.
              </div>
            </div>
          </div>
          <div class="questions__item accordion-item">
            <h2 class="questions__header accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                خامات التصنيع؟
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#question__list">
              <div class="accordion-body">
                خامات مصرية عالية الجودة.
              </div>
            </div>
          </div>
          <div class="questions__item accordion-item">
            <h2 class="questions__header accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                متاح استبدال او استرجاع المنتج
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#question__list">
              <div class="accordion-body">
                نعم، متاح الاستبدال والاسترجاع خلال 7 ايام، برجاء مراجعة <a class="text-danger" href="<?= url("refund_policy") ?>">سياسة الاسترجاع والاستبدال</a>.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Description and questions End -->

  <!-- Features Start -->
  <section class="section-container py-5">
    <div class="row">
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="features__item d-flex align-items-center gap-2">
          <div class="features__img">
            <img class="w-100" src="assets/images/feature-1.png" alt="">
          </div>
          <div>
            <h6 class="features__item-title m-0">شحن سريع</h6>
            <p class="features__item-text m-0">سعر شحن موحد لجميع المحافظات ويصلك في أقل من 72 ساعة</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="features__item d-flex align-items-center gap-2">
          <div class="features__img">
            <img class="w-100" src="assets/images/feature-2.png" alt="">
          </div>
          <div>
            <h6 class="features__item-title m-0">ضمان الجودة</h6>
            <p class="features__item-text m-0">خامات عالية الجودة ومرونه فى طلبات الاستبدال والاسترجاع</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="features__item d-flex align-items-center gap-2">
          <div class="features__img">
            <img class="w-100" src="assets/images/feature-3.png" alt="">
          </div>
          <div>
            <h6 class="features__item-title m-0">دعم فني</h6>
            <p class="features__item-text m-0">دعم فني على مدار اليوم للإجابة على اي استفسار لديك</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 mb-3">
        <div class="features__item d-flex align-items-center gap-2">
          <div class="features__img">
            <img class="w-100" src="assets/images/feature-4.png" alt="">
          </div>
          <div>
            <h6 class="features__item-title m-0">استبدال سهل</h6>
            <p class="features__item-text m-0">يمكنك استبدال واسترجاع المنتج في حالة عدم مطابقة المواصفات.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Features End -->

  <!-- Related products Start -->
  <section class="section-container">
    <div class="d-flex gap-4 align-items-center w-100 mb-4">
      <h5 class="m-0">منتجات ذات صلة</h5>
      <hr class="flex-grow-1">
    </div>
    <div class="row">
      <?php
      $select_lang_name = "SELECT `books`.* , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                  INNER JOIN `authors` ON books.auth_id = authors.id 
                                  INNER JOIN `languages` ON books.lang_id = languages.id";
      $result_lang_name = mysqli_query($conn, $select_lang_name);
      foreach ($result_lang_name as $row_lang_name) : ?>
        <?php if ($lang_name == $row_lang_name['lang_id']) : ?>
          <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
            <div class="product__header mb-3">
              <a href="<?= url("single_product&id=" . $row_lang_name['id']) ?>">
                <div class="product__img-cont">
                  <img class="product__img w-100 h-100 object-fit-cover" src="<?php echo BASE_URL . 'assets/images/books/' . $row_lang_name['image'] ?>" data-id="white">
                </div>
              </a>
              <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
                وفر 10%
              </div>
              <a href="<?= url("favourites&id=" . $row_lang_name['id']) ?>">
                <div
                  class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                  <i class="fa-regular fa-heart"></i>
                </div>
              </a>
            </div>
            <div class="product__title text-center">
              <a class="text-black text-decoration-none" href="<?= url("single_product&id=" . $row_lang_name['id']) ?>">
                <?= $row_lang_name['title'] ?>
              </a>
            </div>
            <div class="product__author text-center">
              <p>
                <?= $row_lang_name['author_name']; ?>
              </p>
              <p>
                <?= $row_lang_name['lang_name']; ?>
              </p>
            </div>
            <div
              class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
              <span class="product__price product__price--old <?php echo $row_lang_name['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
                <?= $row_lang_name['price']; ?>
                $
              </span>
              <span class="product__price">
                <?= $row_lang_name['price'] - (($row_lang_name['price'] * $row_lang_name['sale_percentage']) / 100) ?>
                $
              </span>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </section>
  <!-- Related products End -->

  <!-- Users comments Start -->
  <section class="section-container comments mb-5">
    <div class="d-flex gap-4 align-items-center w-100 mb-4">
      <h5 class="m-0">أعرف اراء عملاؤنا</h5>
      <hr class="flex-grow-1">
    </div>
    <div class="comments__slider owl-carousel owl-theme">
      <div class="comments__item">
        <div class="comments__icon">
          <img class="w-100" src="assets/images/quote.png" alt="">
        </div>
        <div class="comments__text mb-3">
          الكتاب جميل جدا
        </div>
        <div class="comments__author d-flex align-items-center gap-2">
          <div class="comments__author-dash"></div>
          <div class="comments__author-name fw-bolder">
            Moamen Sherif
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Users comments End -->
</main>

<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>