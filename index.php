<?php
//Add
include 'connect.php';

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $address=$_POST['address'];
    $age=$_POST['age'];

    $sql = "insert into crud (name,address,age)
    values ('$name','$address','$age')";
    $result=mysqli_query($con,$sql);

    if($result){

        echo
        '<div class="alert alert-success" role="alert">
        Successfull
        </div>';
    }else{
        die(mysqli_error($con));
    }
}

//Delete

if(isset($_POST['delete_employee']))
{
    $id = mysqli_real_escape_string($con, $_POST['delete_employee']);

    $query = "DELETE FROM crud WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        echo
        '<div class="alert alert-danger" role="alert">
        Deleted Succesfully
        </div>';
    }
    else{
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
  <body>
    <div class="container mt-4">
        <h1 class="bi bi-people-fill">Users
            
            <a type="button" class="btn btn-success mb-3 float-end" data-bs-toggle="modal" data-bs-target="#AddModal">
            <i class="bi bi-plus-circle"></i>Add User</a>
        </h1>

        <div class="form-group mb-2">
            <input type="text" id="myInput" placeholder="Search..." class="form-control">
        </div>
        

                <!-- Modal -->
                <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="AddModalLabel">Add New User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Enter your name" name="name">
                                   </div>
                                   <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="Enter your address" name="address">
                                   </div>
                                   <div class="form-group">
                                        <label>Age</label>
                                        <input type="text" class="form-control" placeholder="Enter your age" name="age">
                                   </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        <table class="table">
            <thead class="table-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Age</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
                <tbody id="myTable">
                    <?php
                        $query="SELECT * FROM crud";
                        $query_run=mysqli_query($con,$query);
                        
                        if(mysqli_num_rows($query_run)>0)
                        {
                        
                        foreach($query_run as $crud)
                        {
                            
                    ?>
                    
                    
                            <tr>
                            <th scope="row"><?=$crud['id'];?></th>
                            <td><?=$crud['name'];?></td>
                            <td><?=$crud['address'];?></td>
                            <td><?=$crud['age'];?></td>
                            <td style="width: 15%">
                                    <a href="view.php?updateid=<?=$crud['id'];?>" class="bi bi-eye-fill text-primary btn btn-outline-*"></a>
                                    <a href="employee-edit.php?updateid=<?=$crud['id'];?>" class="bi bi-pencil-fill text-primary btn btn-outline-*"></a>
                                    

                                    <form action="index.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_employee" value="<?=$crud['id'];?>" class="bi bi-trash-fill text-primary btn btn-outline-*"></button>
                                    </form>
                            </td>
                            </tr>
                    <?php
                        }
                        }
                        
                            else
                            {
                                echo "<h5> NO RECORDS FOUND </h5>";
                            }
                                        
                    ?>

                    
                </tbody>
                <tbody>
                                
                </tbody>
            </table>
    </div>


    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup",function(){
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    
  </body>
</html>