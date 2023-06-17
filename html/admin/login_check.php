<?
		include "../common.php";
		
		$admin_id = $_REQUEST[admin_id];
		$admin_pw = $_REQUEST[admin_pw];

		
		if ($adminid == $admin_id && $adminpw == $admin_pw) 
		{
		    setcookie("$cookie_admin","yes");				//$cookie_admin변수에 "yes"로 쿠키 저장.
			
		   		echo("<script>location.href='member.php'</script>");  //member.html로 이동.   
				}
		Else {
		     setcookie("$cookie_admin","");								//$cookie_admin변수 삭제.
			 
		   echo("<script>location.href='index.html'</script>");			//index.html로 이동.    
		   }
?>