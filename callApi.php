<?php

// 用來 call http://www.cmoney.tw/MobileService/ashx/ 的 APi

if(isset($_GET['method'])){
    $method = $_GET['method'];
    $url = $_GET['url'];
    $data = false;
}
else {
    $method = $_POST['method'];
    $url = $_POST['url'];
    $data = $_POST['data'];
}


// echo $method;
// echo $url."<br>";
// echo $data;
// print_r($data);

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
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
   //  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   //     'Content-Type: application/json',
   //  ));

    
    // EXECUTE:
    $result = curl_exec($curl);

    if(!$result){die("Connection Failure");}
    curl_close($curl);

    return $result;
 }


?>