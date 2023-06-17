<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<? 
	include "../common.php"; 
	$text1 = $_REQUEST[text1];
	$sel1 =  $_REQUEST[sel1];
?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_new()
	{
		location.href="opt_new.php";
	}
</script>
</head>

<body style="margin:0">

<center>
<br>
<script> document.write(menu());</script>

<?
	if(!$text1)
		  $query="select * from opt order by no63;";
   else
      if($sel1==1)
         $query="select * from opt where no63 like '%$text1%' order by no63;";
	  else
         $query="select * from opt where name63 like '%$text1%' order by name63;";  
    

   $result=mysqli_query($db,$query);         //sql실행
   if(!$result) exit("에러:$query");            //에러 조사


   $count=mysqli_num_rows($result);   //레코드개수
?>


<table width="500" border="0" cellspacing="0" cellpadding="0">
<form name="form1" method="post" action="opt.php">
	<tr>
		<td align="left"  width="250" height="50" valign="bottom">&nbsp 옵션수 : <font color="#FF0000"><?=$count;?></font></td>
		<td align="right" width="250" height="50" valign="bottom">
<?
            echo("<select name='sel1'>");
            for($i=1; $i<$n_idname1;$i++)
            {
               if($sel1==$i)
                  echo("<option value='$i' selected>$a_idname1[$i]</option>");
               else
                  echo("<option value='$i'>$a_idname1[$i]</option>");
            }
            echo("</select>");
         ?>
		 	<input type="text" name="text1" size="15" value="<?=$text1;?>" class="font9">&nbsp
		</td>
		<td width="60" valign="bottom">
			<input type="button" value="검색" onclick="javascript:form1.submit();">&nbsp
		</td>
		</form>
			<input type="button" value="신규입력" onclick="javascript:go_new();"> &nbsp
		</td>
	</tr>
	<tr><td height="5" colspan="2"></td></tr>

</table>

<table width="500" border="1" cellpadding="2"  style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="20"> 
		<td width="50"  align="center"><font color="#142712">번호</font></td>
		<td width="250" align="center"><font color="#142712">옵션명</font></td>
		<td width="100" align="center"><font color="#142712">수정/삭제</font></td>
		<td width="100" align="center"><font color="#142712">소옵션편집</font></td>
	</tr>
	
	 <?

   $page=$_REQUEST[page];
   if(!$page) $page=1;
   $pages=ceil($count/$page_line);
   $first=1;
   if ($count>0) $first=$page_line*($page-1);
   $page_last=$count - $first;
   if ($page_last>$page_line) $page_last=$page_line;

   if ($count>0) mysqli_data_seek($result,$first);

   for($i=0;$i<$page_last;$i++)
   {
      
      $row=mysqli_fetch_array($result);
     
      echo(" <tr bgcolor='#F2F2F2' height='20'> 
            <td width='50'  align='center'>$row[no63]</td>
            <td width='250'  align='left'>$row[name63]</td>
            <td width='100' td align='center'>
               <a href='opt_edit.php?no1=$row[no63]&page=$page&sel1=$sel1&text1='>수정</a>/
               <a href='opt_delete.php?no1=$row[no63]&page=$page&sel1=$sel1&text1=' onclick='javascript:return confirm(\"삭제할까요 ?\");'>삭제</a>
            </td>
		   <td width='100' align='center'><a href='opts.php?no1=$row[no63]'>소옵션편집</a></td>
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
         echo("<a href='opt.php?page=$tmp&sel1=$sel&text1=$text1'>
               <img src='images/i_prev.gif' align='absmiddle' border='0'> </a> &nbsp;");
      }
      
      for($i=$page_s+1; $i<=$page_e; $i++)
      {
         If ($page==$i)
            echo("&nbsp;<font ed'> <b>$i</b> </font> &nbsp;");
         else
            echo("&nbsp;<a href='opt.php?page=$i&sel1=$sel&text1=$text1'>[$i]</a>&nbsp;");
      }
      
      If($block<$blocks)
      {
         $tmp=$page_e+1;
         echo("<a href='opt.php?page=$tmp&sel1=$sel1&text1=$text1'>
               <img src='images/i_next.gif' align='absmiddle' border='0'>
              </a>");
      }
      echo("   </td>
           </tr>
           </table>");
           
?>

</table>

<br>
</center>

</body>
</html>