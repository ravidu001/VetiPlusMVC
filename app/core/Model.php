<?php
// common functions
trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];


    // this function is used to get all data from the table
    
    public function findAll()
    {

        $query = "Select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        return $this->query($query);
    }


    // this function is used to get all data from the table. where is used to filter the data
    public function where($data, $data_not = [])
    { // sample parameter: ['id' => 1, 'name' => 'John']
        $keys = array_keys($data); // get the keys of the array
        $key_not = array_keys($data_not); // get the keys of the array

        $query = "Select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . "= :" . $key . " && ";
        }

        foreach ($key_not as $key) { // this is for not equal to condition
            $query .= $key . "!= :" . $key . " && ";
        }

        $query = trim($query, " && "); // remove the last '&&' from the query

        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        //echo $query; // this will output: Select * from user where id = :id && name = :name limit 10 offset 0
        return $this->query($query, $data);
    }


    // this function is used to get the first row of the query
    public function first($data, $data_not = [])
    {  // sample return: ['id' => 1, 'name' => 'John']

        $keys = array_keys($data); // get the keys of the array
        $key_not = array_keys($data_not); // get the keys of the array

        $query = "Select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . "= :" . $key . " && ";
        }

        foreach ($key_not as $key) {
            $query .= $key . "!= :" . $key . " && ";
        }

        $query = trim($query, " && "); // remove the last '&&' from the query

        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        $result =  $this->query($query, $data);

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        // remove unwanted data from the array
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data); // get the keys of the array

        // implode the keys with a comma.implode used to convert array to string
        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        $this->query($query, $data);

        return false;
    }

    public function update($id, $data, $id_column = 'id')
    { // why $id_column = 'id'? because the default column name for id is 'id'
        // sample parameter: ['id' => 1, 'name' => 'John'], ['id' => 1]  

        // remove unwanted data from the array
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data); // get the keys of the array

        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . "= :" . $key . ", ";
        }

        $query = trim($query, ", "); // remove the last '&&' from the query

        $query .= " where $id_column = :$id_column";

        $data[$id_column] = $id;

        // echo $query; // this will output: Select * from user where id = :id && name = :name limit 10 offset 0
         $this->query($query, $data); 

        return false;
    }

    public function delete($id, $id_column = 'id')
    { // why $id_column = 'id'? because the default column name for id is 'id'
        $data[$id_column] = $id; // set the id to the data array

        $query = "delete from $this->table where $id_column = :$id_column";
        // echo $query; // this will output: Select * from user where id = :id && name = :name limit 10 offset 0
        $this->query($query, $data);

        return false;
    }

    //delete a one  data in a row  in a one colunm
    public function deleteOne($id, $column_to_delete, $id_column = 'id')
    {
        // set the id to the data array
        $data[$id_column] = $id; 
        // set the column to NULL (or any value you prefer)
        $data[$column_to_delete] = null; 

        // Update the column to NULL (or another value) in the specified row
        $query = "UPDATE $this->table SET $column_to_delete = :$column_to_delete WHERE $id_column = :$id_column";
        $this->query($query, $data);

        return true; // Indicate success
    }


    public function getCount()
    {
        $query = "SELECT COUNT(*) as count FROM $this->table";
        $result = $this->query($query);
        return $result[0]->count;  // the result is an array of objects and 'count' is a field
    }
}
