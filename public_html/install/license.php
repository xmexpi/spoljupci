 <?php
    $post_data['domain'] = $_SERVER['SERVER_NAME'];
    $post_data['license_key'] = 'XP-'.substr(str_shuffle(str_repeat("0123456789abcdefghijkl", 5)), 0, 10);
    $post_data['db_user'] = $_REQUEST['db_username'];
    $post_data['db_password'] = $_REQUEST['db_password'];
    $post_data['db_name'] = $_REQUEST['db_database'];
    $post_data['admin_folder'] = $_REQUEST['admin_folder'];
    $post_data['ip_server'] = $_SERVER['SERVER_ADDR'];
    $post_data['admin_password'] = $_REQUEST['password'];
    $post_data['admin_username'] = $_REQUEST['username'];
    $post_data['ip_client'] = $_REQUEST['client_ip'];
    $post_data['save'] = 'Send';
    //traverse array and prepare data for posting (key1=value1)
    foreach ( $post_data as $key => $value) {
    $post_items[] = $key . '=' . $value;
    }
    //create the final string to be posted using implode()
    $post_string = implode ('&', $post_items);
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

//Map Array For Config Installation

    $map = array(
      '{ADMIN_FOLDER}' => rtrim($_REQUEST['admin_folder'], '/'),
      '{DB_TYPE}' => 'mysql',
      '{DB_SERVER}' => $_REQUEST['db_server'],
      '{DB_USERNAME}' => $_REQUEST['db_username'],
      '{DB_PASSWORD}' => $_REQUEST['db_password'],
      '{DB_DATABASE}' => $_REQUEST['db_database'],
      '{DB_TABLE_PREFIX}' => $_REQUEST['db_table_prefix'],
      '{DB_DATABASE_CHARSET}' => strtok($_REQUEST['db_collation'], '_'),
      '{DB_PERSISTENT_CONNECTIONS}' => 'false',
      '{CLIENT_IP}' => $_REQUEST['client_ip'],
      '{LICENSE_KEY}' => $post_data['license_key'],
      '{PASSWORD_SALT}' => substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 128),
    );