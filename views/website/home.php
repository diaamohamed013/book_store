<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
$res = getAll("slider");
$db = new Database("localhost", "root", "", "ebook_project");
$all_books = $db->sqlQuery("SELECT `books`.*  , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                  INNER JOIN `authors` ON books.auth_id = authors.id 
                                  INNER JOIN `languages` ON books.lang_id = languages.id GROUP BY books.`id`");

$most_sell_books = $db->sqlQuery("SELECT `books`.*  , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                  INNER JOIN `authors` ON books.auth_id = authors.id 
                                  INNER JOIN `languages` ON books.lang_id = languages.id
                                  INNER JOIN `categories` ON books.category_id = categories.id 
                                  WHERE category_id = 1");


$new_Arrival_books = $db->sqlQuery("SELECT `books`.*  , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                  INNER JOIN `authors` ON books.auth_id = authors.id 
                                  INNER JOIN `languages` ON books.lang_id = languages.id
                                  INNER JOIN `categories` ON books.category_id = categories.id 
                                  WHERE category_id = 2");
?>
<!-- Page Content Start -->
<main class="pt-4">
  <!-- Hero Section Start -->
  <section class="section-container hero">
    <?php $i = 0; ?>
    <div class="owl-carousel hero__carousel owl-theme <?php if ($i == 0) echo "active";
                                                      $i++; ?>">
      <?php while ($row = mysqli_fetch_assoc($res)) : ?>
        <div class="hero__item">
          <img class="hero__img" src="<?php echo BASE_URL . "assets/images/" . $row['image'] ?>" alt="">
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Offer Section Start -->
  <section class="section-container mb-5 mt-3">
    <div class="offer d-flex align-items-center justify-content-between rounded-3 p-3 text-white">
      <div class="offer__title fw-bolder">
        عروض اليوم
      </div>
      <div class="offer__time d-flex gap-2 fs-6">`
        <div class="d-flex flex-column align-items-center">
          <span class="fw-bolder">06</span>
          <div>ساعات</div>
        </div>:
        <div class="d-flex flex-column align-items-center">
          <span class="fw-bolder">10</span>
          <div>دقائق</div>
        </div>:
        <div class="d-flex flex-column align-items-center">
          <span class="fw-bolder">13</span>
          <div>ثواني</div>
        </div>
      </div>
    </div>
  </section>
  <!-- Offer Section End -->

  <!-- Products Section Start -->
  <section class="section-container mb-4">
    <div class="owl-carousel products__slider owl-theme">
      <?php while ($book = mysqli_fetch_assoc($all_books)) : ?>
        <div class="products__item">
          <div class="product__header mb-3">
            <a href="<?= url("single_product&id=" . $book['id']) ?>">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="<?php echo BASE_URL . 'assets/images/books/' . $book['image'] ?>" data-id="white">
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white <?php echo $book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
              وفر
              <?= $book['sale_percentage']; ?>
              %
            </div>
            <a href="<?= url("add-favourites&id=" . $book['id']) ?>">
              <div
                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                <i class="fa-regular fa-heart"></i>
              </div>
            </a>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="<?= url("single_product&id=" . $book['id']) ?>">
              <?= $book['title']; ?>
            </a>
          </div>
          <div class="product__author text-center">
            <p>
              <?= $book['author_name']; ?>
            </p>
            <p>
              <?= $book['lang_name']; ?>
            </p>
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old <?php echo $book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
              <?= $book['price']; ?>
              $
            </span>
            <span class="product__price">
              <?= $book['price'] - (($book['price'] * $book['sale_percentage']) / 100) ?>
              $
            </span>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <!-- Products Section End -->

  <!-- Categories Section Start -->
  <section class="section-container mb-5">
    <div class="categories row gx-4">
      <div class="col-md-6 p-2">
        <a href="<?php echo url("shop&id=1&nr_page=1") ?>">
          <div class="p-4 border rounded-3">
            <img class="w-100" src="assets/images/category-1.png" alt="">
          </div>
        </a>
      </div>
      <div class="col-md-6 p-2">
        <a href="<?php echo url("shop&id=2&nr_page=1") ?>">
          <div class="p-4 border rounded-3">
            <img class="w-100" src="assets/images/category-2.png" alt="">
          </div>
        </a>
      </div>
    </div>
  </section>
  <!-- Categories Section End -->

  <!-- Best Sales Section Start -->
  <section class="section-container mb-5">
    <div class="products__header mb-4 d-flex align-items-center justify-content-between">
      <h4 class="m-0">الاكثر مبيعا</h4>
      <a href="<?php echo url("shop") ?>" class="products__btn py-2 px-3 rounded-1 text-dark text-decoration-none">تسوق الأن</a>
    </div>
    <div class="owl-carousel products__slider owl-theme">
      <?php while ($book = mysqli_fetch_assoc($most_sell_books)) : ?>
        <div class="products__item">
          <div class="product__header mb-3">
            <a href="<?= url("single_product&id=" . $book['id']) ?>">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="<?php echo BASE_URL . 'assets/images/books/' . $book['image'] ?>" data-id="white">
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white <?php echo $book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
              وفر
              <?= $book['sale_percentage']; ?>
              %
            </div>
            <a href="<?= url("add-favourites&id=" . $book['id']) ?>">
              <div
                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                <i class="fa-regular fa-heart"></i>
              </div>
            </a>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="<?= url("single_product&id=" . $book['id']) ?>">
              <?= $book['title']; ?>
            </a>
          </div>
          <div class="product__author text-center">
            <p>
              <?= $book['author_name']; ?>
            </p>
            <p>
              <?= $book['lang_name']; ?>
            </p>
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old <?php echo $book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
              <?= $book['price']; ?>
              $
            </span>
            <span class="product__price">
              <?= $book['price'] - (($book['price'] * $book['sale_percentage']) / 100) ?>
              $
            </span>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <!-- Best Sales Section End -->

  <!-- Newest Section Start -->
  <section class="section-container mb-5">
    <div class="products__header mb-4 d-flex align-items-center justify-content-between">
      <h4 class="m-0">وصل حديثا</h4>
      <a href="<?php echo url("shop") ?>" class="products__btn py-2 px-3 rounded-1 text-dark text-decoration-none">تسوق الأن</a>
    </div>
    <div class="owl-carousel products__slider owl-theme">
      <?php while ($book = mysqli_fetch_assoc($new_Arrival_books)) : ?>
        <div class="products__item">
          <div class="product__header mb-3">
            <a href="<?= url("single_product&id=" . $book['id']) ?>">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="<?php echo BASE_URL . 'assets/images/books/' . $book['image'] ?>" data-id="white">
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white <?php echo $book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
              وفر
              <?= $book['sale_percentage']; ?>
              %
            </div>
            <a href="<?= url("add-favourites&id=" . $book['id']) ?>">
              <div
                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                <i class="fa-regular fa-heart"></i>
              </div>
            </a>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="<?= url("single_product&id=" . $book['id']) ?>">
              <?= $book['title']; ?>
            </a>
          </div>
          <div class="product__author text-center">
            <p>
              <?= $book['author_name']; ?>
            </p>
            <p>
              <?= $book['lang_name']; ?>
            </p>
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old <?php echo $book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
              <?= $book['price']; ?>
              $
            </span>
            <span class="product__price">
              <?= $book['price'] - (($book['price'] * $book['sale_percentage']) / 100) ?>
              $
            </span>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <!-- Newest Section End -->
</main>
<!-- Page Content End -->

<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>