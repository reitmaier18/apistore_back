<?php
require '../models/products.php';
require '../models/users.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');



if ($_GET) {
    switch ($_GET['action']) {
        case 'list_product':
            list_product();
            break;
        case 'edit_product':
            edit_product();
            break;
        case 'insert_product':
            insert_product();
            break;
        case 'delete_product':
            delete_product();
            break;
        case 'login':
            login();
            break;
        default:
            $result = null;
            echo json_encode($result);
            return;
            break;
    }
}

function list_product(){
    $product = new products();
    $result = $product->list_products();
    echo json_encode($result);
    return;
}

function edit_product(){
    $product = new products();
    if (isset($_POST['id'])) {
        $product->id = $_POST['id'];
        $product->product_name = $_POST['name'];
        $product->product_detail = $_POST['detail'];
        $product->product_price = $_POST['price'];
        $product->tax = $_POST['tax'];
        if (isset($_POST['photo'])) {
            $product->products_photo = $_POST['photo'];
        }
        $result = $product->update_products();
        echo json_encode($result);
        return;
    }
    if (isset($_GET['id'])) {
        $product->find_products($_GET['id']);    
        $result = $product;
        echo json_encode($result);
        return;
    }
    else{
        $result = null;    
        echo json_encode($result);
        return;
    }
}

function insert_product(){
    $product = new products();
    if (isset($_POST['id'])) {
        $product->id = $_POST['id'];
        $product->product_name = $_POST['name'];
        $product->product_detail = $_POST['detail'];
        $product->product_price = $_POST['price'];
        $product->tax = $_POST['tax'];
        if (isset($_POST['photo'])) {
            $product->products_photo = $_POST['photo'];
        }
        $product->insert_products();
        if ($product->id!=null) {
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
        }
        return;
    }else{
        echo json_encode(false);
        return;
    }
}

function delete_product(){
    $product = new products();
    if (isset($_POST['id'])) {
        $product->id = $_POST['id'];
        $result = $product->delete_products();
        echo json_encode($result);
        return;
    }else{
        echo json_encode(false);
        return;
    }
}

function login(){
    $user = new users();
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $user->validate_user($_POST['email'], $_POST['password']);
        echo json_encode($user);
    }
}
?>