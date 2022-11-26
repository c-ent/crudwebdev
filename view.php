
<?php
include 'connect.php';
$id=$_GET['updateid'];
$sql="Select * from crud where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
$address=$row['address'];
$age=$row['age'];

    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $address=$_POST['address'];
        $age=$_POST['age'];

        $sql="update crud set id=$id, name='$name', address='$address', age='$age'
        where id=$id";

        $result=mysqli_query($con,$sql);

        if($result){
            echo
            '<div class="alert alert-primary" role="alert">
            Updated Succesfully
            </div>';
        }else{
            die(mysqli_error($con));
        }
    }


?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>
  <body>
        <div class="container mt-4">
            <h1>User <?=$row['name'];?>
                <a href="index.php" type="button" class="btn btn-danger mb-3 float-end">Back</a>
            </h1>

            <form method="post">
                <div class="mb-3">
                    <label>Name</label>
                    <p class="form-control">
                        <?=$row['name'];?>
                    </p>
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <p class="form-control">
                        <?=$row['address'];?>
                    </p>
                    </div>

                <div class="mb-3">
                    <label>Age</label>
                    <p class="form-control">
                        <?=$row['age'];?>
                    </p>
                    </div>

                
            </form>



        </div>

  </body>
</html>