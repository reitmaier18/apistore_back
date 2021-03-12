<?php
if (!class_exists('db')) {
    require('db.php');
}
class balance
{
    public $id;
    public $user_id;
    public $current_amount = 100;
    public $previous_amount = 0;

    public function __construct()
    {

    }

    public function find_balance($id)
    {
        $db = new db();
        $query = "select 
                    id, 
                    user_id, 
                    current_amount,
                    previous_amount
                  from balance
                  where id = $id";
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->user_id = $data['result'][0]->user_id;
        $this->current_amount = $data['result'][0]->current_amount;
        $this->previous_amount = $data['result'][0]->previous_amount;
    }

    public function find_last_balance($id)
    {
        $db = new db();
        $query = "select
                    id, 
                    user_id, 
                    current_amount,
                    previous_amount
                  from balance
                  where user_id = $id
                  order by id desc
                  limit 1
                  ";
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->user_id = $data['result'][0]->user_id;
        $this->current_amount = $data['result'][0]->current_amount;
        $this->previous_amount = $data['result'][0]->previous_amount;
    }

    public function list_balance($id)
    {
        $db = new db();
        $query = "select * from balance where user_id = $id";
        $data['result'] = $db->consult_query($query);
        if (is_array($data['result'])) 
        {
            return $data['result'];
        }
    }

    public function insert_balance()
    {
        $db = new db();
        $query = "INSERT INTO `balance`
                        (
                            user_id,
                            current_amount,
                            previous_amount
                        )
                        VALUES
                        (
                            $this->user_id,
                            $this->current_amount,
                            $this->previous_amount
                        )";
        $this->id = $db->insert_query($query);
        if ($this->id) 
        {
            return true;    
        }
        else
        {
            return false;
        }
        
    }

    public function update_balance()
    {
        $db = new db();
        $query = "UPDATE `balance` SET
                        id = $this->id,
                        user_id = $this->user_id, 
                        current_amount = $current_amount,
                        previous_amount = $previous_amount
                    WHERE
                        id = $this->id
                    ";
        
        $db->update_query($query);
        return true;
    }

    public function delete_balance()
    {
        $db = new db();
        
        
        $query = "DELETE FROM `balance` 
                    WHERE
                        id = $this->id
                    ";
        $db->update_query($query);
        return true;
        
    }
}

?>