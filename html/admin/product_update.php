<?
	include "../common.php";
	
	$no=$_REQUEST[no];	
	$name=$_REQUEST[name];			//혹은 $name=$_POST[name];
	$menu=$_REQUEST[menu];
	$code=$_REQUEST[code];
	$coname=$_REQUEST[coname];
	$price=$_REQUEST[price];
	$text1=$_REQUEST[text1];
	$opt1=$_REQUEST[opt1];
	$opt2=$_REQUEST[opt2];
	$contents=$_REQUEST[contents];
	$status=$_REQUEST[status];
	$icon_new=$_REQUEST[icon_new];
	$icon_hit=$_REQUEST[icon_hit];
	$icon_sale=$_REQUEST[icon_sale];
	$regday1=$_REQUEST[regday1];
	$regday2=$_REQUEST[regday2];
	$regday3=$_REQUEST[regday3];
	$image1=$_REQUEST[image1];
	$image2=$_REQUEST[image2];
	$image3=$_REQUEST[image3];
	$discount=$_REQUEST[discount];
	$imagename1 = $_REQUEST[imagename1];
	$imagename2 = $_REQUEST[imagename2];
	$imagename3 = $_REQUEST[imagename3];
	$checkno1 = $_REQUEST[checkno1];
	$checkno2 = $_REQUEST[checkno2];
	$checkno3 = $_REQUEST[checkno3];
	if (!$icon_new)   $icon_new=0;   else   $icon_new=1 ;
	if (!$icon_hit)   $icon_hit=0;   else   $icon_hit=1 ;
	if (!$icon_sale)   $icon_sale=0;   else   $icon_sale=1 ;
	$regday = sprintf("%04d-%02d-%02d", $regday1,$regday2,$regday3);
	
	$name = addslashes($name);
	$contents = addslashes($contents);

		$fname1=$imagename1;
	if ($checkno1=="1") $fname1="";    // 삭제 체크가 된 경우
	if ($_FILES["image1"]["error"]==0) 
		{
		$fname1=$_FILES["image1"]["name"];    
		
		if (!move_uploaded_file($_FILES["image1"]["tmp_name"],
			  "../product/" . $fname1)) exit("업로드 실패");
	}
		$fname2=$imagename2;
	if ($checkno2=="1") $fname2="";    // 삭제 체크가 된 경우
	if ($_FILES["image2"]["error"]==0) 
		{
		$fname2=$_FILES["image2"]["name"];    
		if (!move_uploaded_file($_FILES["image2"]["tmp_name"],
			  "../product/" . $fname2)) exit("업로드 실패");
	}
		$fname3=$imagename3;
	if ($checkno3=="1") $fname3="";    // 삭제 체크가 된 경우
	if ($_FILES["image3"]["error"]==0) 
		{
		$fname3=$_FILES["image3"]["name"];    
		if (!move_uploaded_file($_FILES["image3"]["tmp_name"],
			  "../product/" . $fname3)) exit("업로드 실패");
	}
	
	if ($icon_sale == 1){
	$query="update product set name63='$name', code63='$code', coname63='$coname', menu63=$menu,
					price63=$price, opt1=$opt1, opt2=$opt2, contents63='$contents', status63=$status,
					icon_new63=$icon_new, icon_hit63=$icon_hit, icon_sale63=$icon_sale, regday63='$regday',
					image1='$fname1', image2='$fname2', image3='$fname3', discount63=$discount 
	where no63=$no;";}
	else
		$query="update product set name63='$name', code63='$code', coname63='$coname', menu63=$menu,
					price63=$price, opt1=$opt1, opt2=$opt2, contents63='$contents', status63=$status,
					icon_new63=$icon_new, icon_hit63=$icon_hit, icon_sale63=$icon_sale, regday63='$regday',
					image1='$fname1', image2='$fname2', image3='$fname3', discount63=0
	where no63=$no;";
	
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");
	$row=mysqli_fetch_array($result);		//1레코드 읽기
			
		$price=number_format($row[price63]);


	echo("<script>location.href='product.php?sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page'</script>");
?>

