<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";
   $no=$_REQUEST[no];
	$day1_y=$_REQUEST[day1_y];
	$day1_m=$_REQUEST[day1_m];
	$day1_d=$_REQUEST[day1_d];
    $day2_y=$_REQUEST[day2_y];
	$day2_m=$_REQUEST[day2_m];
	$day2_d=$_REQUEST[day2_d];
    $sel1=$_REQUEST[sel1];
	$sel2=$_REQUEST[sel2];
	$text1=$_REQUEST[text1];
	$page=$_REQUEST[page];
	 $start=$_REQUEST[start];
   $end=$_REQUEST[end];

?>
<?
   if(!$sel1) $sel1=0; 
   if(!$sel2) $sel2=0; 
	if(!$text1)   $text1="";
	  
	  $jumunday_y=substr($jumunday,0,4); 
	 $jumunday_m=substr($jumunday,4,2); 
	  $jumunday_d=substr($jumunday,6,2); 
	 
	 $jumunday2_y=substr($jumunday,0,4); 
	  $jumunday2_m=substr($jumunday,4,2); 
	  $jumunday2_d=substr($jumunday,6,2); 

	  

	$k=0;
   
   if(!$day1_y) 
      $day1_y = date("Y");
   
   if(!$day1_m) 
      $day1_m = 1;
   
   if(!$day1_d)
      $day1_d = 1;
   
   if(!$day2_y) 
      $day2_y = date("Y");
   
   if(!$day2_m) 
      $day2_m = date("m");
   
   if(!$day2_d)
      $day2_d = date("d");
   
   $start=$day1_y."-".$day1_m."-".$day1_d;
   $end=$day2_y."-".$day2_m."-".$day2_d;

   if ($start) {$s[$k] = "jumunday63 >= '$start'"; $k++;}
   if ($end) {$s[$k] = "jumunday63 <= '$end'"; $k++;}

   if ($sel1 == 1)     { $s[$k] = "state63=1";      $k++; }
   elseif ($sel1==2)   { $s[$k] = "state63=2";       $k++; }
   elseif ($sel1==3)   { $s[$k] = "state63=3";       $k++; }
   elseif ($sel1==4)   { $s[$k] = "state63=4";       $k++; }
   elseif ($sel1==5)   { $s[$k] = "state63=5";       $k++; }
   elseif ($sel1==6)   { $s[$k] = "state63=6";       $k++; }
   
   if ($text1)
   {
      if ($sel2==1)       { $s[$k] = "no63 like '%" . $text1 . "%'"; $k++; }
      elseif ($sel2==2) { $s[$k] = "o_name63 like '%" . $text1 . "%'"; $k++; }
      elseif ($sel2==3) { $s[$k] = "product_names63 like '%" . $text1 . "%'"; $k++; }
   }
   if ($k> 0)
   {
      $tmp=implode(" and ", $s); 
      $tmp = " where " . $tmp;
   }
   $query="select * from jumun " . $tmp . " order by no63 desc;";

    $result=mysqli_query($db,$query); 
    if (!$result) exit("에러:$query");
    $count=mysqli_num_rows($result);    // 레코드개수
    if ($count != 0)


?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_update(no,pos)
	{
		state=form1.state[pos].value;
		location.href="jumun_update.php?no="+no+"&state="+state+"&page="+form1.page.value+
			"&sel1="+form1.sel1.value+"&sel2="+form1.sel2.value+"&text1="+form1.text1.value+
			"&day1_y="+form1.day1_y.value+"&day1_m="+form1.day1_m.value+"&day1_d="+form1.day1_d.value+
			"&day2_y="+form1.day2_y.value+"&day2_m="+form1.day2_m.value+"&day2_d="+form1.day2_d.value;
	}
</script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>

<form name="form1" method="post" action="jumun.php">
<input type="hidden" name="page" value="<?=$page; ?>">

<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr height="40">
		<td align="left"  width="70" valign="bottom">&nbsp 주문수 : <font color="#FF0000"><?=$count;?></font></td>
		<td align="right" width="730" valign="bottom">
			기간 : 
<input type="text" name="day1_y" size="4" value="<?=$day1_y;?>">
<select name="day1_m" value="<?=$day1_m; ?>">
		<?
				for($i=1; $i<$n_day1_m; $i++)
				{ 
					if($i==$day1_m)
				echo("<option value='$i'selected>$a_day1_m[$i]</option>");
			else
				echo("<option value='$i'>$a_day1_m[$i]</option>");
				}
				
				echo("</select>");
				?>
				

				<select name="day1_d" value="<?=$day1_d; ?>">
				<?
				
				for($i=1; $i<$n_day1_d; $i++)
				{ 
					if($i==$day1_d)
				echo("<option value='$i'selected>$a_day1_d[$i]</option>");
			else
				echo("<option value='$i'>$a_day1_d[$i]</option>");
				}
				echo("</select>");
				?>-
<input type="text" name="day2_y" size="4" value="<?=$day2_y;?>">
<select name="day2_m" value="<?=$day2_m; ?>">
<?

				for($i=1; $i<$n_day2_m; $i++)
				{ 
					if($i==$day2_m)
				echo("<option value='$i'selected>$a_day2_m[$i]</option>");
			else
				echo("<option value='$i'>$a_day2_m[$i]</option>");
				}
				
				echo("</select>");
				?>
				
