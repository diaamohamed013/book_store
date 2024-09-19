<?php
require_once ROOT_PATH . 'controllers/db_class/Database.php';
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';

$db = new Database("localhost", "root", "", "ebook_project");
$start = 0;
$rows_per_page = 4;

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $all_books = "SELECT * FROM `languages` WHERE `id` = '$id'";;
  if (check($all_books)) {

    $records = $db->sqlQuery("SELECT `books`.* , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                      INNER JOIN `authors` ON books.auth_id = authors.id 
                                      INNER JOIN `languages` ON books.lang_id = languages.id 
                                      WHERE `lang_id` = '$id'");

    $nr_of_rows = $records->num_rows;
    $pages = ceil($nr_of_rows / $rows_per_page);
    if (isset($_GET['nr_page'])) {
      $book_page = $_GET['nr_page'] - 1;
      $start = $book_page * $rows_per_page;
    }

    $all_books = $db->sqlQuery("SELECT `books`.* , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                      INNER JOIN `authors` ON books.auth_id = authors.id 
                                      INNER JOIN `languages` ON books.lang_id = languages.id 
                                      WHERE `lang_id` = '$id' LIMIT $start , $rows_per_page");
  } else {
    require_once 'views/website/404.php';
    die;
  }
} else {
  $str = "";
  // if (isset($_GET['name'])) {
  //   $name = $_GET['name'];
  //   $str = "WHERE `author_name` = '$name'";
  // }
  $records = $db->sqlQuery("SELECT `books`.* , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                  INNER JOIN `authors` ON books.auth_id = authors.id 
                                  INNER JOIN `languages` ON books.lang_id = languages.id $str");

  $nr_of_rows = $records->num_rows;
  $pages = ceil($nr_of_rows / $rows_per_page);
  if(isset($_GET['nr_page'])){
    $book_page = $_GET['nr_page'] -1 ;
    $start = $book_page * $rows_per_page;
  }

  $all_books = $db->sqlQuery("SELECT `books`.* , `authors`.`author_name` , `languages`.`lang_name` FROM `books` 
                                  INNER JOIN `authors` ON books.auth_id = authors.id 
                                  INNER JOIN `languages` ON books.lang_id = languages.id $str LIMIT $start , $rows_per_page");
}


?>

<main>
  <div
    class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>المتجر</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="<?= url("home") ?>">الرئيسية</a> /
        <span class="text-gray">المتجر</span>
      </div>
    </div>
  </div>

  <div class="section-container d-block d-lg-flex gap-5 shop mt-5 pt-5">
    <!-- <div class="shop__filter mb-4"> -->
    <!-- <div class="mb-4">
            <h6 class="shop__filter-title">بتدور علي ايه؟</h6>
            <form action="">
              <div class="filter__search position-relative">
                <input
                  class="w-100 py-1 ps-2"
                  type="text"
                  placeholder="بتدور علي ايه؟"
                />
                <div
                  class="filter__search-icon position-absolute h-100 top-0 end-0 p-2 d-flex justify-content-center align-items-center"
                >
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
            </form>
          </div> -->
    <div class="shop__products col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <?php if (isset($_GET['nr_page'])) : ?>
          <p class="m-0">
            عرض 1
            -
            <?php echo $pages; ?>
            من أصل
            <?php echo $records->num_rows; ?>
            نتيجة
          </p>
        <?php endif; ?>
        <form action="">
          <div class="filter__search position-relative">
            <input
              class="w-100 py-1 ps-2"
              type="text"
              placeholder="بتدور علي ايه؟" />
            <div
              class="filter__search-icon position-absolute h-100 top-0 end-0 p-2 d-flex justify-content-center align-items-center">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
          </div>
        </form>
      </div>
      <div class="row products__list">
        <?php while ($book = mysqli_fetch_assoc($all_books)) : ?>
          <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
            <div class="product__header mb-3 position-relative">
              <a href="<?= url("single_product&id=" . $book['id']) ?>">
                <div class="product__img-cont">
                  <img
                    class="product__img w-100 h-100 object-fit-cover"
                    src="<?php echo BASE_URL . 'assets/images/books/' . $book['image'] ?>"
                    data-id="white" />
                </div>
              </a>
              <div
                class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white <?php echo $book['sale_percentage'] > 0 ? "d-block" : "d-none" ?>">
                وفر
                <?= $book['sale_percentage']; ?>
                %
              </div>
              <a href="<?= url("favourites&id=" . $book['id']) ?>">
                <div
                  class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                  <i class="fa-regular fa-heart"></i>
                </div>
              </a>
            </div>
            <div class="product__title text-center">
              <a
                class="text-black text-decoration-none"
                href="<?= url("single_product&id=" . $book['id']) ?>">
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
            <div
              class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
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
      <?php
      $str = isset($_GET['id']) ? $_GET['id'] : ""; ?>
      <?php if (isset($_GET['nr_page'])) : ?>
        <div
          class="products__pagination mb-5 d-flex justify-content-center gap-2">
          <?php if (isset($_GET['id']) && $str == $_GET['id']) : ?>
            <a href="index.php?page=shop&id=<?= $str ?>&nr_page=1" class="text-decoration-none">
              <span class="pagination__btn rounded-1">first</span>
            </a>
          <?php else: ?>
            <a href="index.php?page=shop&nr_page=1" class="text-decoration-none">
              <span class="pagination__btn rounded-1">first</span>
            </a>
          <?php endif; ?>

          <?php if (isset($_GET['id']) && $str == $_GET['id']) : ?>
            <?php if (isset($_GET['nr_page'])) : ?>
              <?php if ($_GET['nr_page'] > 1): ?>
                <a href="index.php?page=shop&id=<?= $str ?>&nr_page=<?= $_GET['nr_page'] - 1 ?>">
                  <span class="pagination__btn rounded-1 pagination__btn--next">
                    <i class="fa-solid fa-arrow-right-long"></i>
                  </span>
                </a>
              <?php else: ?>
                <a>
                  <span class="pagination__btn rounded-1 pagination__btn--next">
                    <i class="fa-solid fa-arrow-right-long"></i>
                  </span>
                </a>
              <?php endif; ?>
            <?php endif; ?>
          <?php else: ?>
            <?php if (isset($_GET['nr_page'])) : ?>
              <?php if ($_GET['nr_page'] > 1): ?>
                <a href="index.php?page=shop&nr_page=<?= $_GET['nr_page'] - 1 ?>">
                  <span class="pagination__btn rounded-1 pagination__btn--next">
                    <i class="fa-solid fa-arrow-right-long"></i>
                  </span>
                </a>
              <?php else: ?>
                <a>
                  <span class="pagination__btn rounded-1 pagination__btn--next">
                    <i class="fa-solid fa-arrow-right-long"></i>
                  </span>
                </a>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>

          <?php for ($counter = 1; $counter <= $pages; $counter++) : ?>
            <?php if (isset($_GET['id']) && $str == $_GET['id']) : ?>
              <a href="index.php?page=shop&id=<?= $str ?>&nr_page=<?= $counter ?>" class="text-decoration-none">
                <span class="pagination__btn rounded-1 <?= $counter == $_GET['nr_page'] ? "active" : "" ?>">
                  <?= $counter ?>
                </span>
              </a>
            <?php else : ?>
              <a href="index.php?page=shop&nr_page=<?= $counter ?>" class="text-decoration-none">
                <span class="pagination__btn rounded-1 <?= $counter == $_GET['nr_page'] ? "active" : "" ?>">
                  <?= $counter ?>
                </span>
              </a>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if (isset($_GET['id']) && $str == $_GET['id']) : ?>
            <?php if (!isset($_GET['nr_page'])) : ?>
              <a href="index.php?page=shop&id=<?= $str ?>&nr_page=2">
                <span class="pagination__btn rounded-1 pagination__btn--prev">
                  <i class="fa-solid fa-arrow-left-long"></i>
                </span>
              </a>
            <?php else: ?>
              <?php if (isset($_GET['nr_page'])) : ?>
                <?php if ($_GET['nr_page'] >= $pages) : ?>
                  <a>
                    <span class="pagination__btn rounded-1 pagination__btn--prev">
                      <i class="fa-solid fa-arrow-left-long"></i>
                    </span>
                  </a>
                <?php else: ?>
                  <a href="index.php?page=shop&id=<?= $str ?>&nr_page=<?= $_GET['nr_page'] + 1 ?>">
                    <span class="pagination__btn rounded-1 pagination__btn--prev">
                      <i class="fa-solid fa-arrow-left-long"></i>
                    </span>
                  </a>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php else: ?>
            <?php if (!isset($_GET['nr_page'])) : ?>
              <a href="index.php?page=shop&nr_page=2">
                <span class="pagination__btn rounded-1 pagination__btn--prev">
                  <i class="fa-solid fa-arrow-left-long"></i>
                </span>
              </a>
            <?php else: ?>
              <?php if (isset($_GET['nr_page'])) : ?>
                <?php if ($_GET['nr_page'] >= $pages) : ?>
                  <a>
                    <span class="pagination__btn rounded-1 pagination__btn--prev">
                      <i class="fa-solid fa-arrow-left-long"></i>
                    </span>
                  </a>
                <?php else: ?>
                  <a href="index.php?page=shop&nr_page=<?= $_GET['nr_page'] + 1 ?>">
                    <span class="pagination__btn rounded-1 pagination__btn--prev">
                      <i class="fa-solid fa-arrow-left-long"></i>
                    </span>
                  </a>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>

          <?php if (isset($_GET['id']) && $str == $_GET['id']) : ?>
            <a href="index.php?page=shop&nr_page=<?= $pages ?>" class="text-decoration-none">
              <span class="pagination__btn rounded-1">last</span>
            </a>
          <?php else: ?>
            <a href="index.php?page=shop&nr_page=<?= $pages ?>" class="text-decoration-none">
              <span class="pagination__btn rounded-1">last</span>
            </a>
          <?php endif; ?>

        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>