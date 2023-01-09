<?php

require_once 'Query.php';

class Hotel extends Query
{
    private $hotelName;
    private $hotelLocation;
    private $shortDesc;
    private $longDesc;
    private $rating;
    private $rooms;
    private $roomType;
    private $registerDate;
    private $smallPic;
    private $largePic;
    private $status;


    /**
     * function setVariables()
     * 
     * @param $POST is the object of form
     * @param $smallPic is the name of small image
     * @param $largePic is the name of small image
     * 
     * set the value of $hotelName,$hotelLocation,$shortDesc,$longDesc,$rating,$rooms,$roomType,$registerDate,$smallPic,$largePic,$status
     */
    public function setVariables($POST, $smallPic, $largePic)
    {
        $this->hotelName = htmlspecialchars($POST["hName"]);
        $this->hotelLocation = htmlspecialchars($POST["hLocation"]);
        $this->shortDesc = htmlspecialchars($POST["shortDesc"]);
        $this->longDesc = $POST["longDesc"];
        $this->rating = $POST["rating"];
        $this->rooms = htmlspecialchars($POST["rooms"]);
        $this->roomType = $POST["roomType"];
        $this->registerDate = $POST["registerDate"];
        $this->smallPic = $smallPic;
        $this->largePic = $largePic;
        $this->status = $POST["status"];
    }


    /**
     * function Validate()
     * 
     * verify the value of $hotelName,$hotelLocation,$shortDesc,$longDesc,$rating,$rooms,$roomType,$registerDate,$smallPic,$largePic,$status is not empty
     */
    private function validate()
    {
        if (empty($this->hotelName)) {
            return false;
        }
        if (empty($this->hotelLocation)) {
            return false;
        }
        if (empty($this->shortDesc)) {
            return false;
        }
        if (empty($this->longDesc)) {
            return false;
        }
        if (empty($this->rating)) {
            return false;
        }
        if (empty($this->rooms)) {
            return false;
        }
        if (empty($this->roomType)) {
            return false;
        }
        if (empty($this->registerDate)) {
            return false;
        }
        if (empty($this->smallPic)) {
            return false;
        }
        if (empty($this->largePic)) {
            return false;
        }
        if (empty($this->status)) {
            return false;
        }
        return true;
    }



    /**
     * function getHotels()
     * 
     * @param $field contain string of fields which you want to fetch , by default it is '*' 
     * @param $conditionArr is array of condition
     * 
     * @return array of data which you want to fetch from databse  
     */
    public function getHotels($field = '*', $conditionArr = array())
    {
        $queryObj = new Query();
        $data = $queryObj->getData("hotels", $field, $conditionArr);
        return $data;
    }


    /**
     * function insertHotel()
     * 
     * insert value of $hotelName,$hotelLocation,$shortDesc,$longDesc,$rating,$rooms,$roomType,$registerDate,$smallPic,$largePic,$status in the database
     * 
     * @return true or false;  
     */
    public function insertHotel()
    {
        $queryObj = new Query();

        $isValid = $this->validate();
        $inserted = false;
        if ($isValid) {
            $insertData = array(
                "hotel_location_id" => $this->hotelLocation,
                "hotel_title" => $this->hotelName,
                "short_desc" => $this->shortDesc,
                "long_desc" => $this->longDesc,
                "hotel_star" => $this->rating,
                "number_of_room" => $this->rooms,
                "room_type" => $this->roomType,
                "hotel_register_date" => $this->registerDate,
                "hotel_small_pic" => $this->smallPic,
                "hotel_large_pic" => $this->largePic,
                "status" => $this->status
            );

            $inserted = $queryObj->insertData("hotels", $insertData);
        }
        return $inserted;
    }


    /**
     * function updateHotel()
     * 
     * @param $editId is hotel_id which you want to update
     * update value of $hotelName,$hotelLocation,$shortDesc,$longDesc,$rating,$rooms,$roomType,$registerDate,$smallPic,$largePic,$status in the database
     * update the hotelData which id is $editId
     * 
     * @return true or false;  
     */
    public function updateHotel($editId)
    {
        $queryObj = new Query();

        $isValid = $this->validate();
        $updated = false;
        if ($isValid) {
            $updateData = array(
                "hotel_location_id" => $this->hotelLocation,
                "hotel_title" => $this->hotelName,
                "short_desc" => $this->shortDesc,
                "long_desc" => $this->longDesc,
                "hotel_star" => $this->rating,
                "number_of_room" => $this->rooms,
                "room_type" => $this->roomType,
                "hotel_register_date" => $this->registerDate,
                "hotel_small_pic" => $this->smallPic,
                "hotel_large_pic" => $this->largePic,
                "status" => $this->status
            );

            $updated = $queryObj->updateData("hotels", $updateData, ["hotel_id" => $editId]);
        }
        return $updated;
    }


    /**
     * function deleteHotel()
     * 
     * @param $deleteId is hotel_id which you want to delete
     * 
     * delete the hotelData which id is $deleteId
     * 
     * @return true or false;  
     */
    public function deleteHotel($delId)
    {
        $queryObj = new Query();

        $deleted = $queryObj->deleteData("hotels", ["hotel_id" => $delId]);
        return $deleted;
    }
}
