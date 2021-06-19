<html>
    <title> Form </title>
</html>

<?php

$errors = array() ;
    if(!(isset($_POST['name']) && !empty($_POST['name'])))
    {
        $errors [] ='name' ;
    }

    if(!(isset($_POST['mail']) && filter_input(INPUT_POST,'mail',FILTER_VALIDATE_EMAIL)))
    {
        $errors [] ='mail' ;
    }
    if(!(isset($_POST['pass']) && strlen($_POST['pass'])>6))
    {
        $errors [] ='pass' ;
    }

    if($errors)
    {
        header('Location: form.php? errors='. implode("," , $errors)) ;
        exit ;
    }

  $con = mysqli_connect('localhost','root','','blogin') ;
  if(!$con)
  {
    echo mysqli_connect_error();
    exit ;
  }

  $name =mysqli_escape_string($con , $_POST['name']) ;
  $email = mysqli_escape_string($con , $_POST['mail']) ;
  $PassWord =  sha1($_POST['pass']) ;

  $query = "insert into users (name , email , password) 
            values ('".$name."' ,'".$email."','".$PassWord."') " ;

  if (mysqli_query($con,$query))
  {
      echo 'Thanks For Register' ;
  }
 
  else
  {
      echo $query ;
      echo mysqli_error($con) ;
  }

  mysqli_close($con) ;

?>