<select name="day2_d" value="<?=$day2_d; ?>">
				
				<?
				
				for($i=1; $i<$n_day2_d; $i++)
				{ 
					if($i==$day2_d)
				echo("<option value='$i'selected>$a_day2_d[$i]</option>");
			else
				echo("<option value='$i'>$a_day2_d[$i]</option>");
				}
				echo("</select>");
				?>
				&nbsp 
			    <?
				 echo("<select name ='sel1'>");
				 for($i=0;$i<$n_state;$i++)
				 {
					if($i==$sel1)
					   echo("<option value='$i' selected>$a_state[$i]</option>");
					else
					   echo("<option value='$i'>$a_state[$i]</option>");
				 }
				 echo("</select>");
			  ?>
&nbsp 
      <?
         echo("<select name ='sel2'>");
         for($i=1;$i<$n_text1_a;$i++)
         {
            if($i==$sel2)
               echo("<option value='$i' selected> $a_text1_a[$i]</option>");
            else
               echo("<option value='$i'> $a_text1_a[$i]</option>");
         }
         echo("</select>");
      ?>
			<input type="text" name="text1" size="10" value="<?=$text1;?>">&nbsp
			<input type="button" value="검색" onclick="javascript:form1.submit();"> &nbsp;
		</td>
	</tr>
	</tr><td height="5" colspan="2"></td></tr>
</table>

<table width="800" border="1" cellpadding="0" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="70"  align="center">주문번호</td>
		<td width="70"  align="center">주문일</td>
		<td width="250" align="center">상품명</td>
		<td width="50"  align="center">제품수</td>	
		<td width="70"  align="center">총금액</td>
	    <td width="65"  align="center">주문자</td>
		<td width="50"  align="center">결재</td>
		<td width="135" align="center" colspan="2">주문상태</td>
	    <td width="50"  align="center">삭제</td>
	</tr>
	<?
	 $page=$_REQUEST[page];
   if(!$page) $page=1;
   $pages=ceil($count/$page_line);
   $first=1;
   if($count>0) $first=$page_line*($page-1);
   $page_last=$count-$first;
   if($page_last>$page_line) $page_last=$page_line;
   if($count>0) mysqli_data_seek($result,$first);
	

	for($i=0 ; $i<$page_last ; $i++){

         
         $row=mysqli_fetch_array($result);
		 $no=$row[no63];
		 $jumunday=$row[jumunday63];
		 $product_names=$row[product_names63];
		 $product_nums=$row[product_nums63];
		 $total=number_format($row[total_cash63]);
		 $o_name=$row[o_name63];
		 $pay_method=$row[pay_method63];
			$state=$row[state63];
			$color='black';
					if ($state==5)  $color='blue';  // 주문완료 
					if ($state==6)  $color='red';   // 주문취소
	 if($row[pay_method63]==0)
         $pay="카드";
   else 
         $pay="무통장";
		 echo("
	<tr bgcolor='#F2F2F2' height='23'> 
		<td width='70'  align='center'><a href='jumun_info.php?no=$row[no63]'>$no</a></td>
		<td width='70'  align='center'>$jumunday</td>
		<td width='250' align='left'>&nbsp; $product_names</td>	
		<td width='40' align='center'>$product_nums</td>	
		<td width='70'  align='right'>$total&nbsp</td>	
		<td width='65'  align='center'> $o_name</td>	
		<td width='50'  align='center'>$pay</td>
		<td width='85' align='center' valign='bottom'>					
		<select name ='state' style='font-size:9pt; color:$color' >");

				 for($k=1; $k<$n_state; $k++)
				 {
					if($k==$state)
					   echo("<option value='$k' selected>$a_state[$k]</option>");
					else
					   echo("<option value='$k'>$a_state[$k]</option>");
				   
				 }
				 echo("</select> &nbsp;
		</td>
		<td width='50' align='center'>
			<a href='javascript:go_update(\"$no\",$i);'><img src='images/b_edit1.gif' border='0'></a>
		</td>	
		<td width='50' align='center'>
			<a href='jumun_delete.php?no=$no&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m& day2_d=$day2_d
															 &sel1=$sel1&sel2=$sel2&text1=$text1&page=$page' onclick='javascript:return confirm(\"삭제할까요 ?\");'><img src='images/b_delete1.gif' border='0'></a>
		</td>
	</tr> ");
	}
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
         echo("<a href='jumun.php?page=$tmp&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m& day2_d=$day2_d
													 &sel1=$sel1&sel2=$sel2&text1=$text1'>
               <img src='images/i_prev.gif' align='absmiddle' border='0'> </a> &nbsp;");
      }
      
      for($i=$page_s+1; $i<=$page_e; $i++)
      {
         If ($page==$i)
            echo("&nbsp;<font ed'> <b>$i</b> </font> &nbsp;");
         else
            echo("&nbsp;<a href='jumun.php?&page=$i&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m& day2_d=$day2_d
															 &sel1=$sel1&sel2=$sel2&text1=$text1'>[$i]</a>
																&nbsp;");
      }
      
      If($block<$blocks)
      {
         $tmp=$page_e+1;
         echo("<a href='jumun.php?page=$tmp&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m& day2_d=$day2_d
													 &sel1=$sel1&sel2=$sel2&text1=$text1'>
               <img src='images/i_next.gif' align='absmiddle' border='0'>
              </a>");
      }
      echo("   </td>
           </tr>
           </table>");

?></table>


</form>

</center>

</body>
</html>