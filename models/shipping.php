<?php
if (!class_exists('db')) {
    require('db.php');
}

class shipping
{
    public $id;
    public $shipping_name;
    public $shipping_price;
    

    public function __construct()
    {

    }

    public function find_shipping($id)
    {
        $db = new db();
        $query = "select 
                    id, 
                    shipping_name, 
                    shipping_price, 
                  from shipping
                  where id = $id";
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->shipping_name = $data['result'][0]->shipping_name;
        $this->shipping_price = $data['result'][0]->shipping_price;
    }

    public function list_shipping()
    {
        $db = new db();
        $query = "select * from shipping";
        $data['result'] = $db->consult_query($query);
        if (is_array($data['result'])) 
        {
            return $data['result'];
        }
    }

    public function insert_shipping()
    {
        $db = new db();
        $query = "INSERT INTO `shipping`
                        (
                            shipping_name, 
                            shipping_price
                        ) 
                      VALUES 
                      (
                          $this->shipping_name,
                          $this->shipping_price
                      )";
        $this->id = $db->insert_query($query);
        return true;
    }

    public function update_shipping()
    {
        $db = new db();
        $query = "UPDATE `shipping` SET
                        id = $this->id,
                        shipping_name = $this->shipping_name, 
                        shipping_price = $this->shipping_price
                    WHERE
                        id = $this->id
                    ";
        
        $db->update_query($query);
        return true;
    }

    public function delete_shipping()
    {
        $db = new db();
        $query = "DELETE FROM `shipping` 
                    WHERE
                        id = $this->id
                    ";
        $db->update_query($query);
        return true;
    }
}

?>