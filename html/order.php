<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_top.php";
	include "common.php";
				$no=$_REQUEST[no];
			$opts1=$_REQUEST[opts1];
			$opts2=$_REQUEST[opts2];
			$num=$_REQUEST[num];
			$cart=$_COOKIE[cart];
			$n_cart=$_COOKIE[n_cart];
			$kind=$_REQUEST[kind];
			$pos=$_REQUEST[pos];
			$opt1=$_REQUEST[opt1];
			$opt2=$_REQUEST[opt2];
			$cookie_no=$_COOKIE[cookie_no];
		
?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language="javascript">

			function Check_Value() {
				if (!form2.o_name.value) {
					alert("주문자 이름이 잘 못 되었습니다.");	form2.o_name.focus();	return;
				}
				if (!form2.o_tel1.value || !form2.o_tel2.value || !form2.o_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.o_tel1.focus();	return;
				}
				if (!form2.o_phone1.value || !form2.o_phone2.value || !form2.o_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.o_phone1.focus();	return;
				}
				if (!form2.o_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.o_email.focus();	return;
				}
				if (!form2.o_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.o_zip.focus();	return;
				}
				if (!form2.o_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.o_juso.focus();	return;
				}

				if (!form2.r_name.value) {
					alert("받으실 분의 이름이 잘 못 되었습니다.");	form2.r_name.focus();	return;
				}
				if (!form2.r_tel1.value || !form2.r_tel2.value || !form2.r_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.r_tel1.focus();	return;
				}
				if (!form2.r_phone1.value || !form2.r_phone2.value || !form2.r_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.r_phone1.focus();	return;
				}
				if (!form2.r_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.r_email.focus();	return;
				}
				if (!form2.r_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.r_zip.focus();	return;
				}
				if (!form2.r_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.r_juso.focus();	return;
				}

				form2.submit();
			}

			function FindZip(zip_kind) 
			{
				window.open("zipcode.php?zip_kind="+zip_kind, "", "scrollbars=no,width=500,height=250");
			}

			function SameCopy(str) {
				if (str == "Y") {
					form2.r_name.value = form2.o_name.value;
					form2.r_zip.value = form2.o_zip.value;
					form2.r_juso.value = form2.o_juso.value;
					form2.r_tel1.value = form2.o_tel1.value;
					form2.r_tel2.value = form2.o_tel2.value;
					form2.r_tel3.value = form2.o_tel3.value;
					form2.r_phone1.value = form2.o_phone1.value;
					form2.r_phone2.value = form2.o_phone2.value;
					form2.r_phone3.value = form2.o_phone3.value;
					form2.r_email.value = form2.o_email.value;
				}
				else {
					form2.r_name.value = "";
					form2.r_zip.value = "";
					form2.r_juso.value = "";
					form2.r_tel1.value = "";
					form2.r_tel2.value = "";
					form2.r_tel3.value = "";
					form2.r_phone1.value = "";
					form2.r_phone2.value = "";
					form2.r_phone3.value = "";
					form2.r_email.value = "";
				}
			}

			</script>

			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
				<tr>
					<td height="30" align="center"><img src="images/jumun_title.gif" width="746" height="30" border="0"></td>
				</tr>
				<tr><td height="13"></td></tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0" width="710">
				<tr>
					<td><img src="images/order_title1.gif" width="65" height="15" border="0"></td>
				</tr>
				<tr><td height="10"></td></tr>
			</table>

			<table border="0" cellpadding="5" cellspacing="1" width="710" class="cmfont" bgcolor="#CCCCCC">
				<tr bgcolor="F0F0F0" height="23" class="cmfont">
					<td width="420" align="center">상품</td>
					<td width="70"  align="center">수량</td>
					<td width="80"  align="center">가격</td>
					<td width="90"  align="center">합계</td>
				</tr>

				<form name="form1" method="post">
				<?
				
				$total=0;
				if (!$n_cart) $n_cart=0;
				for ($i=1;  $i<=$n_cart;  $i++)
				{
					if ($cart[$i])
				   {
					   list($no, $num, $opts1, $opts2)=explode("^", $cart[$i]);
				   
				$query="select * from product where no63=$no";
			   $result=mysqli_query($db,$query);     
			   if (!$result) exit("에러:$query");                
			   $count=mysqli_num_rows($result); 
			   $row=mysqli_fetch_array($result);
			   
			   $query1 = "select * from opts where no63=$opts1";
			   $result1=mysqli_query($db,$query1);     
			   if (!$result) exit("에러1:$query1");                 
			   $count1=mysqli_num_rows($result1);
			   $row1=mysqli_fetch_array($result1);
			   
			   $query2 = "select * from opts where no63=$opts2";
			   $result2=mysqli_query($db,$query2);     
			   if (!$result2) exit("에러2:$query2");                 
			   $count2=mysqli_num_rows($result2);
			  $row2=mysqli_fetch_array($result2);
						  
	
									if($row[icon_sale63] == 0){
										$price1=$row[price63]; 
										$t_price = $price1 * $num;}
										else{
										$price1=round($row[price63]*(100-$row[discount63])/100, -3); 
										$t_price = $price1 * $num;}
										
									$price1=number_format($price1);
									
									$t_price_n=number_format($t_price);
									
					   
					  
				echo("
				<tr>
					<td height='60' align='center' bgcolor='#FFFFFF'>
						<table cellpadding='0' cellspacing='0' width='100%'>
							<tr>
								<td width='60'>
									<a href='product_detail.php?no=$row[no63]'><img src='product/$row[image2]' width='50' height='50' border='0'></a>
								</td> 
								<td class='cmfont'>
									<a href='product_detail.php?no=$row[no63]'>$row[name63]</a><br>
									<font color='#0066CC'>[옵션사항]</font> $row1[name63] $row2[name63]
								</td>
							</tr>
						</table>
					</td>
					<td align='center' bgcolor='#FFFFFF'>$num 개</font>
					
					</td> 
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$price1</font></td>
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$t_price_n</font></td>
					
				</tr>
				");
						$t_price_int=(int)$t_price;
				       $total=$total+$t_price_int;
					
					}
				}
					

			?>
				
			
				<tr>
					<td colspan="5" bgcolor="#F0F0F0">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
							<tr>
								<td bgcolor="#F0F0F0"><img src="images/cart_image1.gif" border="0"></td>
								<td align="right" bgcolor="#F0F0F0">
								<?  
									$total_s= number_format($total);
									$total_a= number_format($total);
									$baesongbi_s= number_format($baesongbi);
									
								if ($total > $max_baesongbi) {
									echo("
									<font color='#0066CC'><b>총 합계금액</font></b> : 상품대금 ($total_s) 원 + 
								배송비(0) 원 = <font color='#FF3333'><b>$total_a 원</b></font>&nbsp;&nbsp  "); 
									}
									else if($total == 0 ){
										echo("
										<font color='#0066CC'><b>총 합계금액</font></b> : 상품대금 ($total_s) 원 + 
									배송비(0) 원 = <font color='#FF3333'><b>$total_a 원</b></font>&nbsp;&nbsp  "); }
									else{ 
									$total_a=(int)$total+(int)$baesongbi ;
									$total_a= number_format($total_a);
										echo("
									<font color='#0066CC'><b>총 합계금액</font></b> : 상품대금 ($total_s) 원 + 
									배송비($baesongbi_s) 원 = <font color='#FF3333'><b>$total_a 원</b></font>&nbsp;&nbsp  "); 
									
									}
								?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>

			<!-- 주문자 정보 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
			</table>

			<!-- form2 시작  -->
			<form name="form2" method="post" action="order_pay.php">
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="left" valign="top" width="150" STYLE="padding-left:45;padding-top:5">
						<font size="2" color="#B90319"><b>주문자 정보</b></font>
					</td>
					<td align="center" width="560">
<?
$o_no="0"; $o_name=""; $o_tel="";	$o_phone=""; $o_email="";	$o_zip=""; $o_juso="";			//주문자정보를 위한 변수 초기화 
if ($cookie_no)     // 쿠키로 로그인했는지 조사
{
   $query="select * from member where no63=$cookie_no";			//개인정보 일기
    $result=mysqli_query($db,$query);     
	if (!$result) exit("에러:$query");                
	$count=mysqli_num_rows($result); 
	$row=mysqli_fetch_array($result);
    $o_no=$row[no63]; 							//주문자정보를 위한 변수에 알아낸 값 대입
	$o_name=$row[name63];
	$o_tel=$row[tel63];
	$o_phone=$row[phone63];
	$o_email=$row[email63];
	$o_zip=$row[zip63];
	$o_juso=$row[juso63];
	      
      $o_tel1=trim(substr($row[tel63],0,3));
      $o_tel2=trim(substr($row[tel63],3,4));
      $o_tel3=trim(substr($row[tel63],7,4));

      $o_phone1=trim(substr($row[phone63],0,3));
      $o_phone2=trim(substr($row[phone63],3,4));
      $o_phone3=trim(substr($row[phone63],7,4));

}
if($cookie_no==0)			//주문자정보 출력
echo("
						<table width='560' border='0' cellpadding='0' cellspacing='0' class='cmfont'>
							<tr height='25'>
								<td width='150'><b>주문자 성명</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='hidden' name='o_no' value=''>
									<input type='text'   name='o_name' size='20' maxlength='10' value='' class='cmfont1'>
								</td>
							</tr>
							<tr height='25'>
								<td width='150'><b>전화번호</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_tel1' size='4' maxlength='4' value='' class='cmfont1'> -
									<input type='text' name='o_tel2' size='4' maxlength='4' value='' class='cmfont1'> -
									<input type='text' name='o_tel3' size='4' maxlength='4' value='' class='cmfont1'>
								</td>
							</tr>
							<tr height='25'>
								<td width='150'><b>휴대폰번호</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_phone1' size='4' maxlength='4' value='' class='cmfont1'> -
									<input type='text' name='o_phone2' size='4' maxlength='4' value='' class='cmfont1'> -
									<input type='text' name='o_phone3' size='4' maxlength='4' value='' class='cmfont1'>
								</td>
							</tr>
							<tr height='25'>
								<td width='150'><b>E-Mail</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_email' size='50' maxlength='50' value='' class='cmfont1'>
								</td>
							</tr>
							<tr height='50'>
								<td width='150'><b>주소</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_zip' size='5' maxlength='5' value='' class='cmfont1'> 
									<a href='javascript:FindZip(1)'><img src='images/b_zip.gif' align='absmiddle' border='0'></a> <br>
									<input type='text' name='o_juso' size='55' maxlength='200' value='' class='cmfont1'><br>
								</td>
							</tr>
						</table>
");
else{
	echo("
						<table width='560' border='0' cellpadding='0' cellspacing='0' class='cmfont'>
							<tr height='25'>
								<td width='150'><b>주문자 성명</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='hidden' name='o_no' value='$o_no'>
									<input type='text'   name='o_name' size='20' maxlength='10' value='$o_name' class='cmfont1'>
								</td>
							</tr>
							<tr height='25'>
								<td width='150'><b>전화번호</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_tel1' size='4' maxlength='4' value='$o_tel1' class='cmfont1'> -
									<input type='text' name='o_tel2' size='4' maxlength='4' value='$o_tel2' class='cmfont1'> -
									<input type='text' name='o_tel3' size='4' maxlength='4' value='$o_tel3' class='cmfont1'>
								</td>
							</tr>
							<tr height='25'>
								<td width='150'><b>휴대폰번호</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_phone1' size='4' maxlength='4' value='$o_phone1' class='cmfont1'> -
									<input type='text' name='o_phone2' size='4' maxlength='4' value='$o_phone2' class='cmfont1'> -
									<input type='text' name='o_phone3' size='4' maxlength='4' value='$o_phone3' class='cmfont1'>
								</td>
							</tr>
							<tr height='25'>
								<td width='150'><b>E-Mail</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_email' size='50' maxlength='50' value='$o_email' class='cmfont1'>
								</td>
							</tr>
							<tr height='50'>
								<td width='150'><b>주소</b></td>
								<td width='20'><b>:</b></td>
								<td width='390'>
									<input type='text' name='o_zip' size='5' maxlength='5' value='$o_zip' class='cmfont1'> 
									<a href='javascript:FindZip(1)'><img src='images/b_zip.gif' align='absmiddle' border='0'></a> <br>
									<input type='text' name='o_juso' size='55' maxlength='200' value='$o_juso' class='cmfont1'><br>
								</td>
							</tr>
						</table>
	
	
	");
}

?>


				

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<!-- 배송지 정보 -->
			<table width="750" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="740" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="left" valign="top" width="200" STYLE="padding-left:45;padding-top:5"><font size=2 color="#B90319"><b>배송지 정보</b></font></td>
					<td align="center" width="560">

						<table width="600" border="0" cellpadding="0" cellspacing="0" class="cmfont">
							<tr height="25">
								<td width="160"><b>주문자정보와 동일</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="radio" name="same" onclick="SameCopy('Y')">예 &nbsp;
									<input type="radio" name="same" onclick="SameCopy('N')">아니오
								</td>
									</tr>
								
							<tr height="25">
								<td width="150"><b>받으실 분 성명</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_name" size="20" maxlength="10" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>전화번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_tel1" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_tel2" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_tel3" size="4" maxlength="4" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>휴대폰번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_phone1" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_phone2" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_phone3" size="4" maxlength="4" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>E-Mail</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_email" size="50" maxlength="50" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>주소</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_zip" size="5" maxlength="5" value="" class="cmfont1"> 
									<a href="javascript:FindZip(2)"><img src="images/b_zip.gif" align="absmiddle" border="0"></a> <br>
									<input type="text" name="r_juso" size="55" maxlength="200" value="" class="cmfont1"><br>
								</td>
							</tr>		
							<tr height="50">
								<td width="150"><b>배송시요구사항</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<textarea name="memo" cols="60" rows="3" class="cmfont1" value="<?=$memo?>"></textarea>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			</form>

			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="center">
						<img src="images/b_order4.gif" onclick="Check_Value()" style="cursor:hand">

						

					</td>
				</tr>
				<tr height="20"><td></td></tr>
			</table>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
?>