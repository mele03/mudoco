<?php
/**
 * MuDoCo - A Multi Domain Cookie
 * 
 * Server side API webservice.
 * 
 * 
 * System call
 * param s : system call name
 * 
 *  - nonce : Generate a nonce and register it with the given client nonce.
 *   - param cn : client nonce
 * 
 * Query plugin
 * param q : plugin tag
 *   calls the query function of the given plugin
 * 
 * 
 * Returns : json
 *  {
 *    code: int,
 *    data: mixed,
 *  }
 * 
 * 
 * NB : This file should be IP protected.
 * 
 */

include_once '../etc/config.php';
include_once 'MuDoCo/Server.php';

$server = new MuDoCo_Server;

$server->init('api');

$code = -1; // >=0 for success or custom codes
$data = null;
if (isset($_GET['s'])) {
  // system call
  $code = $server->apiSystem($_GET['s'], array_diff_key($_GET, array('s'=>'')), $data);
}
elseif (isset($_GET['q'])) {
  // plugin call
  $code = $server->pluginQuery($_GET['q'], array_diff_key($_GET, array('q'=>'')), $data);
}

$server->api($data, $code);
