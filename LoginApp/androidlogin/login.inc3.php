<?php

	 include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['username']) && isset($_POST['password']))
     {
		  // Innitialize Variable
		  $result='';
	   	  $username = $_POST['username'];
          $password = $_POST['password'];
		  
		  // Query database for row exist or not
          $sql = 'SELECT * FROM tbl_login WHERE  email = :username AND password = :password';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR);
          $stmt->bindParam(':password', $password, PDO::PARAM_STR);
          $stmt->execute();
          if($stmt->rowCount())
          {
			 $result="false";	
          }  
          elseif(!$stmt->rowCount()){
			  $sql = "INSERT INTO tbl_login (username, password) VALUES (?,?)";
			  $stmt = $conn->prepare($sql);
			  $stmt->execute([$username, $password]);
			  $result="true";
          }		  
		  // send result back to android
   		  echo $result;
  	}
	
?>