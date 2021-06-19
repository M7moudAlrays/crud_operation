<html>
    <head>
        <title> List </title>
        <link rel="stylesheet" href="../Resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Resources/css/font-awesome.css">
    </head>
        <script src="../Resources/js/bootstrap.min.js"></script>
        <script src="../Resources/js/jquery.min.js"></script>
    <body> 
<?php
    include ('Mysqli_con.php') ;

    // $con = mysqli_connect('localhost','root','','blogin') ;
    // if(!$con)
    // {
    // echo mysqli_connect_error();
    // exit ;
    // }

    $query = "select * from users" ;
    $result = mysqli_query($con , $query) ;

    
  
  mysqli_close($con) ;
  // {
    //     header('Location: form.php? errors='. implode("," , $errors)) ;
    //     exit ;
    // }
?>

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
                <td><a class="btn btn-info" href="edit.php?id=<?=$row['id']?>">edit </a>
                    <a class="btn btn-danger" href="delete.php?id=<?=$row['id']?>">delete</a> 
                </td>
            </tr>
           
            </tbody>
            <?php   }  ?>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center"> <?= 'Number Of Users Is '.mysqli_num_rows($result) ?> Users</td>
                    <td colspan="3" class="text-center"> <a class="btn btn-success" href="Add_page.php"> Add New User </a> </td>
                </tr>
            </tfoot>

            </table>

</body>
</html>