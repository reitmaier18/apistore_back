<?php
if (!class_exists('db')) 
{
    require('db.php');
}

class shop_cart
{
    public $id;
    public $user_id;
    public $product_id;
    public $payment_id = 'null';
    public $shipping_id = 'null';
    

    public function __construct()
    {

    }

    public function find_shop_cart($id)
    {
        $db = new db();
        $query = "select 
                    id, 
                    user_id, 
                    product_id, 
                    payment_id,
                    shipping_id
                  from shop_cart
                  where id = $id";
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->user_id = $data['result'][0]->user_id;
        $this->product_id = $data['result'][0]->product_id;
        $this->payment_id = $data['result'][0]->payment_id;
        $this->shipping_id = $data['result'][0]->shipping_id;
    }

    public function list_shop_cart($id)
    {
        $db = new db();
        $query = "select 
                        id, 
                        user_id, 
                        product_id, 
                        payment_id,
                        shipping_id
                    from shop_cart
                    where user_id = $id and payment_id is null";
                    
        $data['result'] = $db->consult_query($query);
        if (is_array($data['result'])) 
        {
            return $data['result'];
        }
    }

    public function list_shop($id)
    {
        $db = new db();
        $query = "select 
                        a.id, 
                        b.product_name, 
                        b.product_price, 
                        b.tax, 
                        c.shipping_name, 
                        c.shipping_price
                    from shop_cart a 
                    left join products b on a.product_id = b.id 
                    left join shipping c on a.shipping_id = c.id 
                    left join users d on a.user_id = d.id 
                    where a.user_id = $id and a.payment_id is null";
        $data['result'] = $db->consult_query($query);
        if (is_array($data['result'])) 
        {
            return $data['result'];
        }
    }

    public function insert_shop_cart()
    {
        $db = new db();
        $query = "INSERT INTO `shop_cart`
                        (
                            user_id, 
                            product_id, 
                            payment_id,
                            shipping_id
                        ) 
                      VALUES 
                      (
                          $this->user_id,
                          $this->product_id,
                          $this->payment_id,
                          $this->shipping_id
                      )";
        
        $this->id = $db->insert_query($query);
        return true;
    }

    public function update_shop_cart()
    {
        $db = new db();
        $query = "UPDATE `shop_cart` SET
                        id = $this->id,
                        user_id = $this->user_id, 
                        product_id = $this->product_id, 
                        payment_id = $this->payment_id,
                        shipping_id = $this->shipping_id
                    WHERE
                        id = $this->id
                    ";
        
        $db->update_query($query);
        return true;
    }

    public function delete_shop_cart()
    {
        $db = new db();
        $query = "DELETE FROM `shop_cart` 
                    WHERE
                        id = $this->id
                    ";
        $db->update_query($query);
        return true;
    }

    public function list_shop_cart_count($id)
    {
        $db = new db();
        $query = "select 
                    a.product_id, 
                    COUNT(*) as quantity, 
                    b.product_name 
                from shop_cart a
                inner join products b on a.product_id=b.id
                where user_id = $id
                and payment_id is null
                group by product_id";
        $data['result'] = $db->consult_query($query);
        return $data['result'];
    }
}

?>