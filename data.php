<?php
$servername="localhost";
$username="root";
$pass="rootroot";
$dbname="news";
$conn=new mysqli($servername,$username,$pass,$dbname);
if(!($conn)){
    die("connectd failed".$conn->error);
}


$sql="select * from news";
$result=$conn->query($sql);
$productdata=array();
if($result->num_rows>0){
    while($rows=$result->fetch_assoc()){
        $productdata[]=$rows;
    }
}

header('Content-Type:applaction/json');
echo json_encode($productdata);



?>