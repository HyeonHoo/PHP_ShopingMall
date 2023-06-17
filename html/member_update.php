<?
	include "common.php";
	$cookie_no=$_COOKIE[cookie_no];
	
	

	
	$uid=$_REQUEST[uid];
	$pwd1=$_REQUEST[pwd1];
	$name=$_REQUEST[name];
	$tel1=$_REQUEST[tel1];
	$tel2=$_REQUEST[tel2];
	$tel3=$_REQUEST[tel3];
	$sm=$_REQUEST[sm];
	$birthday1=$_REQUEST[birthday1];
	$birthday2=$_REQUEST[birthday2];
	$birthday3=$_REQUEST[birthday3];
	$juso=$_REQUEST[juso];
	$phone1=$_REQUEST[phone1];
	$phone2=$_REQUEST[phone2];
	$phone3=$_REQUEST[phone3];
	$email=$_REQUEST[email];
	$zip=$_REQUEST[zip];
	
	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
	$phone= sprintf("%-3s%-4s%-4s",$phone1,$phone2,$phone3);
	
	if(!$pwd1)
	$query="update member set  name63='$name', birthday63='$birthday', tel63='$tel', 
				phone63='$phone', sm63=$sm, zip63='$zip', juso63='$juso', email63='$email'
				where no63=$cookie_no;";
	else
	$query="update member set  pwd63='$pwd1', name63='$name', birthday63='$birthday', tel63='$tel', 
				phone63='$phone', sm63=$sm, zip63='$zip', juso63='$juso', email63='$email'
				where no63=$cookie_no;";
					
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
		setcookie("cookie_name",$name);

	echo("<script>location.href='index.html'</script>");
?>

