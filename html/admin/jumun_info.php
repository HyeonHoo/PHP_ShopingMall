<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";
	$no=$_REQUEST[no];
	$state=$_REQEUST[state];

?>
<?
			$query="select jumun.no63,jumun.state63, jumun.jumunday63, jumun.o_name63, jumun.o_tel63, jumun.o_phone63, jumun.o_email63, jumun.o_juso63, jumun.o_zip63,
   jumun.r_name63, jumun.r_tel63, jumun.r_phone63, jumun.r_email63, jumun.r_juso63, jumun.memo63, jumun.r_zip63,
    jumun.pay_method63, jumun.card_okno63, jumun.card_halbu63, jumun.card_kind63, jumun.bank_kind63, jumun.bank_sender63,
   product.name63 as p_name, opts1.name63 as opts1_name,opts2.name63 as opts2_name,jumuns.num63, jumuns.price63,
   jumuns.cash63,jumuns.discount63,jumun.total_cash63,jumuns.product_no63 
   from (((jumuns left join jumun on jumuns.jumun_no63=jumun.no63)
   left join product on jumuns.product_no63=product.no63)
   left join opts as opts1 on jumuns.opts_no1=opts1.no63) 
   left join opts as opts2 on jumuns.opts_no2=opts2.no63 
   where jumuns.jumun_no63='$no';";
			$result=mysqli_query($db,$query);     
			 if (!$result) exit("에러:$query");                
			 $count=mysqli_num_rows($result); 
			 $row=mysqli_fetch_array($result);
			 
			 $tel=$row[o_tel63];
				  $tel1=substr($tel,0,2);
				$tel2=substr($tel,2,4);
					 $tel3=substr($tel,6,4);
						   
		$tel = sprintf("%02d-%4d-%04d", $tel1,$tel2,$tel3);
			$phone=$row[o_phone63];
			$phone1=substr($phone,0,3);
			$phone2=substr($phone,3,4);
			$phone3=substr($phone,7,4);
			$phone = sprintf("%03d-%04d-%04d", $phone1,$phone2,$phone3);
			
				$tel_r=$row[r_tel63];
				  $tel_r1=substr($tel_r,0,2);
					$tel_r2=substr($tel_r,2,4);
					 $tel_r3=substr($tel_r,6,4);
						   
		$tel_r = sprintf("%02d-%4d-%04d", $tel_r1,$tel_r2,$tel_r3);
			
			$phone_r=$row[r_phone63];
			$phone_r1=substr($phone_r,0,3);
			$phone_r2=substr($phone_r,3,4);
			$phone_r3=substr($phone_r,7,4);
			$phone_r = sprintf("%03d-%04d-%04d", $phone_r1,$phone_r2,$phone_r3);
			
			$pay_method=$row[pay_method63];
			$card_halbu=$row[card_halbu63];
			$card_kind=$row[card_kind63];
			$bank_kind=$row[bank_kind63];
			$state=$_REQEUST[state];
			
			$state = $row[state63];
	
				$color='black';
				if ($state==5)  $color='blue';  // 주문완료 
				if ($state==6)  $color='red';   // 주문취소
?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문번호</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE">&nbsp;<font size="3"><b><?=$row[no63];?> 
				(<?
				
			 for($k=1; $k<$n_state; $k++)
				 {
					if($k==$state)
					   echo("<font color=$color >$a_state[$k]</font>");
				 }
			
			?>)</b></font></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문일</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[jumunday63];?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[o_name63];?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$tel;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[o_email63];?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$phone;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3"><?=$row[o_juso63];?></td>
	</tr>
	</tr>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[r_name63];?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$tel_r;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[r_email63];?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$phone_r;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3"><?=$row[r_juso63];?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">메모</font></td>
        <td width="300" height="50" bgcolor="#EEEEEE" colspan="3"><?=$row[memo63];?></td>
	</tr>
