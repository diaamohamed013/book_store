<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

if (!getSession("auth")) {
    $_SESSION['added-to-cart'] = "Please log in frist";
    redirect("account");
}

if (checkRequestMethod('POST') ) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for A
    if (inpRequire($fname)) {
        $errors['name'] = "Name is required";
    } elseif (minVal($fname, 3)) {
        $errors['name'] = "Name must be greater than 3 chars";
    } elseif (maxVal($fname, 25)) {
        $errors['name'] = "Name must be smaller than 25 chars";
    }
    if (inpRequire($lname)) {
        $errors['name'] = "Name is required";
    } elseif (minVal($lname, 3)) {
        $errors['name'] = "Name must be greater than 3 chars";
    } elseif (maxVal($lname, 25)) {
        $errors['name'] = "Name must be smaller than 25 chars";
    }


    // for address
    if (inpRequire($address)) {
        $errors['address'] = "Address is required";
    } elseif (minVal($address, 3)) {
        $errors['address'] = "Address must be greater than 3 chars";
    } elseif (maxVal($address, 25)) {
        $errors['address'] = "Address must be smaller than 25 chars";
    }

    // for info
    if (inpRequire($info)) {
        $errors['info'] = "Info is required";
    } elseif (minVal($info, 10)) {
        $errors['info'] = "Info must be greater than 10 chars";
    } elseif (maxVal($info, 200)) {
        $errors['info'] = "Info must be smaller than 100 chars";
    }

    // for email
    if (inpRequire($email)) {
        $errors['email'] = "Email is required";
    } elseif (!emailValid($email)) {
        $errors['email'] = "please enter a valid email";
    }

    // for phone
    if (inpRequire($phone)) {
        $errors['phone'] = "Phone is required";
    } elseif (number($phone)) {
        $errors['phone'] = "please enter a valid phone";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $id = $_SESSION['auth']['id']+1;
        
        $total = 0;
        foreach (getSession("cart") as $key => $value) {
            if($value['sale']){
            $total += $value['price'] - (($value['price'] * $value['sale']) / 100);
            }else {
                $total += $value['price'];
            }
        }

        $sql = "INSERT INTO `orders` (`first_name`,`last_name`, `email`, `info`, `address`,`phone`,`user_id`,`total_price`,`order_number`) 
        VALUES ('$fname','$lname','$email','$info','$address','$phone','$id','$total','$randomString')";

        $result = mysqli_query($conn, $sql);
        $order_id = mysqli_insert_id($conn);

        if ($result) {
           
                $sql = "INSERT INTO `order_items` (`order_id`, `book_id`)
                VALUES ('$order_id','$key')";
                mysqli_query($conn, $sql);
            }
            $_SESSION['added-to-cart'] = "Your Order has been sent successfully";
            unset($_SESSION['cart']);
            redirect("shop");
        }
    }
    redirect("checkout");
