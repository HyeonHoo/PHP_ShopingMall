<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
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
	?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language = "javascript">

			function cart_edit(kind,pos) {
				if (kind=="deleteall") 
				{
					location.href = "cart_edit.php?kind=deleteall";
				} 
				else if (kind=="delete")	{
					location.href = "cart_edit.php?kind=delete&pos="+pos;
				} 
				else if (kind=="insert")	{
					var num=eval("form2.num"+pos).value;
					location.href = "cart_edit.php?kind=insert&pos="+pos+"&num="+num;
				}
				else if (kind=="update")	{
					var num=eval("form2.num"+pos).value;
					location.href = "cart_edit.php?kind=update&pos="+pos+"&num="+num;
				}
			}

			</script>

			<!-- form2 시작  -->
			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" width="746">
				<tr>
					<td height="30" align="left"><img src="images/cart_title.gif" width="900" height="30" border="0"></td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
			</table>



			<table border="0" cellpadding="0" cellspacing="0" width="900">
				<tr><td height="10"></td></tr>
			</table>

			<table border="0" cellpadding="5" cellspacing="1" width="900" class="cmfont" bgcolor="#CCCCCC" align="center">
				<tr bgcolor="F0F0F0" height="23" class="cmfont">
					<td width="420" align="center">상품</td>
					<td width="70"  align="center">수량</td>
					<td width="80"  align="center">가격</td>
					<td width="90"  align="center">합계</td>
					<td width="50"  align="center">삭제</td>
				</tr>

				<form name="form2" method="post">
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
					<td align='center' bgcolor='#FFFFFF'>
						<input type='text' name='num$i' size='3' value='$num' class='cmfont1'>&nbsp<font color='#464646'>개</font>
					</td> 
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$price1</font></td>
					<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$t_price_n</font></td>
					<td align='center' bgcolor='#FFFFFF'>
						<a href = 'javascript:cart_edit(\"update\",$i)'><img src='images/b_edit1.gif' border='0'></a>&nbsp<br>
						<a href = 'javascript:cart_edit(\"delete\",$i)'><img src='images/b_delete1.gif' border='0'></a>&nbsp
					</td>
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
			<!-- form2 끝  -->
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont" align="center">
				<tr height="44">
					<td width="700" align="center" valign="middle">
						<a href="index.html"><img src="images/b_shopping.gif" border="0"></a>&nbsp;&nbsp;
						<a href="javascript:cart_edit('deleteall',0)"><img src="images/b_cartalldel.gif" width="103" height="26" border="0"></a>&nbsp;&nbsp;
						<a href="order.php"><img src="images/b_order1.gif" border="0"></a>
					</td>
				</tr>
			</table>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
?>