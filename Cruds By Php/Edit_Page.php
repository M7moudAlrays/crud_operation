<?php

    $con = mysqli_connect('localhost','root','','blogin') ;
        if(!$con)
        {
          echo mysqli_connect_error();
          exit ;
        }

    // Select User To Edit 

    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT) ;
    $que = "select * from users where id = '".$id."' " ;
    $res =mysqli_query($con , $que) ;
    $row = mysqli_fetch_assoc($res) ; 

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
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT) ;
        $name = mysqli_escape_string($con , $_POST['name']) ;
        $email = mysqli_escape_string($con , $_POST['mail']) ;
        $PassWord =  sha1($_POST['pass']) ;
        $domain  = (isset($_POST['doamin']))? 1:0 ;
      
        $query = "update  users  set name = '".$name."' , email = '".$email."'
                 , password ='".$PassWord."'  where id ='".$id."' " ;
                 

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
    <title> Edit Users Page </title>

    <body>
    <form method="POST">
      <!-- <label for="name">Your id </label> -->
      <input type="hidden" name="id" 
      value="<?= (isset($row['id']) ? ($row['id']) : 'Not Found')?>">
      
      <label for="name">Your Name </label>
      <input type="text" name='name' id='name' autocomplete="no" 
      value="<?= (isset($row['name']) ? ($row['name']) : 'Not Found')?>"> 
      <?php if (in_array('name', $errors))
      {
        echo 'Pleaze enter Your name';
      } 
      ?></br> </br> 
      <label for="mail"> Your Email </label>
      <input type="email" name='mail' id='mail' autocomplete="no"
      value="<?= isset($row['email']) ? $row['email'] :'Not Found'?>"> 
      <?php if (in_array('mail', $errors))
      {
        echo 'Pleaze enter Valid Mail';
      } 
      ?></br> </br>
      <label for="pass"> Pass_Word </label>
      <input type="password" name='pass' id='pass'autocomplete="no"
      value ="<?= isset($row['password']) ? $row['password'] :'No Pass' ?>"> 
      <?php if (in_array('pass', $errors))
      {
        echo 'Your Pass Dont Matched';
      } 
      ?></br> </br>
      <input type="checkbox" name="domain" <?= (isset($_post['domain'])) ? 'checked' : ''?> > Domain
      <input type="submit" value="Login">
  </form>
    </body>
</html>
