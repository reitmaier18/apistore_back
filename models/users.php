<?php
if (!class_exists('db')) {
    require('db.php');
}
class users
{
    public $id;
    public $user_name;
    public $user_email;
    public $role_id = 'null';
    public $user_password;

    public function __construct()
    {

    }

    public function find_user($id)
    {
        $db = new db();
        $query = "select 
                    id, 
                    user_name, 
                    user_email, 
                    role_id, 
                    user_password
                  from users
                  where id = $id";
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->user_name = $data['result'][0]->user_name;
        $this->user_email = $data['result'][0]->user_email;
        $this->role_id = $data['result'][0]->role_id;
        $this->user_password = $data['result'][0]->user_password;
    }

    public function validate_user($user_email, $user_password)
    {
        $db = new db();
        $query = "select 
                    id, 
                    user_name, 
                    user_email, 
                    role_id, 
                    user_password
                  from users
                  where user_email = '$user_email' AND user_password = '$user_password'";
        
        $data['result'] = $db->consult_query($query);
        $this->id = $data['result'][0]->id;
        $this->user_name = $data['result'][0]->user_name;
        $this->user_email = $data['result'][0]->user_email;
        $this->role_id = $data['result'][0]->role_id;
        $this->user_password = $data['result'][0]->user_password;
    }

    public function list_user()
    {
        $db = new db();
        $query = "select * from users";
        $data['result'] = $db->consult_query($query);
        if (is_array($data['result'])) 
        {
            foreach ($data['result'] as $key => $value) 
            {
                echo "<pre>";
                print_r($value);
                die();    
            }
        }
    }

    public function insert_user()
    {
        $db = new db();
        $query = "INSERT INTO `users`
                        (
                            user_name,
                            user_email,
                            user_password,
                            role_id
                        )
                        VALUES
                        (
                            '$this->user_name',
                            '$this->user_email',
                            '$this->user_password',
                            $this->role_id
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

    public function update_user()
    {
        $db = new db();
        $query = "UPDATE `users` SET
                        id = $this->id,
                        user_name = $this->user_name, 
                        user_email = $this->user_email, 
                        user_password = $this->user_password, 
                        role_id = $this->role_id
                    WHERE
                        id = $this->id
                    ";
        
        $db->update_query($query);
        return true;
    }

    public function delete_user()
    {
        $db = new db();
        $query = "UPDATE `users` SET
                        id = $this->id,
                        user_name = $this->user_name, 
                        user_email = $this->user_email, 
                        user_password = $this->user_password, 
                        role_id = 'null'
                    WHERE
                        id = $this->id
                    ";
        
        $db->update_query($query);
        return true;
        /*
        $db = new db();
        $query = "DELETE FROM `users` 
                    WHERE
                        id = $this->id
                    ";
        $db->update_query($query);
        return true;
        */
    }
}

?>