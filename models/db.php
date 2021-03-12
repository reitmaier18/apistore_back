<?php
class db 
{
    private $data = array
    (
        'host' => '127.0.0.1',
        'port' => '3306',
        'user_name' => 'mysql',
        'password' => '123456',
        'dbname' => 'store_shop'
    );

    protected $connection;

    public function construct()
    {
        $this->connection = new mysqli
        (
            $this->data['host'], 
            $this->data['user_name'], 
            $this->data['password'], 
            $this->data['dbname']
        );

        if (mysqli_connect_errno()) 
        {
            echo mysqli_connect_error();
            die();
        }
    }
    
    public function consult_query($query)
    {
        $this->construct();
        $result = $this->connection->query($query);
        if ($result) 
        {
            $data = array();
            while($row = $result->fetch_object())
            {
                $data[] = $row;
            }

            $result->close();
            $this->connection->next_result();
            $this->destruct();
            return $data;
            
        }else
        {
            return null;
        }
    }

    public function insert_query($query)
    {
        $this->construct();
        $result = $this->connection->query($query);
        if ($result) 
        {
            $result = $this->connection->insert_id;
            $this->destruct();
            return $result;
        }else
        {
            $this->destruct();
            return false;
        }
    }

    public function update_query($query)
    {
        $this->construct();
        $result = $this->connection->query($query);
        if ($result) 
        {
            $this->destruct();
            return $result;
        }else
        {
            $this->destruct();
            echo "not function";
        }
    }

    public function destruct()
    {
        return $this->connection = null;
    }
}
?>