<?
		include "common.php";
		
?>

<?	
			
			$uid = $_REQUEST[uid];
			$pwd = $_REQUEST[pwd];
		
		$query="select no63, name63 from member where uid63 ='$uid' and pwd63 ='$pwd'";
		
		$result=mysqli_query($db,$query);
					if(!$result) exit("에러:$query");
		
		$count=mysqli_num_rows($result);
		
		$row = mysqli_fetch_array($result);
		$no=$row['no63'];
		$name=$row['name63'];
					
	if ($count>0) {
		

		   setcookie("cookie_no",$no);
		   setcookie("cookie_name",$name);

		echo("<script>location.href='index.html'</script>");
		
	}
	else
		 echo("<script>location.href='member_login.php'</script>");
	?>