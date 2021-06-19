<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> index Page </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
          crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"
            crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="Resoures/Css/bootstrap.css">
    <link rel="stylesheet" href="Resoures/Css/font-awesome.css">
    <link rel="stylesheet" href="Resoures/Css/style.css">
</head>


<body>
<?php

$errors_arr = array();
if(isset($_GET['errors']))
{
    $errors_arr = explode("," , $_GET['errors'])  ;
}
?>

  <form method="POST" action="Process.php">
      <label for="Nme">Your Name </label>
      <input type="text" name='name' id='name' autocomplete="no"> 
      <?php if (in_array('name', $errors_arr))
      {
        echo 'Pleaze enter Your name';
      } 
      ?></br> </br> 
      <label for="mail"> Your Email </label>
      <input type="email" name='mail' id='mail'> 
      <?php if (in_array('mail', $errors_arr))
      {
        echo 'Pleaze enter Valid Mail';
      } 
      ?></br> </br>
      <label for="mail"> Pass_Word </label>
      <input type="password" name='pass' id='pass'> 
      <?php if (in_array('pass', $errors_arr))
      {
        echo 'Your Pass Dont Matched';
      } 
      ?></br> </br>
      <!-- <label for="gender"> Your Gender </label>
      <input type="radio" name="gender" value="Male">
      <input type="radio" name="gender" value="Famle"> </br> </br> -->
      
      <input type="submit" value="Login">
  </form>
<?php

?>
   

    <script src="Resoures/Js/jquery.min.js"></script>
    <script src="Resoures/Js/bootstrap.js"></script>
</body>

</html>