<?php

require_once '../../model/Database.php';

class Query extends Database
{
    protected $dbObject;

    /**
     * function getData() return aaray of result
     * 
     * @param $tableName contain table name of database 
     * @param $field contain string of fields which you want to fetch , by default it is '*' 
     * @param $conditionArr is array of condition
     * 
     * @return array of data which you want to fetch from databse  
     */
    public function getData($tableName, $field = '*', $conditionArr = array())
    {
        $dbObject = new Database();

        $sql = "SELECT $field FROM $tableName ";

        if (!empty($conditionArr)) {
            $sql .= "WHERE";

            foreach ($conditionArr as $key => $val) {
                $sql .= " $key = '$val' AND";
            }

            $sql = rtrim($sql, " AND");
        }

        $res = $dbObject->connect()->Query($sql);
        if ($res->num_rows > 0) {
            $arr = array();
            while ($row = $res->fetch_assoc()) {
                $arr[] = $row;
            }

            return $arr;
        } else {
            return 0;
        }
    }

     /**
     * function insertData() 
     * 
     * @param $tableName contain table name of database 
     * @param $data is the array of values which you want to insert
     * 
     * @return true or false
     */
    public function insertData($tableName, $data = array())
    {
        $dbObject = new Database();
        $sql = "INSERT INTO $tableName ";
        $fields = '';
        $values = '';
        foreach ($data as $key => $val) {
            $fields .= "$key , ";
            $values .= "'$val' , ";
        }

        $fields = rtrim($fields, ' , ');
        $values = rtrim($values, ' , ');

        $sql .= "($fields) VALUES ($values)";

        $res = $dbObject->connect()->Query($sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * function deleteData() 
     * 
     * @param $tableName contain table name of database 
     * @param $condition is the array of conditions
     * 
     * @return true or false
     */
    public function deleteData($tableName, $condition = array())
    {
        $dbObject = new Database();
        $sql = "DELETE FROM $tableName WHERE";

        foreach ($condition as $key => $val) {
            $sql .= " $key = '$val' AND";
        }

        $sql = rtrim($sql, 'AND');

        $res = $dbObject->connect()->query($sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * function updateData() 
     * 
     * @param $tableName contain table name of database 
     * @param $data is the array of values which you want to update
     * @param $condition is the array of conditions
     * 
     * @return true or false
     */
    public function updateData($tableName, $data = array(), $condition = array())
    {
        $dbObject = new Database();
        $sql = "UPDATE $tableName SET ";

        foreach ($data as $key => $val) {
            $sql .= " $key = '$val' ,";
        }

        $sql = rtrim($sql, ' ,');
        $sql .= " WHERE";

        foreach ($condition as $key => $val) {
            $sql .= " $key = '$val' AND";
        }
        $sql = rtrim($sql, " AND");

        $res = $dbObject->connect()->query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}
