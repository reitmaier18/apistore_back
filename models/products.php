<?php
if (!class_exists('db')) {
    require('db.php');
}

class products
{
    public $id;
    public $product_name;
    public $product_detail;
    public $product_price;
    public $tax;
    public $products_photo;
    

    public function __construct()
    {

    }

    public function find_products($id)
    {
        $db = new db();
        $query = "select 
                    id, 
                    product_name, 
                    product_detail, 
                    product_price, 
                    tax,
                    products_photo
                  from products
                  where id = $id";
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->product_name = $data['result'][0]->product_name;
        $this->product_detail = $data['result'][0]->product_detail;
        $this->product_price = $data['result'][0]->product_price;
        $this->tax = $data['result'][0]->tax;
        $this->products_photo = $data['result'][0]->products_photo;
    }

    public function list_products()
    {
        $db = new db();
        $query = "select * from products";
        $data['result'] = $db->consult_query($query);
        if (is_array($data['result'])) 
        {
            return $data['result'];
        }
    }

    public function insert_products()
    {
        $db = new db();
        $query = "INSERT INTO `products`
                        (
                            product_name, 
                            product_detail, 
                            product_price, 
                            tax,
                            products_photo
                        ) 
                      VALUES 
                      (
                          $this->product_name,
                          $this->product_detail,
                          $this->product_price,
                          $this->tax,
                          $this->products_photo,
                      )";
        $this->id = $db->insert_query($query);
        return true;
    }

    public function update_products()
    {
        $db = new db();
        $query = "UPDATE `products` SET
                        id = $this->id,
                        product_name = $this->product_name, 
                        product_detail = $this->product_detail, 
                        product_price = $this->product_price, 
                        tax = $this->tax,
                        products_photo = $this->products_photo
                    WHERE
                        id = $this->id
                    ";
        
        $db->update_query($query);
        return true;
    }

    public function delete_products()
    {
        $db = new db();
        $query = "DELETE FROM `products` 
                    WHERE
                        id = $this->id
                    ";
        $db->update_query($query);
        return true;
    }
}

?>