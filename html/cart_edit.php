<?
		include "common.php";
		$no=$_REQUEST[no];
			$opts1=$_REQUEST[opts1];
			$opts2=$_REQUEST[opts2];
			$num=$_REQUEST[num];
			$cart=$_COOKIE[cart];
			$n_cart=$_COOKIE[n_cart];
			$kind=$_REQUEST[kind];
			$pos=$_REQUEST[pos];
?>
<?		


			if (!$n_cart) $n_cart=0;   // 제품개수 0으로 초기화
			switch ($kind) {
				case "insert":      // 장바구니 담기
				case "order":      // 바로 구매하기
					  $n_cart++;
					  $cart[$n_cart] = implode("^", array($no, $num, $opts1, $opts2));			// 제품정보 합치기.				
						setcookie("cart[$n_cart]",$cart[$n_cart]);											// 제품정보, 개수($cart[$n_cart], $n_cart) 쿠키로 저장.
						setcookie("n_cart",$n_cart);
					 break;
					 
				case "delete":      // 제품삭제
						$pos=$_REQUEST[pos];
						setcookie("cart[$pos]","");       // $cart[$pos] 쿠키 삭제.
					 break;
	
			case "update":     // 수량 수정	 
					   list($no, $num, $opts1, $opts2)=explode("^", $cart[$pos]); 				// $pos번째 제품번호, 옵션값들 알아내기.
					   $num=$_REQUEST[num];
						$cart[$pos] = implode("^", array($no, $num, $opts1, $opts2));	  //이전 값에 새 수량으로 제품정보 합치기.
					    setcookie("cart[$pos]",$cart[$pos]);									//$pos번째에 제품정보 저장.
					 break;
	
				case "deleteall":    // 장바구니 전체 비우기
					 for($i=1;$i<=$n_cart;$i++)
						{ if ($cart[$i])
							setcookie("n_cart","");}
					 $n_cart = 0  ;
			}

			if ($kind=="order")
				echo("<script>location.href='order.php'</script>");   //주문/배송지 입력 화면(order.php)으로 이동.
			else
				echo("<script>location.href='cart.php'</script>");  //장바구니 화면(cart.php)으로 이동.

?>