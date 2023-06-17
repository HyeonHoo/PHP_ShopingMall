<?
	include "../common.php";
	
	$no=$_REQUEST[no];
	$uid=$_REQUEST[uid];
	$pwd=$_REQUEST[pwd];
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
	$gubun = $_REQUEST[gubun];
	
	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
	$phone= sprintf("%-3s%-4s%-4s",$phone1,$phone2,$phone3);
	

	$query="update member set  name63='$name', pwd63='$pwd', birthday63='$birthday', tel63='$tel', 
				phone63='$phone', sm63=$sm, zip63='$zip', juso63='$juso', email63='$email', gubun63=$gubun
				where no63=$no;";
	
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");


	echo("<script>location.href='member.php'</script>");
?>

