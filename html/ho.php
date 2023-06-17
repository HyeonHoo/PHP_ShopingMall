<?
include "common.php";
$no=$_REQUEST[no];
?>
<?
		$query="select * from jumun where no63='$no';";
			$result=mysqli_query($db,$query);     
			 if (!$result) exit("에러:$query");                
			 $count=mysqli_num_rows($result); 
			 $row=mysqli_fetch_array($result);
//"jumunday63=". DATE(attr_date) <='$day1' AND DATE(attr_date) >='$day'. "and" . $tmp;
			 
			 
					/*
		$query = "select no63 from jumun where jumunday63=curdate() order by no63 desc limit 1";
			   $result=mysqli_query($db,$query);     
			   if (!$result) exit("에러:$query");                
			   $count=mysqli_num_rows($result); 
			   $row=mysqli_fetch_array($result);
/*
			         //    jumun 테이블에서 오늘 주문 중, 가장 큰 주문번호 값 조사.
			if ($count>0) {     // 주문번호가 있으면
			$jumun_no = (int)$row[no63]+1;
			}	// 새주문번호 = 가장 큰 주문번호 +1 
			else{
			$jumun_no = date("ymd") . "0001";}
			
			$num = 3;
			$name="한우";
			$product_names="한우";
			 $product_nums=0;
			 $product_nums = $product_nums + $n_cart;
			 if ($product_nums > 1)      // 제품수가 2개 이상인 경우만, "외 ?" 추가
							{
								$tmp = $product_nums;
								$product_names = $product_names . " 외 " . $tmp;
							}
							else{ 
								$product_names = $name;
							}


		echo $jumun_no;
		echo $product_names;
		echo $product_nums;
		*/
		?>
			 
		
<input type="text" name="day1_y" size="4" value="2020">
<select name="day1_m" value="<?=$day1_m; ?>">
		<?
				for($i=0; $i<$n_day1_m; $i++)
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
				
				for($i=0; $i<$n_day1_d; $i++)
				{ 
					if($i==$day1_d)
				echo("<option value='$i'selected>$a_day1_d[$i]</option>");
			else
				echo("<option value='$i'>$a_day1_d[$i]</option>");
				}
				echo("</select>");
				?>-
<input type="text" name="day2_y" size="4" value="2020">
<select name="day2_m" value="<?=$day2_m; ?>">
<?

				for($i=0; $i<$n_day2_m; $i++)
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
				
				for($i=0; $i<$n_day2_d; $i++)
				{ 
					if($i==$day2_d)
				echo("<option value='$i'selected>$a_day2_d[$i]</option>");
			else
				echo("<option value='$i'>$a_day2_d[$i]</option>");
				}
				echo("</select>");
				?>
				








