<?php

// $url = 'http://192.168.10.148/CmMannaWCF/IsHoliday?date8=20181230&ck=936DA01F-9ABD-4d9d-80C7-02AF85C822A8';
// $url = 'http://192.168.10.148/TickDbData/api/tick/get?time=2017/05/02';


if(isset($_GET['method'])){
    $method = $_GET['method'];
    $url = $_GET['url'];
    $data = false;
}
else if(isset($_POST['method'])){
    $method = $_POST['method'];
    $url = $_POST['url'];
    $data = $_POST['data'];
    
}

echo callAPI($method, $url, $data);


function callAPI($method, $url, $data){
    $curl = curl_init();
 
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
 
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'APIKEY: 111111111111111111111',
       'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
    // EXECUTE:
    $result = curl_exec($curl);

    if(!$result){die("Connection Failure");}
    curl_close($curl);

    return $result;
 }


?>