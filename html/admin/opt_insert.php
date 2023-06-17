<?
	include "../common.php";
	
	$name=$_REQUEST[name];			//혹은 $name=$_POST[name];


	$query="insert into opt (name63)
					values ('$name');";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러;$query");

	echo("<script>location.href='opt.php'</script>");
?>