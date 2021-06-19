
<?php

session_start() ;
if(isset($_SESSION['user_id']))
{
    echo 'Welcom Mr {'.$_SESSION['user_name'] .'}  
          Your Mail Is {' .$_SESSION['user_email'] ."}" ;
    echo '  <a class="btn btn-danger" href="Logout.php"> Logout </a>' ;
}
else
{
    header('location: login form.php');
}
    $con = mysqli_connect('localhost','root','','blogin') ;
    if(!$con)
    {
    echo mysqli_connect_error();
    exit ;
    }

    $query = "select * from users" ;

    if (isset($_GET['search']))
    {
        $search = mysqli_escape_string($con, $_GET['search']) ;
        $query.=" where name like '%".$search."%' or email like '%".$search."%' " ;
    }
    $result = mysqli_query($con , $query) ;
    mysqli_close($con) ;
?>
<html>
    <head>
        <title> List </title>
        <link rel="stylesheet" href="Resources/css/bootstrap.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
              crossorigin="anonymous">

        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" 
                crossorigin="anonymous">
        </script>

    </head>


    <body> 
        <h1 class="text-center"> List Users </h1>
        <form method="GET">
            <input type="text" name="search" placeholder="Enter Search Name">
            <input type="submit" value="Search">
        </form>

        <table class="table table-hover table-border ">
            
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Domain</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
    while ($row = mysqli_fetch_assoc($result)) {
?>
            <tr>    
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['domain'] ? 'YES' : 'No' ?></td>
                <td><a class="btn btn-info" href="Edit_page.php?id=<?=$row['id']?>">edit </a>
                    <a class="btn btn-danger" href="Delete_page.php?id=<?=$row['id']?>">delete</a> 
                </td>
            </tr>
           
            </tbody>
            <?php   }  ?>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center"> <?= 'Number Of Users Is '.mysqli_num_rows($result) ?> Users</td>
                    <td colspan="3" class="text-center"> 
                        <a class="btn btn-success" href="add_page.php"> 
                            <i class="fas fa-plus-circle "></i> Add New User
                        </a> 
                    </td>
                </tr>
            </tfoot>
            
            </table>

</body>
</html>