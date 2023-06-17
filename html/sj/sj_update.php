<?
	include "common.php";
	
	$no=$_REQUEST[no];
	$name=$_REQUEST[name];			
	$kor=$_REQUEST[kor];
	$eng=$_REQUEST[eng];
	$mat=$_REQUEST[mat];
	$hap=$_REQUEST[hap];
	$avg=$_REQUEST[avg];

	$query="update sj set name63='$name', kor63=$kor,
				eng63=$eng, mat63=$mat, hap63=$hap,
				avg63=$avg	  where no63=$no;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");

	echo("<script>location.href='sj_list.php'</script>");
?>