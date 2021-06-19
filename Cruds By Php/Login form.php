<?php
include('Mysqli__Con.php') ;
session_start();

if($_SERVER['REQUEST_METHOD']=='POST')
{
    // $con = mysqli_connect('localhost','root','','blogin') ;
    // if(!$con)
    // {
    //   echo mysqli_connect_error();
    //   exit ;
    // }

    $email = mysqli_escape_string($con , $_POST['mail']) ;
    $PassWord =  sha1($_POST['pass']) ;
    
    $query = "select * from users where email = '".$email .
             "' and password='".$PassWord."' " ;

    $result =mysqli_query($con , $query) ;

    if ($row = mysqli_fetch_assoc($result))
    {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'] ;
        $_SESSION['user_name'] =$row ['name'] ;
        echo  'Ok This valid Email You Will Be redirected to List Page After 5 Seconds' ;
        header("refresh: 5 ; url=list_users.php") ;
        exit ;
    } 

    else
    {
        echo  'Sorry This Invalid Email You Will Be redirected to Add Page After 5 Seconds' ;
        header("refresh: 5 ; url=Add_Page.php ") ;
    }
    mysqli_free_result($result) ;
    mysqli_close($con) ;
}

?>
<html>
<title> Login Form </title>

<body>

<form method="POST">
    <label>Your Email</label>
    <input type="email" name="mail"> </br></br>
    <label>Pass  Word</label>
    <input type="password" name="pass" >
    <input type="submit" value="Login">
    
</form>
</body>
</html>

