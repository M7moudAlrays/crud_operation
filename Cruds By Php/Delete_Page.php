
<?php

$con = mysqli_connect('localhost','root','','blogin') ;
    if(!$con)
    {
      echo mysqli_connect_error();
      exit ;
    }

// Select User To Delete It 

$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT) ;
$query = "delete from users where id = '".$id."' " ;
$row =mysqli_query($con , $query) ;


    if (mysqli_query($con,$query))
    {
        // header("location: list_users.php") ;
        // exit ;
        echo 'This User Deleted From The Table' ;
    }
   
    else
    {
        echo mysqli_error($con) ;
    }
  
    mysqli_close($con) ;

?>
<html>
<title> Delete Users Page </title>

<body>

 <!-- <label for="name">Your id </label> -->
 <input type="hidden" name="id" >
</body>
</html>
