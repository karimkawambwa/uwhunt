<?php
/*
 * Created by Karim Kawambwa using PhpStorm.
 * User: kayr1m
 * Date: 11/17/13
 * Time: 12:00 AM
 */

include_once 'lib/Database.php';
include_once 'objects/Student.php';
include_once 'objects/StudentInfo.php';
include_once 'functions/Mail.php';

class HouseDao extends Database {

    function __construct()
    {
        parent::__construct();
    }

    /*
     * PUBLIC FUNCTIONS
     */
    public function addHouseOwnerToDB($owner){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("INSERT INTO House_Owner(owner_name, owner_email, phone_number)
                                            VALUES(:oname, :oemail , :phone)");

            $stmt->execute( array(":oname"=>$owner->owner_name,
                ":oemail" => $owner->owner_email,
                ":phone" => $owner->phone_number
            ));

            return $dbConnection->lastInsertId();

        } catch(PDOException $e) {
            error_log( 'Error creating owner: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 5005;
        }
    }

    public function addHouseToDB($house){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("INSERT INTO House( owner_id,
            country, city, province, postal_code,full_address, occupant_capacity,
            date_added, rent_price, last_edited)
            VALUES( :owner_id, :country, :city, :province, :postal_code,
            :full_address, :occupant_capacity, :date_added, :rent_price, :last_edited)");

            $stmt->execute( array(":owner_id"=>$house->owner_id,
                ":country"=>$house->country,
                ":city"=>$house->city,
                ":province"=> $house->province,
                ":postal_code"=>$house->postal_code,
                ":full_address"=>$house->full_address,
                ":occupant_capacity"=>$house->occupant_capacity,
                ":date_added"=>$house->date_added,
                ":rent_price"=>$house->rent_price,
                ":last_edited"=>$house->last_edited
            ));

            return $dbConnection->lastInsertId();

        } catch(PDOException $e) {
            error_log( 'Error creating house: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 5002;
        }
    }

    public function uploadHousePicture($image, $house_id){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("INSERT INTO House_Image(house_id, image_name) VALUES(:id, :name)");
            $stmt1 = $dbConnection->prepare("UPDATE House_Image SET thumbnail_url = :thumb_url , image_url = :image_url
                                            WHERE image_id = :id");

            $stmt->execute( array(":id"=> $house_id,
                ":name"=> $image->image_name
            ));

            //get the last automatically generated ID
            $lastId = $dbConnection->lastInsertId();

            $structure = 'upload/houses/house_'.$house_id;

            if (!is_dir($structure)) {
                if (mkdir($structure, 0, true)) {
//                    if( chmod($structure, 0777) ) { //change permissons
//                        //chmod($path, 0755);
//                    }
//                    else{
//                        return 5007;
//                    }

                }else{
                    error_log( 'Failed to create folder with path '. $structure,
                        1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;

                    //die('Failed to create folder with path '. $structure);

                    return 5007;
                }
            }

            if (!is_writable($structure))
            {
                if( chmod($structure, 0777) ) { //change permissons
                    //chmod($path, 0755);
                }
                else{
                    return 5007;
                }
            }

            // move the temporarily stored file to a convenient location
            // your photo is automatically saved by PHP in a temp folder
            // you need to move it over yourself to your own "upload" folder
            if (move_uploaded_file($image->image['tmp_name'], $structure."/".$lastId.".jpg")) {
                //file moved, all good, generate thumbnail
                $this->thumb($structure."/".$lastId.".jpg", 180);

                $return['thumbnail_url'] = 'http://chataloo-hunt.com/uwhunt/backend/'.$structure.'/'.$lastId.'-thumb.jpg';
                $return['image_url'] = 'http://chataloo-hunt.com/uwhunt/backend/'. $structure.'/'.$lastId.'.jpg';

                $stmt1->execute( array(":id"=> $lastId,
                    ":thumb_url"=> $return['thumbnail_url'],
                    ":image_url"=>  $return['image_url']
                ));

                return 5010;
            }else{
                return 5007;
            }

        } catch(PDOException $e) {
            error_log( 'Error upload database problem: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 5007;
        }
    }

    //loads up the source image, resizes it and saves with -thumb in the file name
    function thumb($srcFile, $sideInPx) {

        $image = imagecreatefromjpeg($srcFile);
        $width = imagesx($image);
        $height = imagesy($image);

        $thumb = imagecreatetruecolor($sideInPx, $sideInPx);

        imagecopyresized($thumb,$image,0,0,0,0,$sideInPx,$sideInPx,$width,$height);

        imagejpeg($thumb, str_replace(".jpg","-thumb.jpg",$srcFile), 85);

        imagedestroy($thumb);
        imagedestroy($image);
    }

    public function addCompanyToDB($company){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("INSERT INTO Company( name, city, country, full_address, postal_code )
            VALUES(:name, :city, :country, :full_address, :postal_code )");

            $stmt->execute( array(  ":name"         =>  $company->name,
                ":city"         =>  $company->city,
                ":country"      =>  $company->country,
                ":full_address" =>  $company->full_address,
                ":postal_code"  =>  $company->postal_code
            ));

            return $dbConnection->lastInsertId();

        } catch(PDOException $e) {
            error_log( 'Error adding company to db: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 5008;
        }
    }

    public function createEmploymentLink($house_id, $company_id, $student_id, $employment){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("INSERT INTO Employment( student_id, house_id, company_id, position, start_date , end_date) VALUES(:student_id, :house_id, :company_id, :position, :start_date , :end_date)");

            $stmt->execute( array(":student_id"   =>  $student_id,
                ":house_id"     =>  $house_id,
                ":company_id"   =>  $company_id,
                ":position"     =>  "dev",//$employment->position,
                ":start_date"   =>  null,//$employment->start_date,
                ":end_date"     =>  null//$employment->end_date
            ));

            return $dbConnection->lastInsertId();

        } catch(PDOException $e) {
            error_log( 'Error creating employment link: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 5009;
        }
    }

    public function addHashTagsAndMentions($houseExtra)
    {
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
//            public $house_description;
//            public $house_mentions;
//            public $house_hash_tags;
            $checkHashTag = $dbConnection->prepare("SELECT * FROM Hash_Tags WHERE the_hash_tag = :h_t");
            $checkMention = $dbConnection->prepare("SELECT * FROM Mentions WHERE the_mention LIKE = :h_m");

            $hashtags = $dbConnection->prepare("INSERT INTO Hash_Tags( the_hash_tag, hash_tag_url)
            VALUES(:the_hash, :hash_url)");
            $mentions = $dbConnection->prepare("INSERT INTO Mentions( the_mention, mention_url)
            VALUES( :the_mention, :mention_url)");
            
            $houseTags = $dbConnection->prepare("INSERT INTO House_Tags( hash_tag_id, house_id) VALUES(:h_id, :house_id)");
            $houseMentions = $dbConnection->prepare("INSERT INTO House_Mentions( mention_id, house_id) VALUES( :m_id, :house_id)");

            $url = "http://chataloo-hunt.com/uwhunt/backend/Request.php?request=search_by_hash&the_hash=";
           
            if (!is_array($houseExtra->house_hash_tags)
            &&$houseExtra->house_hash_tags != null)
            	return 5012;
            
			else if ($houseExtra->house_hash_tags != null)
            foreach ($houseExtra->house_hash_tags as $h_t)
            {
                //Check if a similar hashtag exists
                $checkHashTag->execute(array(':h_t'=> $h_t));
                $result = $checkHashTag->fetch();
                if ($checkHashTag->rowCount() > 0)
                {
                    //use id of existing hashtag
                   // $houseTags->execute( array(":h_id"   =>  $result['hash_tag_id'],
                  //                            ":house_id" =>  $houseExtra->house_id
                   // ));
                    
                }else{
                    //if hashtag doesn't exist, add it
                    $hashtags->execute( array(":the_hash"   =>  $h_t,
                                              ":hash_url"   =>  $url.$h_t
                    ));
                    
                    $houseTags->execute( array(":h_id"=> $dbConnection->lastInsertId(),
                                              ":house_id"=> $houseExtra->house_id
                    ));
                }
            }
            
            if (!is_array($houseExtra->house_mentions) 
            && $houseExtra->house_mentions != null)
            	return 5012;
			else if ($houseExtra->house_mentions != null)
            foreach ($houseExtra->house_mentions as $h_m)
            {
                //Check if a similar Mention exists
                $checkMention->execute(array(':h_m'=> $h_m));
                $result = $checkMention->fetch();
                if ($checkMention->rowCount() > 0)
                {
                    //use id of existing mention
                   // $houseMentions->execute( array(":m_id" 
                    						//		=> $result['mention_id'],
                                            //  ":house_id" =>  $houseExtra->house_id
                   // ));
                }else{
                    //if mention doesn't exist, add it
                    $stmt->execute( array(":the_mention"   =>  $h_m,
                                          ":mention_url"   =>  $url.$h_m
                    ));
                    
                    $houseMentions->execute( array(":m_id"
                    							=>$dbConnection->lastInsertId(),
                                              ":house_id" =>  $houseExtra->house_id
                    ));
                }
            }

            return 5013;

        } catch(PDOException $e) {
            error_log( 'Error adding hashtags and mentions: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 5012;
        }
    }

    public function addDescription($houseExtra){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("INSERT INTO House_Extra( house_id, house_description)
            VALUES(:h_id, :h_d)");


            $stmt->execute( array(":h_id"   =>  $houseExtra->house_id,
                                  ":h_d"   =>  $houseExtra->house_description
            ));

            return 5015;


        } catch(PDOException $e) {
            error_log( 'Error adding house description: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 5014;
        }
    }


}
?>