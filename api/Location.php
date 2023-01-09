<?php

require_once 'Query.php';

class Location extends Query
{
    private $locationName;
    private $locationCity;
    private $locationState;

    private $queryObj;

    /**
     * function setVariables()
     * 
     * @param $POST is the object of form
     * 
     * set the value of $locationName,$locationCity,LocationState
     */
    public function setVariables($POST)
    {
        extract($POST);
        $this->locationName = $locationName;
        $this->locationCity = $locationCity;
        $this->locationState = $locationState;
    }

    /**
     * function Validate()
     * 
     * verify the value of $locationName,$locationCity,$LocationState is not empty
     */
    public function validate()
    {
        $isValid = true;

        if (empty($this->locationName)) {
            return false;
        }
        if (empty($this->locationCity)) {
            return false;
        }
        if (empty($this->locationState)) {
            return false;
        }
        return true;
    }



    /**
     * function getLocations()
     * 
     * @param $field contain string of fields which you want to fetch , by default it is '*' 
     * @param $conditionArr is array of condition
     * 
     * @return array of data which you want to fetch from databse  
     */
    public function getLocations($field = '*', $conditionArr = array())
    {
        $queryObj = new Query();
        $data = $queryObj->getData("locations", $field, $conditionArr);
        return $data;
    }


    /**
     * function insertLocation()
     * 
     * insert value of $locationName.$locationCity,$locationState in the database
     * 
     * @return true or false;  
     */
    public function insertLocation()
    {
        $queryObj = new Query();
        $isValid = $this->validate();
        $inserted = false;
        if ($isValid) {
            $data = array(
                "location_name" => $this->locationName,
                "location_city" => $this->locationCity,
                "location_state" => $this->locationState
            );
            $inserted = $queryObj->insertData("locations", $data);
        }

        return $inserted;
    }




    /**
     * function updateLocation()
     * 
     * @param $editId is location_id which you want to update
     * update value of $locationName.$locationCity,$locationState in the database
     * update the locationData which id is $editId
     * 
     * @return true or false;  
     */
    public function updateLocation($editId)
    {
        $queryObj = new Query();
        $isValid = $this->validate();
        $updated = false;
        if ($isValid) {
            $data = array(
                "location_name" => $this->locationName,
                "location_city" => $this->locationCity,
                "location_state" => $this->locationState
            );

            $updated = $queryObj->updateData("locations", $data, ["location_id" => $editId]);
        }
        return $updated;
    }

    /**
     * function deleteLocation()
     * 
     * @param $deleteId is location_id which you want to delete
     * 
     * delete the locationData which id is $deleteId
     * 
     * @return true or false;  
     */
    public function deleteLocation($deleteId)
    {
        $queryObj = new Query();
        $deleted = $queryObj->deleteData("locations", ["location_id" => $deleteId]);
        return $deleted;
    }
}
