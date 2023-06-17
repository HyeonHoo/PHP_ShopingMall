<?
	include "../common.php";
	
	$no1=$_REQUEST[no1];
	$name=$_REQUEST[name];			//혹은 $name=$_POST[name];

	$query="insert into opts (name63,opt_no63)
					values ('$name','$no1');";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러;$query");

	echo("<script>location.href='opts.php?no1=$no1'</script>");
?>