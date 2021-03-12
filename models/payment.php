<?php
if (!class_exists('db')) {
    require('db.php');
}

class payment
{
    public $id;
    public $base;
    public $tax;
    public $total;
    

    public function __construct()
    {

    }

    public function find_payment($id)
    {
        $db = new db();
        $query = "select 
                    id, 
                    base, 
                    tax, 
                    total
                  from payment
                  where id = $id";
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->base = $data['result'][0]->base;
        $this->tax = $data['result'][0]->tax;
        $this->total = $data['result'][0]->total;
        
    }

    public function list_payment($id)
    {
        $db = new db();
        $query = "select 
                    b.base, 
                    b.tax, 
                    b.total,
                    d.current_amount,
                    d.previous_amount,
                    d.id
                from shop_cart a 
                inner join payment b on a.payment_id = b.id 
                inner join users c on a.user_id = c.id 
                left join balance d on c.id = d.user_id
                where c.id = $id 
                and b.id is not null
                order by d.id asc";
        $data['result'] = $db->consult_query($query);
        return $data['result'];
    }

    public function insert_payment()
    {
        $db = new db();
        $query = "INSERT INTO `payment`
                        (
                            base, 
                            tax, 
                            total
                        ) 
                      VALUES 
                      (
                          $this->base,
                          $this->tax,
                          $this->total
                      )";
        $this->id = $db->insert_query($query);
        return true;
    }

    public function update_payment()
    {
        $db = new db();
        $query = "UPDATE `payment` SET
                        id = $this->id,
                        base = $this->base, 
                        tax = $this->tax, 
                        total = $this->total
                    WHERE
                        id = $this->id
                    ";
        
        $db->update_query($query);
        return true;
    }

    public function delete_payment()
    {
        $db = new db();
        $query = "DELETE FROM `payment` 
                    WHERE
                        id = $this->id
                    ";
        $db->update_query($query);
        return true;
    }

    public function history($id)
    {
        
    }
}

?>