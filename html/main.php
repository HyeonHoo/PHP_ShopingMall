<?
	include "main_top.php";
	include "../common.php";
?>
<?
	
	$discount=$_REQUEST[discount];
	$query="select * from product  where icon_new63=1 and status63=1  order by rand()  limit 15";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");


?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

<!---- 화면 우측(신상품) 시작 -------------------------------------------------->	
 <table width="100" height="50" border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr><td height='10'></td></tr>
   
   
<tr><td height='2'></td></tr>
<table width="100" height="50" border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr><td height='10'></td></tr>
   
   <tr><td height="2" bgcolor="#111111"></td></tr>
     <tr>     
     <font color="#111111"> <p style="text-align:center;"><b>신상품</b> </font> </p>                          
</tr>   
			
<?
			$num_col=3;   $num_row=5;                   // column수, row수
			$count=mysqli_num_rows($result);           // 출력할 제품 개수
			$icount=0;       // 출력한 제품개수 카운터
			echo("<table border='0' cellpadding='0' cellspacing='0'>");
			for ($ir=0; $ir<$num_row; $ir++)
			{
				 echo("<tr>");
				 for ($ic=0;  $ic<$num_col;  $ic++)
				{
					 if ($icount < $count)
					{
						
						 $row=mysqli_fetch_array($result);
						 $discount = $row[discount63];
						 $price1=number_format($row[price63]);
						 
						
						 echo("<td width='500' height='400' align='center' valign='top'>
						<table border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>
							<tr> 
								<td align='center'> 
									<a href='product_detail.php?no=$row[no63]'>
									<img src='product/$row[image1]' width='315' height='315' border='0.5'></a>
								</td>
							</tr>
							<tr><td height='20'></td></tr>
							<tr> 
								<td width='100' height='20' align='center'>
									<a href='product_detail.php?no=$row[no63]'><font color='444444' size = '3'>$row[name63]</font></a>&nbsp; 
									<img src='images/i_hit.gif' align='absmiddle' vspace='15'> 
									<img src='images/i_new.gif' align='absmiddle' vspace='15'><br> ");
						if ($row[icon_sale63] == 1){

							$price=number_format(round($row[price63]*(100-$discount)/100, -3) );
							echo("
									<img src='images/i_sale.gif' align='absmiddle' vspace='1'> <font color='red' size = '5'>$discount</font>%
								</td>
							</tr>
							<tr><td height='20' align='center' size = '5' ><font color='444444' size = '3'><strike>$price1</strike></font><b><br>
							<font color='444444' size = '3'>$price</font></br></b></td></tr>
						</table>
						</td>");}
					else
								echo("
									
								</td>
							</tr>
							<tr><td height='20' align='center' size = '5' ><font color='444444' size = '3'>$price1</td></tr></font>
						</table>
					</td>");
						
					 }
					 else
						 echo("<tr><td height='10'></td></tr>");      // 제품 없는 경우
					 $icount++;
				 }
				echo("</tr>");
			}
			echo("</table>");
?>
</table>

			<!---- 화면 우측(신상품) 끝 -------------------------------------------------->	
		
			

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?
	include "main_bottom.php";
?>