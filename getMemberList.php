<?php
$db_host = "localhost";
$db_user = "root";
$db_passwd = "";
$db_name = "kakaotalk";

$db_link = mysqli_connect($db_host, $db_user, $db_passwd);
mysqli_select_db($db_link, $db_name);
$SQL = " SELECT memberCode, userId, userIcon, alias From member order by alias ";
$result = mysqli_query($db_link, $SQL);
$memberResult = dbresultTojson($result);
echo $memberResult;

function dbresultTojson($res)
{
    $ret_arr = array();

    while ($row = mysqli_fetch_array($res)) {
        foreach ($row as $key => $value) {
            $row_array[$key] = urlencode($value);
        }
        array_push($ret_arr, $row_array);
    }
    return urldecode(json_encode($ret_arr));
}


?>