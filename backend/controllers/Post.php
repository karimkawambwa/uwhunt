<?php
/**
 * Created by Karim Kawambwa by using PhpStorm.
 * User: kayr1m
 * Date: 11/17/13
 * Time: 10:48 AM
 */

include_once 'dao/HouseDao.php';
include_once 'objects/Employment.php';

class Post {
    public $houseImage ;
    public $workPlace;
    public $house;
    public $houseExtra;
    public $owner ;
    public $employment;
    public $houseDao;

    function __construct($obj)
    {
        $this->houseImage = $obj['hi'];
        $this->house = $obj['h'];
        $this->owner = $obj['o'];
        $this->workPlace = $obj['w'];
        $this->houseExtra = $obj['he'];

        $this->houseDao = new HouseDao();
    }

    public function beginHousePostFlow(){

        if ($this->house == null && $this->workPlace == null && $this->owner == null)
            return 5004;


        if (!$this->createOwner()) return 5005; //step 1

        if (!$this->createHouse($this->owner->owner_id)) return 5006; //step 2

        if ($this->houseImage->image != null){
            if (!$this->saveHouseImage($this->house->house_id)) return 5007; //step 3
        }

        if (!$this->createCompany()) return 5008; //step 4

        if (!$this->newEmployment()) return 5009; //step 5

        // Successfully completed posting the house
        // steps 1, 2, 3, 4 and 5 have been executed with no error

        if (!$this->uploadTagsAndMentions($this->house->house_id)) return 5012; //step 6
        if (!$this->uploadDescription($this->house->house_id)) return 5014; //step 7

        return 5011;

    }

    private function uploadDescription()
    {
        $return = $this->houseDao->addDescription($this->houseExtra);
        if ($return != 5014) {
          //  $this->house->house_id = $return;
            return true;
        }
        return false;
    }

    private function uploadTagsAndMentions($id)
    {
        $this->houseExtra->house_id = $id;
        $return = $this->houseDao->addHashTagsAndMentions($this->houseExtra);
        if ($return != 5012) {
           // $this->house->house_id = $return;
            return true;
        }
        return false;
    }

    private function createHouse($id)
    {
        $this->house->owner_id = $id;
        $return = $this->houseDao->addHouseToDB($this->house);
        if ($return != 5002) {
            $this->house->house_id = $return;
            return true;
        }
        return false;
    }

    private function createOwner()
    {
        $return = $this->houseDao->addHouseOwnerToDB($this->owner);
        if ($return != 5005) {
            $this->owner->owner_id= $return;
            return true;
        }
        return false;
    }

    private function saveHouseImage($id)
    {
        $return = $this->houseDao->uploadHousePicture($this->houseImage, $id);
        if ($return != 5007) {
            //
            return true;
        }
        return false;
    }

    private function createCompany()
    {
        $return = $this->houseDao->addCompanyToDB($this->workPlace);
        if ($return != 5008) {
            $this->workPlace->company_id = $return;
            return true;
        }
        return false;
    }

    private function newEmployment()
    {//
    
    if (!isset($_GET['dev']))
        $return = $this->houseDao->createEmploymentLink($this->house->house_id, $this->owner->owner_id, $_SESSION['studentId'], null);
        
        else
        $return = $this->houseDao->createEmploymentLink($this->house->house_id, $this->owner->owner_id, $_GET['dev'], null);
        
        if ($return != 5009) {

            $this->workPlace->company_id = $return;
            return true;
        }

        return false;
    }

}

?>