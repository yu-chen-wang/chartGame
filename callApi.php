<?php


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
   //  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   //     'APIKEY: 111111111111111111111',
   //     'Content-Type: application/json',
   //  ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
    // EXECUTE:
    $result = curl_exec($curl);

    if(!$result){die("Connection Failure");}
    curl_close($curl);

    return $result;
 }


?>