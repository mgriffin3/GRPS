<?php




    $servername = "localhost";
	
	//password and user needs to match in both databases
    $username = "root";
    $password = "";
	
    $dbname1 = "queue";
	$dbname2 = "scraper";
    $tablename1 ="projecteuler";
	$challengeTable = "challenges";
  

   
    //this connects to the scrapped database,
    $conn = new mysqli($servername, $username, $password, $dbname1);
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
      }
      echo "Connected successfully\n";
	  
	//connect to the user database  
	$dbcon = new mysqli($servername, $username, $password,$dbname2);
        if ($dbcon->connect_error) {
            die("Connection failed: " . $conn2->connect_error);
        }
        echo "Connected successfully\n";
		

   function copyandstore($tablename,$userTable,$db,$conn){
	   //this function should be called for every table in the scraper database. It copys data from the database and into the user database
		
	   
	   $rows= $conn->query("SELECT * FROM `projecteuler`");
	      
	   while($row=mysqli_fetch_assoc($rows))
	   {
		   $title = $row["title"];
		   $description = $row["text"];
		   
		  $db->query("INSERT INTO challenges (title,difficulty,description,solved,hint,note) 
			 VALUES ('".$title . "','easy','".$description. "',0,'none','none')");
	   
	   }
   }
   //add a call for each website table
   copyandstore($tablename1,$challengeTable,$dbcon,$conn);
   
?>