</table>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">지불종류</font></td>
		<?
		if($pay_method==1){
			echo("
        <td width='300' height='20' bgcolor='#EEEEEE'>무통장</td>"); 
		}
		else {
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>카드</td>");
		}
		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드승인번호 </font></td>
		<?
		if(empty($row[card_okno63])){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'> - </td>
			");
		}
		else{
		echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>$row[card_okno63]</td>
			");
		}
		?>
        
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드 할부</font></td>
		<?
		if($card_halbu==1){
			echo("
			 <td width='300' height='20' bgcolor='#EEEEEE'>일시불</td> ");
		}
		elseif($card_halbu==3){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>3개월</td> ");
		}
		elseif($card_halbu==6){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>6개월</td> ");
		}
			elseif($card_halbu==9){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>9개월</td> ");
		}
		elseif($card_halbu==12){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>12개월</td> ");
		}
		else{
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'> - </td> ");
		}
		
		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드종류</font></td>
		<?
		if($card_kind==1){
			echo("
			 <td width='300' height='20' bgcolor='#EEEEEE'>국민카드</td> ");
		}
		elseif($card_kind==2){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>신한카드</td> ");
		}
		elseif($card_kind==3){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>우리카드</td> ");
		}
		elseif($card_kind==4){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>하나카드</td> ");
		}
		else{
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'> - </td> ");
		}
		?>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">무통장</font></td>
			<?
		if($bank_kind==1){
			echo("
			 <td width='300' height='20' bgcolor='#EEEEEE'>국민은행 000-00000-0000</td> ");
		}
		elseif($bank_kind==2){
			echo("
			<td width='300' height='20' bgcolor='#EEEEEE'>신한은행 000-00000-0000</td> ");
		}
		else{
			echo("
			 <td width='300' height='20' bgcolor='#EEEEEE'>-</td> ");
		}

		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">입금자이름</font></td>
			<?
			if(empty($row[bank_sender63]))
			{
				echo("
				<td width='300' height='20' bgcolor='#EEEEEE'> - </td>");
			}
			else{
				echo("
				<td width='300' height='20' bgcolor='#EEEEEE'>$row[bank_sender63]</td>");
			}
			?>
	</tr>
</table>


<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC"> 
    <td width="340" height="20" align="center"><font color="#142712">상품명</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">수량</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">단가</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">금액</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">할인</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션1</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션2</font></td>
	</tr>
	<tr bgcolor="#EEEEEE" height="20">
<?
			$query="select jumun.no63,jumun.state63, jumun.jumunday63, jumun.o_name63, jumun.o_tel63, jumun.o_phone63, jumun.o_email63, jumun.o_juso63, jumun.o_zip63,
   jumun.r_name63, jumun.r_tel63, jumun.r_phone63, jumun.r_email63, jumun.r_juso63, jumun.memo63, jumun.r_zip63,
    jumun.pay_method63, jumun.card_okno63, jumun.card_halbu63, jumun.card_kind63, jumun.bank_kind63, jumun.bank_sender63,
   product.name63 as p_name, opts1.name63 as opts1_name,opts2.name63 as opts2_name,jumuns.num63, jumuns.price63,
   jumuns.cash63,jumuns.discount63,jumun.total_cash63,jumuns.product_no63 
   from (((jumuns left join jumun on jumuns.jumun_no63=jumun.no63)
   left join product on jumuns.product_no63=product.no63)
   left join opts as opts1 on jumuns.opts_no1=opts1.no63) 
   left join opts as opts2 on jumuns.opts_no2=opts2.no63 
   where jumuns.jumun_no63='$no';";
			$result=mysqli_query($db,$query);     
			 if (!$result) exit("에러:$query");                
			 $count=mysqli_num_rows($result); 
			 
	$total=0;
	for($i=0; $i<$count; $i++){
	 $row1=mysqli_fetch_array($result);
	 $price=$row1[price63];
	 $price_n=number_format($price);
	 $cash=$row1[cash63];
	 $cash_n=number_format($cash);
	  $product_no=$row1[product_no63];

	$total=$total+$cash ; 
	$discount=$row1[discount63];
		if($discount==0){
			$discount="-";
		}
		else{
		$discount=$row1[discount63];
		}

	
	if($product_no==0){
		$p_name=$row1[p_name];
			$p_name= "배송비";
		echo("
		<td width='340' height='20' align='left'>$p_name</td>
		<td width='50'  height='20' align='center'>$row1[num63]</td>	
		<td width='70'  height='20' align='right'>$price_n</td>	
		<td width='70'  height='20' align='right'>$cash_n</td>	
		<td width='50'  height='20' align='center'>$discount %</td>	
		<td width='60'  height='20' align='center'>$row1[opts1_name]</td>	
		<td width='60'  height='20' align='center'>$row1[opts2_name]</td>	
	</tr> 
		");
	}
	else{
		echo("
		<td width='340' height='20' align='left'>$row1[p_name]</td>
		<td width='50'  height='20' align='center'>$row1[num63]</td>	
		<td width='70'  height='20' align='right'>$price_n</td>	
		<td width='70'  height='20' align='right'>$cash_n</td>	
		<td width='50'  height='20' align='center'>$discount %</td>	
		<td width='60'  height='20' align='center'>$row1[opts1_name]</td>	
		<td width='60'  height='20' align='center'>$row1[opts2_name]</td>	
	</tr> 
		");
	}
	
	}
?>


</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
<?
$total_a=number_format($total);
echo("
	<tr> 
	  <td width='100' height='20' bgcolor='#CCCCCC' align='center'><font color='#142712'>총금액</font></td>
		<td width='700' height='20' bgcolor='#EEEEEE' align='right'><font color='#142712' size='3'><b>$total_a</b></font> 원&nbsp;&nbsp</td>
	</tr>
</table>
");

?>
<table width="800" border="0" cellspacing="0" cellpadding="7">
	<tr> 
		<td align="center">
			<input type="button" value="이 전 화 면" onClick="javascript:history.back();">&nbsp
			<input type="button" value="프린트" onClick="javascript:print();">
		</td>
	</tr>
</table>

</center>

<br>
</body>
</html>
