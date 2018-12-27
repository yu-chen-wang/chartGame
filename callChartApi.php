<?php

// 用來 call http://192.168.10.148/ChartGame 的 API
// 注意: 在前端 ajax call 這頁 API 時，須把 object JSON.stringify() 後才丟


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

    curl_setopt_array($curl, array(
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/json",
        ),
    ));
 
    // EXECUTE:
    $result = curl_exec($curl);

    if(!$result){die("Connection Failure");}
    curl_close($curl);

    return $result;
 }


?>