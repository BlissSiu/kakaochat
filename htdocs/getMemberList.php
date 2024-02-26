<?php
	include "conn.php";

	$except_room_id = "";
	if(isset($_POST["except_room_id"])) {
		$except_room_id = $_POST["except_room_id"];
	}

	$except_members = "";
	if($except_room_id) {
		$SQL = " SELECT members FROM room where roomCode='".$except_room_id."' ";
		$result = mysqli_query($db_link, $SQL);
		if($row = mysqli_fetch_array($result)) {
			$except_members = $row["members"];
		}
	}

	$Where = "";
	if($except_members) {
		$Where = " where memberCode not in (".$except_members.") ";
	}

	$SQL = " SELECT memberCode, userId, userIcon, alias FROM member $Where order by alias ";
	$result = mysqli_query($db_link, $SQL);
	$memberResult = dbresultTojson($result);
	echo $memberResult;

	function dbresultTojson($res)
	{
		$ret_arr = array();

		while($row = mysqli_fetch_array($res))
		{
			foreach($row as $key => $value){
				$row_array[$key] = urlencode($value);
			}
			array_push($ret_arr, $row_array);
		}

		return urldecode(json_encode($ret_arr));
	}
?>