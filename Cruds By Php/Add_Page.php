<?php

$errors = array() ;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(!(isset($_POST['name']) && !empty($_POST['name'])))
    {
        $errors [] ='name' ;
    }

    if(!(isset($_POST['mail']) && filter_input(INPUT_POST,'mail',FILTER_VALIDATE_EMAIL)))
    {
        $errors [] ='mail' ;
    }
    if(!(isset($_POST['pass']) && strlen($_POST['pass']) > 6 ))
    {
        $errors [] ='pass' ;
    }

    if (!$errors)
    {
        $con = mysqli_connect('localhost','root','','blogin') ;
        if(!$con)
        {
          echo mysqli_connect_error();
          exit ;
        }
      
        $name =mysqli_escape_string($con , $_POST['name']) ;
        $email = mysqli_escape_string($con , $_POST['mail']) ;
        $PassWord =  sha1($_POST['pass']) ;
      
        $query = "insert into users (name , email , password , domain) 
                  values ('".$name."' ,'".$email."','".$PassWord."','".$domain."') " ;
      

        if (mysqli_query($con,$query))
        {
            header("location: list_users.php") ;
            exit ;
        }
       
        else
        {
            echo mysqli_error($con) ;
        }
      
        mysqli_close($con) ;
    }
}

?>
<html>
    <title> Add Users Page </title>

    <body>
    <form method="POST">
      <label for="Nme">Your Name </label>
      <input type="text" name='name' id='name' autocomplete="no"> 
      <?php if (in_array('name', $errors))
      {
        echo 'Pleaze enter Your name';
      } 
      ?></br> </br> 
      <label for="mail"> Your Email </label>
      <input type="email" name='mail' id='mail' autocomplete="no"> 
      <?php if (in_array('mail', $errors))
      {
        echo 'Pleaze enter Valid Mail';
      } 
      ?></br> </br>
      <label for="mail"> Pass_Word </label>
      <input type="password" name='pass' id='pass'autocomplete="no"> 
      <?php if (in_array('pass', $errors))
      {
        echo 'Your Pass Dont Matched';
      } 
      ?></br> </br>
      <input type="checkbox" name="domain" <?= (isset($_post['domain'])) ? 'checked' : '' ?> > Domain
      <input type="submit" value="Login">
  </form>
    </body>
</html>
