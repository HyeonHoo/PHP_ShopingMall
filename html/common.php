<?

	$page_line=5;
	$page_block=5;
	
	$db=mysqli_connect("localhost", "shop63", "1234", "shop63");
	if(!$db) exit("DB연결에러");
	
	$admin_id  = "admin";
    $admin_pw = "1234";
	
	$a_idname=array("전체","이름", "ID");     //  2줄은 common.php에 작성.
	$n_idname=count($a_idname);    
	
	$a_idname1=array("전체","번호", "옵선명");     //  2줄은 common.php에 작성.
	$n_idname1=count($a_idname);   
	
	$a_menu=array("분류선택","돼지고기","소고기","닭고기","달걀","유제품","선물세트","요리상품","보조상품","리뷰","조리방법");
	$n_menu=count($a_menu);          
	
	$a_status=array("상품상태","판매중","판매중지","품절");
	$n_status=count($a_status);    
	
	$a_icon=array("아이콘","New","Hit","Sale");
	$n_icon=count($a_icon);

	$a_text1=array("","제품이름","제품번호");   // for문의 $i는 1부터 시작
	$n_text1=count($a_text1);
	
	$a_sort=array("고가격순 정렬","저가격순 정렬","상품명 정렬","신상품순 정렬");
	$n_sort=count($a_sort);
	
	$baesongbi = 2500;
    $max_baesongbi = 100000;

	$a_state=array("전체","주문신청","주문확인","입금확인", "배송중", "주문완료", "주문취소");
	$n_state=count($a_state);
	
	$a_text1_a=array("","주문번호","고객명","상품명");
	$n_text1_a=count($a_text1_a);
	
	$a_day1_m=array(0,1,2,3,4,5,6,7,8,9,10,11,12);
	$n_day1_m=count($a_day1_m);
	
	$a_day1_d=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
	$n_day1_d=count($a_day1_d);
	
	$a_day2_m=array(0,1,2,3,4,5,6,7,8,9,10,11,12);
	$n_day2_m=count($a_day2_m);
	
	$a_day2_d=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
	$n_day2_d=count($a_day2_d);
	
	

?>
