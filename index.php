<?php
session_start();
$config = require_once 'src/config.php';
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/db.php';

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'home':
            require_once 'views/website/home.php';
            break;
        case 'about':
            require_once 'views/website/about.php';
            break;
        case 'contact':
            require_once 'views/website/contact.php';
            break;
        case "shop":
            require_once 'views/website/shop.php';
            break;
        case 'account_details':
            require_once 'views/website/account_details.php';
            break;
        case 'account':
            require_once 'views/website/account.php';
            break;
        case 'branches':
            require_once 'views/website/branches.php';
            break;
        case 'checkout':
            require_once 'views/website/checkout.php';
            break;
        case 'favourites':
            require_once 'views/website/favourites.php';
            break;
        case 'orders':
            require_once 'views/website/orders.php';
            break;
        case 'order_details':
            require_once 'views/website/order-details.php';
            break;
        case 'order_recieved':
            require_once 'views/website/order-recieved.php';
            break;
        case 'privacy_policy':
            require_once 'views/website/privacy-policy.php';
            break;
        case 'profile':
            require_once 'views/website/profile.php';
            break;
        case 'refund_policy':
            require_once 'views/website/refund-policy.php';
            break;
        case 'single_product':
            require_once 'views/website/single-product.php';
            break;
        case 'track_order':
            require_once 'views/website/track-order.php';
            break;
            //dashboard home page
        case 'dashboard':
            require_once 'views/dashboard/index.php';
            break;
        case 'books':
            require_once 'views/dashboard/books/showAll.php';
            break;
        case 'add-book':
            require_once 'views/dashboard/books/addBook.php';
            break;
        case 'update-book':
            require_once 'views/dashboard/books/updateBook.php';
            break;
        case 'store-book':
            require_once 'controllers/dashboard/books/add.php';
            break;
        case 'book-lang':
            require_once 'views/dashboard/books/add_lang.php';
            break;
        case 'store-lang':
            require_once 'controllers/dashboard/books/addLang.php';
            break;
            //not found
        default:
            require_once 'views/website/404.php';
    }
} else {
    require_once 'views/website/home.php';
}
