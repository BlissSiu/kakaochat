<?php
	@session_start();

	$db_host = "localhost";
	$db_user = "root";
	$db_passwd = "";
	$db_name = "kakaotalk";

	$db_link = mysqli_connect($db_host,$db_user,$db_passwd); //�����ͺ��̽� ����
	mysqli_select_db($db_link,$db_name); //���� database ����
?>