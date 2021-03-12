<?php
require '../models/products.php';
header('Access-Control-Allow-Origin: *');
if ($_GET) {
    switch ($_GET['action']) {
        case 'list_product':
            $product = new products();
            $result = $product->list_products();
            break;
        
        default:
            # code...
            break;
    }
}
echo json_encode($result);

?>