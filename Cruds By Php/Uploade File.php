
<?php

$con = mysqli_connect('localhost','root','','blogin') ;
    if(!$con)
    {
      echo mysqli_connect_error();
      exit ;
    }

$uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/Uploads' ;


$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT)  ;
$row =mysqli_query($con , $query) ;
$name =mysqli_escape_string($con , $_POST['name']) ;
$email = mysqli_escape_string($con , $_POST['mail']) ;
$PassWord =  sha1($_POST['pass']) ;
$domain  = (isset($_POST['doamin'])) ? 1 : 0 ;

$query = "insert into users (name , email , password ,avatar, domain) 
          values ('".$name."' ,'".$email."','".$PassWord."','".$domain."') " ;

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
