<?
include "common.php";
date_default_timezone_set('Asia/Seoul');
		$no=$_REQUEST[no];
			$opts1=$_REQUEST[opts1];
			$opts2=$_REQUEST[opts2];
			$num=$_REQUEST[num];
			$cart=$_COOKIE[cart];
			$n_cart=$_COOKIE[n_cart];
			$cookie_no=$_COOKIE[cookie_no];
	
	$o_no=$_REQUEST[o_no];						
	$o_etc=$_REQUEST[o_etc];
	$o_name=$_REQUEST[o_name];
	$o_tel=$_REQUEST[o_tel];
	$o_phone=$_REQUEST[o_phone];
	$o_email=$_REQUEST[o_email];
	$o_zip=$_REQUEST[o_zip];
	$o_addr=$_REQUEST[o_addr];
	$r_name=$_REQUEST[r_name];
	$r_tel=$_REQUEST[r_tel];
	$r_phone=$_REQUEST[r_phone];
	$r_email=$_REQUEST[r_email];
	$r_zip=$_REQUEST[r_zip];
	$r_addr=$_REQUEST[r_addr];
	
	 $pay_method=$_REQUEST[pay_method];
	 $card_okno=$_REQUEST[card_okno]; 
	 $card_halbu=$_REQUEST[card_halbu];
	 $card_kind=$_REQUEST[card_kind];
	 $bank_kind=$_REQUEST[bank_kind];
	 $bank_sender=$_REQUEST[bank_sender];
	 $total_cash=$_REQUEST[total_cash];
	 $member_no=$_REQUEST[member_no];
	 $jumunday=$_REQUEST[jumunday];
?>
<?
			$query = "select no63 from jumun where jumunday63=curdate() order by no63 desc limit 1";
			   $result=mysqli_query($db,$query);     
			   if (!$result) exit("에러:$query");                
			   $count=mysqli_num_rows($result); 
			   $row=mysqli_fetch_array($result);

			         //    jumun 테이블에서 오늘 주문 중, 가장 큰 주문번호 값 조사.
			if ($count>0) {     // 주문번호가 있으면
			$jumun_no = (int)$row[no63]+1;
			}	// 새주문번호 = 가장 큰 주문번호 +1 
			else{
			$jumun_no = date("ymd") . "0001";}

						   
				 $total=0;
				$product_nums = 0;
				$product_names = "";
				for ($i=1;  $i<=$n_cart;  $i++)
				{
				   if ($cart[$i]) // 제품정보가 있는 경우만
				   {
					   list($no, $num, $opts1, $opts2)=explode("^", $cart[$i]);	 // • 장바구니 cookie에서 제품번호, 수량, 소옵션번호1,2 알아내기
					  
					  $query="select * from product where no63=$no"; 			//• 제품정보(제품번호, 단가, 할인여부, 할인율) 알아내기
					    $result=mysqli_query($db,$query);     
					   if (!$result) exit("에러:$query");                
					   $row=mysqli_fetch_array($result);							//   (주문번호, 제품번호, 수량, 단가, 금액, 할인율, 소옵션번호1,2)
					   $product_no=$row[no63];
					   $price=$row[price63];
					   $icon_sale=$row[icon_sale63];
					   $discount=$row[discount63];
					   $name=$row[name63];
					    
						$query1 = "select * from opts where no63=$opts1";
						$result1=mysqli_query($db,$query1);     
						if (!$result) exit("에러1:$query1");                 
						$row1=mysqli_fetch_array($result1);
						$opts1_n=$row1[name63];
						  
						$query2 = "select * from opts where no63=$opts2";
						$result2=mysqli_query($db,$query2);     
						if (!$result2) exit("에러2:$query2");                 
						$row2=mysqli_fetch_array($result2);
						$opts2_n=$row2[name63];	
						
						
						if ($cookie_no){
						$member_no=$cookie_no;}
						else{
						$member_no=0;}
						
						if($row[icon_sale63] == 0){				//• 총금액 = 총금액 + 금액;
						$t_price = $price * $num;}
						else{
						$price=round($price*(100-$row[discount63])/100, -3); 
						$t_price = $price * $num;}
	
						$total=$total+$t_price;
						
						// • insert SQL문을 이용하여 jumuns 테이블에 저장.
						$query3="insert into jumuns ( jumun_no63, product_no63, num63, price63, cash63, discount63, opts_no1, opts_no2)							
									values ('$jumun_no', $no, $num, $price, $t_price, $discount, $opts1, $opts2);";									  											
						$result3=mysqli_query($db,$query3);
						if(!$result3) exit("에러;$query3");


						}
				} 
					  $n_cart=$_COOKIE[n_cart];						
						$product_names = $name;
						$product_nums = $product_nums + $n_cart;
					   if ($product_nums==1) $product_names = $name;
			
					  if ($product_nums>1)      // 제품수가 2개 이상인 경우만, "외 ?" 추가
							{
								$tmp = $product_nums;
								$product_names = $product_names . " 외 " . $tmp;
							}
			
				

					if ($total<$max_baesongbi) 				//• insert SQL문을 이용하여 jumuns테이블에 배송비 정보 저장. (주문_번호, 0, 1, 배송비, 배송비, 0, 0, 0,)
					{	
						$query4="insert into jumuns ( jumun_no63, product_no63, num63, price63, cash63, discount63, opts_no1, opts_no2)							
														values ('$jumun_no', 0, 1,$baesongbi, $baesongbi, 0, 0, 0);";									  											
						$result4=mysqli_query($db,$query4);
						if(!$result4) exit("에러;$query4");
    
}
					$jumunday= date("ymd");

				if ($total > $max_baesongbi) {
										$total_b=$total;}
										else{
										  $total_b=$total+$baesongbi;}
										  
				if($pay_method==0){
					$card_okno=$jumun_no;
				}
				else{
					$card_okno="";
				}
										  
					$query5="insert into jumun ( no63, member_no63, jumunday63, product_names63, product_nums63, 
															  o_name63, o_tel63, o_phone63, o_email63, o_zip63, o_juso63, 
															  r_name63, r_tel63, r_phone63, r_email63, r_zip63, r_juso63, memo63,
															  pay_method63, card_okno63, card_halbu63, card_kind63, 
															  bank_kind63, bank_sender63,
															  total_cash63, state63)							
						values ('$jumun_no', $member_no,  $jumunday, '$product_names', $product_nums, 
															  '$o_name', '$o_tel', '$o_phone', '$o_email', '$o_zip', '$o_addr', 
															  '$r_name', '$r_tel', '$r_phone', '$r_email', '$r_zip', '$r_addr', '$o_etc',
															  $pay_method, '$card_okno', $card_halbu, $card_kind, 
															  $bank_kind, '$bank_sender',
															  $total_b, 1);";									  											
						$result5=mysqli_query($db,$query5);
						if(!$result5) exit("에러;$query5");
						
						setcookie("n_cart","");		// • 장바구니 cookie에서 제품 정보 삭제.	
						$n_cart = 0;
						

echo("<script>location.href='order_ok.php?'</script>");

				
   
?>
