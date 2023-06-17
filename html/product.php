<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_top.php";
	include "common.php";
?>
<?
	$menu=$_REQUEST[menu];
	$sort=$_REQUEST[sort];

	$query="select * from product where menu63=$menu and status63=1 ";
   $result=mysqli_query($db,$query);     
   if (!$result) exit("에러:$query");                

	 $row=mysqli_fetch_array($result);
	  $menu1=$a_menu[$row[menu63]];
	  $count=mysqli_num_rows($result);  			  // 출력할 제품 개수
?>



<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

      <!-- 하위 상품목록 -->

			<!-- form2 시작 -->
			<form name="form2" method="post" action="product.php">
			<input type="hidden" name="menu" value="<?=$menu;?>">

			<table border="0" cellpadding="0" cellspacing="5" width="767" class="cmfont" bgcolor="#efefef">
				<tr>
					<td bgcolor="white" align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="751" class="cmfont">
							<tr>
								<td align="center" valign="middle">
									<table border="0" cellpadding="0" cellspacing="0" width="730" height="40" class="cmfont">
										<tr>
											<td width="500" class="cmfont">
												<font color="#C83762" class="cmfont"><b><?=$menu1;?> &nbsp</b></font>&nbsp
											</td>
												<table width="800" border="0" cellpadding="0" cellspacing="0" class="cmfont">
													<tr>
														<td align="right"><font color="EF3F25"><b><?=$count;?></b></font> 개의 상품&nbsp;&nbsp;&nbsp</td>
														<td width="5" align="left">
															<select name="sort" size="1" class="cmfont" onChange="form2.submit()">
															<?
															
															if($sort=="new"){
															echo("<option value='new' selected>신상품순 정렬</option>");}
															else{
															echo("<option value='new' >신상품순 정렬</option>");}
															if($sort=="up"){
															echo("<option value='up' selected>고가격순 정렬</option>");}
															else{
															echo("<option value='up' >고가격순 정렬</option>");}
															if($sort=="down"){
															echo("<option value='down' selected>저가격순 정렬</option>");}
															else{
															echo("<option value='down'>저가격순 정렬</option>");}
															if($sort=="name"){
															echo("<option value='name' selected>상품명 정렬</option>");}
															else{
															echo("<option value='name'>상품명 정렬</option>");}
															
																?>
																<?
																if ($sort=="up")            // 고가격순
																 $query="select * from product where menu63=$menu and status63=1 order by price63 desc";
																elseif ($sort=="down")  // 저가격순
																$query="select * from product where menu63=$menu and status63=1 order by price63";
																elseif ($sort=="name")  // 이름순
																$query="select * from product where menu63=$menu and status63=1 order by name63";
																else                              // 신상품순
																 $query="select * from product where menu63=$menu and status63=1 order by no63 desc";
																
																$result=mysqli_query($db,$query);
																if(!$result) exit("에러:$query");
																?>
																
															</select>
													
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<!-- form2 -->
				
				<!--- 1 번째 줄 -->


<?
 $page=$_REQUEST[page];
   if(!$page) $page=1;
   $pages=ceil($count/$page_line);
   $first=1;
   if($count>0) $first=$page_line*($page-1);
   $page_last=$count-$first;
   if($page_last>$page_line) $page_last=$page_line;
   if($count>0) mysqli_data_seek($result,$first);
   
			$num_col=5;   $num_row=4;                   // column수, row수
		$page_line=$num_col*$num_row;       // 1페이지에 출력할 제품수
			$icount=0;       // 출력한 제품개수 카운터
			echo("<table border='0' cellpadding='0' cellspacing='0'>");
			for ($ir=0; $ir<$num_row; $ir++)
			{
				 echo("<tr>");
				 for ($ic=0;  $ic<$num_col;  $ic++)
				{
					 if ($icount <= $page_last-1)
					{
						
						 $row=mysqli_fetch_array($result);
						 $discount = $row[discount63];
						 $price1=number_format($row[price63]);
						  $price=number_format(round($row[price63]*(100-$row[discount63])/100, -3) );
						
						 echo("<td width='200' height='205' align='center' valign='top'>
						<table border='0' cellpadding='0' cellspacing='0' width='150' class='cmfont'>
							<tr> 
								<td align='center'> 
									<a href='product_detail.php?no=$row[no63]'>
									<img src='product/$row[image1]' width='120' height='140' border='0'></a>
								</td>
							</tr>
							<tr><td height='5'></td></tr>
							<tr> 
								<td height='20' align='center'>
									<a href='product_detail.php?no=$row[no63]'><font color='444444'>$row[name63]</font></a>&nbsp; ");
									
									if($row[icon_hit63]==1)   echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
									if($row[icon_new63]==1)   echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
									if($row[icon_sale63]==1) echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'> <font color='red'>$row[discount63]%</font>");
							 if($row[icon_sale63]==0) 
								{   
								   echo("</td></tr>
								<tr><td height='20' align='center'><b> $price1 원</b></td></tr>
							 </table>
								</td>");
								}
								else 
								{
								   echo("
								   </td>
								</tr>
								<tr><td height='20' align='center'><strike>$price1 원</strike><br><b> $price 원</b></td></tr>
							 </table>
							 </td>");
								}
						   }
						   else
							   echo("<td></td>");
						   $icount++;
						 }
						 echo("</tr>");
					   
					}
					echo("</table>");
		 echo("<table width='800' border='0' cellpadding='0' cellspacing='0'>
         <tr>
         <td height='30' class='cmfont' align='center'>");
      
      $blocks = ceil($pages/$page_block);
      $block  = ceil($page/$page_block);
      $page_s = $page_block * ($block-1);
      $page_e = $page_block * $block;
      if($blocks <= $block) $page_e=$pages;
      
      if($block>1)
      {
         $tmp=$page_s;
         echo("<a href='product.php?page=$tmp&menu=$menu&sort=$sort'>
               <img src='images/i_prev.gif' align='absmiddle' border='0'> </a> &nbsp;");
      }
      
      for($i=$page_s+1; $i<=$page_e; $i++)
      {
         If ($page==$i)
            echo("&nbsp;<font ed'> <b>$i</b> </font> &nbsp;");
         else
            echo("&nbsp;<a href='product.php?page=$i&menu=$menu&sort=$sort'>[$i]</a>&nbsp;");
      }
      
      If($block<$blocks)
      {
         $tmp=$page_e+1;
         echo("<a href='product.php?page=$tmp&menu=$menu&sort=$sort'>
               <img src='images/i_next.gif' align='absmiddle' border='0'>
              </a>");
      }
      echo("   </td>
           </tr>
           </table>");
?>
			


<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
?>