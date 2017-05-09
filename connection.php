<?php

	    // Connection Parameters	
            
	        $dbhost = "localhost";
            $username = "root";
            $password = "";
            $database = "sisoft_exam";
	    
	    // Connect to the mysql server using the connection parameters	
	    $conn = mysqli_connect($dbhost,$username, $password, $database);

            if(! $conn )
            {
                die('Could not connect:$database ' . mysqli_error());
            }

           mysqli_query($conn, "SET NAMES 'utf8'" );

		
			// User database information
			$username1 ="root" ;
			$password1 ="" ;
			$database1 = "livedb" ;

	       $user_conn = mysqli_connect($dbhost,$username1, $password1, $database1);

            if(! $user_conn )
            {
                die('Could not connect:$database1 ' . mysqli_error());
            }

           mysqli_query($user_conn, "SET NAMES 'utf8'" );
			
	                

?>
