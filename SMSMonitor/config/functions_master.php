<?php

// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);

function delorder($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
        $get = $db->prepare("DELETE FROM `orders` WHERE `id` = ? ");
        $get->execute(array($c));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}

function getunitprice($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `unitprice` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function getquote($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `quote` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}


function getcustom($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `custom` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}


function getorder($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `orders` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}


function addnotification($type,$comment,$getid,$registerid)
{
      global $db;
$orderdetails = FETCH_all("SELECT * FROM `onlinekit` WHERE `id`=?", $getid);
$prodetails = FETCH_all("SELECT * FROM `product` WHERE `id`=?", $orderdetails['productid']);
                
$resa = $db->prepare("INSERT INTO `notification` (`orderid`,`orderstatus`,`proname`,`proimage`,`qty`,`totprice`,`registerid`,`userid`,`type`,`comment`, `complaintid`,`createdby`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($orderdetails['orderid'],$orderdetails['orderstatus'],$prodetails['english_product'],$prodetails['image'],$orderdetails['qty'],$orderdetails['totprice'],$registerid,$_SESSION['VEGID'],$type,$comment,$getid, $_SESSION['VEGID']));
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';

}

function getbanner($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `banner` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function addbanner($name,$image,$status, $getid) {
    global $db;
    if ($getid == '') {
        $link22 = FETCH_all("SELECT * FROM `banner` WHERE `name`=? AND `createdby`=?", $name,$_SESSION['VEGID']);
        if ($link22['id'] == '') {

            $resa = $db->prepare("INSERT INTO `banner` (`name`, `image`,`status`, `ip`, `createdby`,`userid`) VALUES(?,?,?,?,?,?)");
            $resa->execute(array($name,$image,$status, $ip, $_SESSION['VEGID'],$_SESSION['VEGID']));
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Banner Name already exists!</h4></div>';
        }
    } else {
        $link22 = FETCH_all("SELECT * FROM `banner` WHERE `name`=? AND `id`!=? AND `createdby`=?", $name,$getid ,$_SESSION['VEGID']);
        if ($link22['id'] == '') {
            
      
            $resa = $db->prepare("UPDATE `banner` SET `name`=?, `image`=?,`status`=?, `ip`=? WHERE `id`=?");
            $resa->execute(array(trim($name), trim($image), trim($status), trim($ip),  $getid));

            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Banner Name already exists!</h4></div>';
        }
    }
    return $res;
}

function delbanner($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
        $get = $db->prepare("DELETE FROM `banner` WHERE `id` = ? ");
        $get->execute(array($c));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}



function getcategory($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `category` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}



function addcategory($category,$image,$status,$order,$ip,$getid) {
    global $db;
    if ($getid == '') {
        $link22 = FETCH_all("SELECT * FROM `category` WHERE `category`=?", $category);
        if ($link22['id'] == '') {

            $resa = $db->prepare("INSERT INTO `category` (`category`, `image`, `order`,`status`, `ip`) VALUES(?,?,?,?,?)");
            $resa->execute(array($category,$image,$order,$status, $ip));
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Category Name already exists!</h4></div>';
        }
    } else {
        $link22 = FETCH_all("SELECT * FROM `category` WHERE `category`=? AND `id`!=? ", $category,$getid);
        if ($link22['id'] == '') {
            
      
            $resa = $db->prepare("UPDATE `category` SET `category`=?, `image`=?,`order`=?, `status`=?, `ip`=? WHERE `id`=?");
            $resa->execute(array(trim($category), trim($image), trim($order), trim($status), trim($ip),  $getid));

            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Category Name already exists!</h4></div>';
        }
    }
    return $res;
}

function delcategory($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
        $get = $db->prepare("DELETE FROM `category` WHERE `id` = ? ");
        $get->execute(array($c));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}
function getarea($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `area` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function addarea($area,$status,$ip,$getid) {
    global $db;
    if ($getid == '') {
        $link22 = FETCH_all("SELECT * FROM `area` WHERE `area`=?", $area);
        if ($link22['id'] == '') {

            $resa = $db->prepare("INSERT INTO `area` (`area`,`status`, `ip`) VALUES(?,?,?)");
            $resa->execute(array($area,$status, $ip));
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Area Name already exists!</h4></div>';
        }
    } else {
        $link22 = FETCH_all("SELECT * FROM `area` WHERE `area`=? AND `id`!=? ", $category,$getid);
        if ($link22['id'] == '') {
            
      
            $resa = $db->prepare("UPDATE `area` SET `area`=?, `status`=?, `ip`=? WHERE `id`=?");
            $resa->execute(array(trim($area), trim($status), trim($ip),  $getid));

            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Area Name already exists!</h4></div>';
        }
    }
    return $res;
}

function delarea($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
        $get = $db->prepare("DELETE FROM `area` WHERE `id` = ? ");
        $get->execute(array($c));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}



function getproduct($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `product` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function gettypess($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `type` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function addtype($type,$status,$ip,$getid) {
    global $db;
    if ($getid == '') {
        $link22 = FETCH_all("SELECT * FROM `type` WHERE `type`=?", $type);
        if ($link22['id'] == '') {

            $resa = $db->prepare("INSERT INTO `type` (`type`,`status`, `ip`) VALUES(?,?,?)");
            $resa->execute(array($type,$status, $ip));
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Type Name already exists!</h4></div>';
        }
    } else {
        $link22 = FETCH_all("SELECT * FROM `type` WHERE `type`=? AND `id`!=? ", $type,$getid);
        if ($link22['id'] == '') {
            
      
            $resa = $db->prepare("UPDATE `type` SET `type`=?, `status`=?, `ip`=? WHERE `id`=?");
            $resa->execute(array(trim($type), trim($status), trim($ip),  $getid));

            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Type Name already exists!</h4></div>';
        }
    }
    return $res;
}

function deltype($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
        $get = $db->prepare("DELETE FROM `type` WHERE `id` = ? ");
        $get->execute(array($c));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}


function addproduct($minqty,$unit1,$unitid1,$category, $pname, $image, $image1, $subname, $sort_description, $long_description, $featured, $popular, $topsell, $status, $ip, $getid) {
    global $db;
    if ($getid == '') {
        $link22 = FETCH_all("SELECT * FROM `product` WHERE `category`=? AND `pname`", $category,$pname);
        if ($link22['id'] == '') {

            $resa = $db->prepare("INSERT INTO `product` (`minqty`,`category`,`image1`,`pname`,`image`,`subname`,`sort_description`,`long_description`,`featured`,`popular`,`topsell`,`status`, `ip`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $resa->execute(array($minqty,$category,$image1,$pname,$image,$subname,$sort_description,$long_description,$featured,$popular,$topsell,$status,$ip));
          
           $insid = $db->lastInsertId();
            
           $unit=explode("#",$unit1);
           $unitid=explode("#",$unitid1);
           $i=0;
           foreach($unit as $units)
           {
               if($units!='') {
              
            $resa = $db->prepare("INSERT INTO `unitprice` (`pid`, `unit`) VALUES(?,?)");
            $resa->execute(array($insid,$units));
               
           $i++;    
               }
           }
           
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Product Name already exists!</h4></div>';
        }
    } else {
        $link22 = FETCH_all("SELECT * FROM `product` WHERE `category`=? AND `pname`=? AND `id`!=? ", $category,$pname,$getid);
        if ($link22['id'] == '') {
            
      
            $resa = $db->prepare("UPDATE `product` SET `minqty`=?,`category`=?,`image1`=?, `pname`=?,`image`=?,`subname`=?,`sort_description`=?,`long_description`=?,`featured`=?,`popular`=?,`topsell`=?,`status`=? WHERE `id`=?");
            $resa->execute(array($minqty,$category,$image1,$pname,$image,$subname,$sort_description,$long_description,$featured,$popular,$topsell,$status,$getid));

   $unit=explode("#",$unit1);
           $unitid=explode("#",$unitid1);
           $i=0;
           foreach($unit as $units)
           {
               if($units!='') { 
            
               $unitids=$unitid[$i];
               if($unitids=='') {
            $resa1 = $db->prepare("INSERT INTO `unitprice` (`pid`, `unit`) VALUES(?,?)");
            $resa1->execute(array($getid,$units));
               }
               else
               {
               $resa1 = $db->prepare("UPDATE `unitprice` SET `unit`=? WHERE `id`=? ");
            $resa1->execute(array($units,$unitids)); 
               }
                
           $i++;   
               }
           }
           
   
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Product Name already exists!</h4></div>';
        }
    }
    return $res;
}

function delproduct($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
        $get = $db->prepare("DELETE FROM `product` WHERE `id` = ? ");
        $get->execute(array($c));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}
function getgrocery($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `product` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function addgrocery($eachabove1,$eachbelow1,$minqty,$eachprice,$eachid,$tamil_product,$english_product,$tamil_details,$english_details,$image,$image1,$image2,$price,$status,$ip, $getid) {
    global $db;
    if ($getid == '') {
        $link22 = FETCH_all("SELECT * FROM `product` WHERE (`tamil_product`=? AND `english_product`=?) AND `createdby`=?", $tamil_product,$english_product,$_SESSION['VEGID']);
        if ($link22['id'] == '') {

            $resa = $db->prepare("INSERT INTO `product` (`minqty`,`tamil_image`,`english_image`,`tamil_product`, `english_product`,`tamil_details`, `english_details`,`price`, `image`, `status`, `ip`, `createdby`,`userid`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $resa->execute(array($minqty,$image1,$image2,$tamil_product,$english_product,$tamil_details,$english_details,$price,$image,$status, $ip, $_SESSION['VEGID'],$_SESSION['VEGID']));
            $id = $db->lastInsertId();
              $eachabove11=explode('#',$eachabove1);
              $eachbelow11=explode('#',$eachabove1);
              $eachprice1=explode('#',$eachprice);
              $eachid1=explode('#',$eachid);
              $i=0;
              foreach($eachabove11 as $eachabove111)
              {
                  if($eachabove111!='')
                  {
                      $eachbelow12=$eachbelow11[$i];
                        $eachprice12=$eachprice1[$i];
             $resa = $db->prepare("INSERT INTO `pricerange` (`pid`,`eachabove`,`eachbelow`,`eachprice`) VALUES(?,?,?,?)");
             $resa->execute(array($id,$eachabove111,$eachbelow12,$eachprice12));
            
                  $i++;
                  }
              }
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Successfully Inserted</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Kit Name already exists!</h4></div>';
        }
    } else {
        $link22 = FETCH_all("SELECT * FROM `product` WHERE (`tamil_product`=? AND `english_product`=?) AND `id`!=? AND `createdby`=?", $tamil_product,$english_product, $getid ,$_SESSION['VEGID']);
        if ($link22['id'] == '') {
            
      
            $resa = $db->prepare("UPDATE `product` SET `minqty`=?,`tamil_image`=?,`english_image`=?,`tamil_product`=?,`english_product`=?, `tamil_details`=?,`english_details`=?, `image`=?,`price`=?, `status`=?, `ip`=? WHERE `id`=?");
            $resa->execute(array($minqty,trim($image1),trim($image2),trim($tamil_product),trim($english_product), trim($tamil_details),trim($english_details), trim($image), trim($price), trim($status), trim($ip),  $getid));

            
              $eachabove11=explode('#',$eachabove1);
              $eachbelow11=explode('#',$eachbelow1);
              $eachprice1=explode('#',$eachprice);
              $eachid1=explode('#',$eachid);
              $i=0;
              foreach($eachabove11 as $eachabove111)
              {
                  if($eachabove111!='')
                  {
                       $eachbel=$eachbelow11[$i];
                  $eachid12=$eachid1[$i];
				  
                  $eachprice12=$eachprice1[$i];
                  if($eachid12!='')
                  {
                     
               $resa = $db->prepare("UPDATE `pricerange` SET `pid`=?,`eachabove`=?,`eachbelow`=?,`eachprice`=? WHERE `id`=?");
               $resa->execute(array($getid,$eachabove111,$eachbel,$eachprice12,$eachid12));
                  }
                  else
                  {
                   $resa = $db->prepare("INSERT INTO `pricerange` (`pid`,`eachabove`,`eachbelow`,`qty`, `eachprice`) VALUES(?,?,?,?,?)");
                   $resa->execute(array($getid,$eachabove111,$eachbel,$eachqty12,$eachprice12));    
                  }
                  
                  }
				  $i++;
              }              
              
            $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button><h4><i class="icon fa fa-check"></i>Successfully Updated</h4></div>';
        } else {
            $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>Kit Name already exists!</h4></div>';
        }
    }
    return $res;
}

function delgrocery($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
        $get = $db->prepare("DELETE FROM `product` WHERE `id` = ? ");
        $get->execute(array($c));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}


function getregisterform($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `register` WHERE `id`=?");
    $get1->execute(array(trim($b)));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}

function delregisterform($a) {
    global $db;
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        $get = $db->prepare("UPDATE `register` SET `trash`='1' WHERE `id` =? ");
        $get->execute(array(trim($c)));
    }
    $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted</h4></div>';
    return $res;
}


function delquestion($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
             $get = $db->prepare("DELETE FROM `knowledge` WHERE `id` =? ");
       $get->execute(array(trim($c)));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}

function getquestion($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `knowledge` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function addquestion($question,$option1,$option2,$option3,$option4,$status,$getid)
{
    global $db;
   
if($getid=='')
{
$resa = $db->prepare("INSERT INTO `knowledge` (`question`,`option1`,`option2`,`option3`,`option4`,`status`) VALUES(?,?,?,?,?,?)");
$resa->execute(array($question,$option1,$option2,$option3,$option4,$status));
 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Inserted Successfully</h4></div>';
return $res;      
}
 else {
 
     
     $resa = $db->prepare("UPDATE `knowledge` SET `question`=?,`option1`=?,`option2`=?,`option3`=?,`option4`=?,`status`=? WHERE `id`=?");
      $resa->execute(array($$question,$option1,$option2,$option3,$option4,$status,$getid));  
       $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Updated Successfully</h4></div>';
return $res;
}
}

function delvillage($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
             $get = $db->prepare("DELETE FROM `village` WHERE `id` =? ");
       $get->execute(array(trim($c)));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}

function getvillage($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `village` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function addvillage($village,$getid){
    global $db;
   
if($getid=='')
{
$resa = $db->prepare("INSERT INTO `village` (`village`,`adminid`) VALUES(?,?)");
$resa->execute(array($village,$_SESSION['VEGID']));
 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Inserted Successfully</h4></div>';
return $res;      
}
 else {
 
     
     $resa = $db->prepare("UPDATE `village` SET `village`=? WHERE `id`=?");
      $resa->execute(array($village,$getid));  
       $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Updated Successfully</h4></div>';
return $res;
}
}


/* Patient Start here */ 


function delhealthworker($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
             $get = $db->prepare("DELETE FROM `healthworker` WHERE `id` =? ");
       $get->execute(array(trim($c)));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}

function gethealthworker($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `healthworker` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function addhealthworker($healthworker,$healthworkerid,$subcenter,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,$alreadytrained){
    global $db;

$token1 = openssl_random_pseudo_bytes(16);
 
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token1);
$resa = $db->prepare("INSERT INTO `healthworker` (`adminid`,`token`,`healthworker`,`subcenter`, `healthworkerid`, `emailid`, `mobileno`, `qualification`, `designation`, `experience`, `experienceyear`, `address`, `workingaddress`, `alreadytrained`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($_SESSION['VEGID'],$token,$healthworker,$subcenter,$healthworkerid,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,$alreadytrained,'1'));
 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Imported Successfully</h4></div>';
return $res;      
   
}



function addhealthworker1($healthworker,$healthworkerid,$subcenter,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,$alreadytrained,$getid){
    global $db;
   
if($getid=='')
{
$token = openssl_random_pseudo_bytes(16);
 
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

$resa = $db->prepare("INSERT INTO `healthworker` (`adminid`,`token`,`healthworker`,`subcenter`, `healthworkerid`, `emailid`, `mobileno`, `qualification`, `designation`, `experience`, `experienceyear`, `address`, `workingaddress`, `alreadytrained`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($_SESSION['VEGID'],$token,$healthworker,$subcenter,$healthworkerid,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,$alreadytrained,'1'));
 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Inserted Successfully</h4></div>';
return $res;      
}
 else {
     $resa = $db->prepare("UPDATE `healthworker` SET `healthworker`=?,`healthworkerid`=?,`subcenter`=?,`emailid`=?,`mobileno`=?,`qualification`=?,`designation`=?,`experience`=?,`experienceyear`=?,`address`=?,`workingaddress`=?,`alreadytrained`=? WHERE `id`=?");
      $resa->execute(array($healthworker,$healthworkerid,$subcenter,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,$alreadytrained,$getid));  
       $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Updated Successfully</h4></div>';
return $res;
}
}


function deldoctor($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
          $get1 = $db->prepare("DELETE FROM `users` WHERE `doctorid` =? ");
       $get1->execute(array(trim($c)));
       
             $get = $db->prepare("DELETE FROM `doctor` WHERE `id` =? ");
       $get->execute(array(trim($c)));
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}

function getdoctor($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `doctor` WHERE `id`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function adddoctor1($doctorname,$role,$username,$password,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,$getid){
    global $db;
   
if($getid=='')
{
$resa = $db->prepare("INSERT INTO `doctor` (`adminid`,`doctorname`, `role`, `username`, `password`, `emailid`, `mobileno`, `qualification`, `designation`, `experience`, `experienceyear`, `address`, `workingaddress`, `status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$resa->execute(array($_SESSION['VEGID'],$doctorname,$role,$username,$password,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,'1'));


 $id = $db->lastInsertId();
 
 $passvalue=md5($password);
$adminid=$_SESSION['VEGID'];
$type=$_SESSION['savemomtype'];
$resa1 = $db->prepare("INSERT INTO `users` (`name`,`type`,`doctorid`, `usergroup`, `val1`, `val2`, `val3`,`status`,`orgpassword`,`expiry_date`,`otpused`) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
$resa1->execute(array($doctorname,$type,$id,$adminid,$username,$passvalue,'1','1',$password,'2020-12-30','1'));

 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Inserted Successfully</h4></div>';
return $res;      
}
 else {
 
     
     $resa = $db->prepare("UPDATE `doctor` SET `doctorname`=?,`role`=?,`username`=?,`password`=?,`emailid`=?,`mobileno`=?,`qualification`=?,`designation`=?,`experience`=?,`experienceyear`=?,`address`=?,`workingaddress`=? WHERE `id`=?");
      $resa->execute(array($doctorname,$role,$username,$password,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,$getid));  
     
      $docdetails=FETCH_all("SELECT * FROM `users` WHERE `name` =? AND `type`=? AND `usergroup`=? ", $doctorname,'1',$_SESSION['VEGID']);
      if($docdetails=='')
      {
        $id = $getid;
 
 $passvalue=md5($password);
$adminid=$_SESSION['VEGID'];
$resa1 = $db->prepare("INSERT INTO `users` (`name`, `doctorid`, `usergroup`, `val1`, `val2`, `val3`,`status`,`orgpassword`) VALUES(?,?,?,?,?,?,?,?)");
$resa1->execute(array($doctorname,$id,$adminid,$username,$passvalue,'1','1',$password));
   
      }
      else
      {
           $passvalue=md5($password);
     $resa1 = $db->prepare("UPDATE `users` SET `val1`=?, `val2`=?,`orgpassword`=? WHERE `id`=?");
$resa1->execute(array($username,$passvalue,$password,$docdetails['id']));     
      }
      $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Updated Successfully</h4></div>';
return $res;
}
}


function adddoctor($doctorname,$username,$password,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress){
    global $db;
	
$resa = $db->prepare("INSERT INTO `doctor` (`adminid`,`doctorname`, `username`, `password`, `emailid`, `mobileno`, `qualification`, `designation`, `experience`, `experienceyear`, `address`, `workingaddress`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($_SESSION['VEGID'],$doctorname,$username,$password,$emailid,$mobileno,$qualification,$designation,$experience,$experienceyear,$address,$workingaddress,'1'));


 $id = $db->lastInsertId();
 
 $passvalue=md5($password);
 
$resa1 = $db->prepare("INSERT INTO `users` (`name`, `doctorid`, `usergroup`, `val1`, `val2`, `val3`,`orgpassword`) VALUES(?,?,?,?,?,?,?)");
$resa1->execute(array($doctorname,$id,$id,$username,$passvalue,'1',$password));

 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Imported Successfully</h4></div>';
return $res;      
   
}

function getpatient($a, $b) {
    global $db;
    $get1 = $db->prepare("SELECT * FROM `patient` WHERE `pid`=?");
    $get1->execute(array($b));
    $get = $get1->fetch(PDO::FETCH_ASSOC);
    $res = $get[$a];
    return $res;
}
function addpatient1($patientid,$name,$mobileno,$healthworker,$doctor,$age,$gender,$blood_group,$locality,$getid){
  
  global $db;
  if($_SESSION['savemomtype']=='1') { $uuid="Employeeid"; } else { $uuid="Patientid";; } 
if($getid=='')
{

    $patdetails=FETCH_all("SELECT * FROM `patient` WHERE `patientid` =? AND `adminid`=? ", $patientid,$_SESSION['VEGID']);
              
if($patdetails['pid']=='')
{
    $token1 = openssl_random_pseudo_bytes(16);
 
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token1);
$resa = $db->prepare("INSERT INTO `patient` (`adminid`,`patientid`,`name`,`mobileno`,`healthworker`,`doctor`,`age`,`gender`,`blood_group`,`locality`,`token`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($_SESSION['VEGID'],$patientid,$name,$mobileno,$healthworker,$doctor,$age,$gender,$blood_group,$locality,$token));

   if($doctor!='')
               {
               $docdetails=FETCH_all("SELECT * FROM `doctor` WHERE `doctorname` =? AND `adminid`=? ", $doctor,$_SESSION['VEGID']);
               if($docdetails['doctorname']=='')
               {
               $resa1 = $db->prepare("INSERT INTO `doctor` (`doctorname`,`status`,`adminid`) VALUES (?,?,?)");
               $resa1->execute(array($doctor,'1',$_SESSION['VEGID']));
        
               }
               }
                     
                if($healthworker!='')
               {
               $heldetails=FETCH_all("SELECT * FROM `healthworker` WHERE `healthworker` =? AND `adminid`=? ", $healthworker,$_SESSION['VEGID']);
               if($heldetails['healthworker']=='')
               {
                $resa2 = $db->prepare("INSERT INTO `healthworker` (`healthworker`,`status`,`adminid`) VALUES (?,?,?)");
                $resa2->execute(array($healthworker,'1',$_SESSION['VEGID']));
        
               }
               }
               
               
 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Inserted Successfully</h4></div>';
return $res;     
            }
            else{
                $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i>'.$uuid.' Already Exist</h4></div>';
                return $res;        
            }
}
else
{

    $patdetails=FETCH_all("SELECT * FROM `patient` WHERE `patientid` =? AND `adminid`=? AND `pid`!=? ", $patientid,$_SESSION['VEGID'],$getid);
              
if($patdetails['pid']=='')
{
$resa = $db->prepare("UPDATE `patient` SET `patientid`=?,`name`=?,`mobileno`=?,`healthworker`=?,`doctor`=?,`age`=?,`gender`=?,`blood_group`=?,`locality`=? WHERE `pid`=?");
$resa->execute(array($patientid,$name,$mobileno,$healthworker,$doctor,$age,$gender,$blood_group,$locality,$getid));  
 $res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Updated Successfully</h4></div>';
return $res;    
}
else{
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> '.$uuid.' Already Exist</h4></div>';
    return $res;        
}   
}

}
function addcheckpatient($name,$mobileno)
{
    global $db;
  
$resa = $db->prepare("INSERT INTO `patient` (`adminid`,`name`,`mobileno`) VALUES(?,?,?)");
$resa->execute(array($_SESSION['VEGID'],$name,$mobileno));

$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Imported Successfully</h4></div>';
return $res;      
   
}

function addpatient($patientid,$mothername,$village,$healthworker,$doctor,$mobileno,$cast,$bpl,$jsy,$reg_date,$anc_week,$mother_age,$anc_round,$livechild_m,$livechild_f,$lastchildage,$lmp,$edd,$blood_group,$ttlng_1,$ttlng_2, $ttlng_3,$irontab_1,$irontab_2,$irontab_3,$firstvisit_height,$firstvisit_weight,$firstvisit_hb,$firstvisit_bp,$firstvisit_sugar,$firstvisit_hightrisk,$secondvisit_height,$secondvisit_weight,$secondvisit_hb,$secondvisit_bp,$secondvisit_sugar,$secondvisit_hightrisk,$thirdvisit_height,$thirdvisit_weight,$thirdvisit_hb,$thirdvisit_bp,$thirdvisit_sugar,$thirdvisit_hightrisk,$fourthvisit_height,$fourthvisit_weight,$fourthvisit_hb,$fourthvisit_bp,$fourthvisit_sugar,$fourthvisit_hightrisk,$fifthvisit_height,$fifthvisit_weight,$fifthvisit_hb,$fifthvisit_bp,$fifthvisit_sugar,$fifthvisit_hightrisk){
    global $db;
 $link1 = FETCH_all("SELECT `patientid` FROM `patient` WHERE `patientid`=?", $patientid);
 if($link1['patientid']=='')
 {     
     
$resa = $db->prepare("INSERT INTO `patient` (`adminid`,`patientid`,`mother_name`,`village`,`healthworker`,`doctor`,`mobileno`,`cast`,`bpl`, `jsy`, `reg_date`, `anc_week`, `mother_age`, `anc_round`, `livechild_m`, `livechild_f`, `lastchildage`, `lmp`, `edd`, `blood_group`, `ttlng_1`, `ttlng_2`, `ttlng_3`, `irontab_1`, `irontab_2`, `irontab_3`, `firstvisit_height`, `firstvisit_weight`, `firstvisit_hb`, `firstvisit_bp`, `firstvisit_sugar`, `firstvisit_hightrisk`, `secondvisit_height`, `secondvisit_weight`, `secondvisit_hb`, `secondvisit_bp`, `secondvisit_sugar`, `secondvisit_hightrisk`, `thirdvisit_height`, `thirdvisit_weight`, `thirdvisit_hb`, `thirdvisit_bp`, `thirdvisit_sugar`, `thirdvisit_hightrisk`, `fourthvisit_height`, `fourthvisit_weight`, `fourthvisit_hb`, `fourthvisit_bp`, `fourthvisit_sugar`, `fourthvisit_heightrisk`, `fifthvisit_height`, `fifthvisit_weight`, `fifthvisit_hb`, `fifthvisit_bp`, `fifthvisit_sugar`, `fifthvisit_heightrisk`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$resa->execute(array($_SESSION['VEGID'],$patientid,$mothername,$village,$healthworker,$doctor,$mobileno,  $cast,$bpl,$jsy,$reg_date,$anc_week,$mother_age,$anc_round,$livechild_m,$livechild_f,$lastchildage,$lmp,$edd,$blood_group,$ttlng_1,$ttlng_2, $ttlng_3,$irontab_1,$irontab_2,$irontab_3,$firstvisit_height,$firstvisit_weight,$firstvisit_hb,$firstvisit_bp,$firstvisit_sugar,$firstvisit_hightrisk,$secondvisit_height,$secondvisit_weight,$secondvisit_hb,$secondvisit_bp,$secondvisit_sugar,$secondvisit_hightrisk,$thirdvisit_height,$thirdvisit_weight,$thirdvisit_hb,$thirdvisit_bp,$thirdvisit_sugar,$thirdvisit_hightrisk,$fourthvisit_height,$fourthvisit_weight,$fourthvisit_hb,$fourthvisit_bp,$fourthvisit_sugar,$fourthvisit_hightrisk,$fifthvisit_height,$fifthvisit_weight,$fifthvisit_hb,$fifthvisit_bp,$fifthvisit_sugar,$fifthvisit_hightrisk));
 }
 else
 {
     $resa = $db->prepare("UPDATE `patient` SET `patientid`=?,`mother_name`=?,`village`=?,`healthworker`=?,`doctor`=?,`mobileno`=? WHERE `patientid`=?");
     $resa->execute(array($patientid,$mother_name,$village,$healthworker,$doctor,$mobileno,$cast,$bpl,$jsy,$reg_date,$anc_week, $mother_age, $anc_round, $livechild_m, $livechild_f, $lastchildage, $lmp, $edd, $blood_group, $ttlng_1, $ttlng_2, $ttlng_3,$irontab_1,$irontab_2,$irontab_3,$firstvisit_height,$firstvisit_weight,$firstvisit_hb,$firstvisit_bp,$firstvisit_sugar,$firstvisit_hightrisk,$secondvisit_height,$secondvisit_weight,$secondvisit_hb,$secondvisit_bp,$secondvisit_sugar,$secondvisit_hightrisk,$thirdvisit_height,$thirdvisit_weight,$thirdvisit_hb,$thirdvisit_bp,$thirdvisit_sugar,$thirdvisit_hightrisk,$fourthvisit_height,$fourthvisit_weight,$fourthvisit_hb,$fourthvisit_bp,$fourthvisit_sugar,$fourthvisit_hightrisk,$fifthvisit_height,$fifthvisit_weight,$fifthvisit_hb,$fifthvisit_bp,$fifthvisit_sugar,$fifthvisit_hightrisk,$link1['patientid']));  
  }
$res = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-check"></i>Imported Successfully</h4></div>';
return $res;      
   
}

function delpatient($a) {
    $b = str_replace(".", ",", $a);
    $b = explode(",", $b);
    foreach ($b as $c) {
        global $db;
       $get1 = $db->prepare("DELETE FROM `vitals` WHERE `patientid` =? ");
       $get1->execute(array(trim($c)));
       $get2 = $db->prepare("DELETE FROM `symptoms` WHERE `patient` =? ");
       $get2->execute(array(trim($c)));
       $get3 = $db->prepare("DELETE FROM `supply` WHERE `patientid` =? ");
       $get3->execute(array(trim($c)));
       $get4 = $db->prepare("DELETE FROM `report` WHERE `patient` =? ");
       $get4->execute(array(trim($c)));
       $get = $db->prepare("DELETE FROM `patient` WHERE `pid` =? ");
       $get->execute(array(trim($c)));
     
    }
    $res = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4><i class="icon fa fa-close"></i> Successfully Deleted!</h4></div>';
    return $res;
}

?>