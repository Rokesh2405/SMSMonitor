<?php

function generateRandomString($length = 4) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



class Form{
 
    // database connection and table name
    private $conn;
    private $table_name = "register";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

function create(){

     $ip=$_SERVER['REMOTE_ADDR'];
    // query to insert record
   $query = "UPDATE `register`
            SET
                ip='".$ip."', address='".$this->address."',age='".$this->age."',gender='".$this->gender."',state='".$this->state."',city='".$this->city."',name='".$this->name."', emailid='".$this->emailid."',mobileno='".$this->mobileno."' WHERE `id`='".$this->registerid."' ";

    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
          $this->age=htmlspecialchars(strip_tags($this->age));  
    $this->gender=htmlspecialchars(strip_tags($this->gender));  
    $this->state=htmlspecialchars(strip_tags($this->state));  
    $this->city=htmlspecialchars(strip_tags($this->city)); 
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->mobileno=htmlspecialchars(strip_tags($this->mobileno));
    $this->emailid=htmlspecialchars(strip_tags($this->emailid));
  $this->registerid=htmlspecialchars(strip_tags($this->registerid));
    // execute query
    if($stmt->execute()){
        //$registerid = $this->conn->lastInsertId();
        return true;
    }
 
    return false;
     
}

function mediaregister(){

     $ip=$_SERVER['REMOTE_ADDR'];
    // query to insert record
   $query = "INSERT INTO `register`
            SET
                ip='".$ip."',type='".$this->type."', facebookid='".$this->facebookid."', name='".$this->name."', emailid='".$this->emailid."',token='".$this->token."' ";

    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
     $this->type=htmlspecialchars(strip_tags(type));
    $this->facebookid=htmlspecialchars(strip_tags($this->facebookid));
     $this->name=htmlspecialchars(strip_tags($this->name));
    $this->token=htmlspecialchars(strip_tags($this->token));
    $this->emailid=htmlspecialchars(strip_tags($this->emailid));
    // execute query
    if($stmt->execute()){
        $registerid = $this->conn->lastInsertId();
        return $registerid;
    }
 
    return false;
     
}

function updatemediaregister(){

     $ip=$_SERVER['REMOTE_ADDR'];
    // query to insert record
   $query = "UPDATE `register`
            SET
                type='".$this->type."', facebookid='".$this->facebookid."', name='".$this->name."', emailid='".$this->emailid."' WHERE id='".$this->regid."' ";

    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
     $this->type=htmlspecialchars(strip_tags(type));
    $this->facebookid=htmlspecialchars(strip_tags($this->facebookid));
     $this->name=htmlspecialchars(strip_tags($this->name));
    $this->token=htmlspecialchars(strip_tags($this->token));
    $this->emailid=htmlspecialchars(strip_tags($this->emailid));
       $this->regid=htmlspecialchars(strip_tags($this->regid));
    // execute query
    if($stmt->execute()){
       
        return true;
    }
 
    return false;
     
}


}
