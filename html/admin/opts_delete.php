<?
	include "../common.php";
	
	$no2 =$_REQUEST[no2];


	$query="delete from opts where no63=$no2;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러;$query");

	echo("<script>location.href='opt.php'</script>");
?>