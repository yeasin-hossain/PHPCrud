
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
    <?php require_once 'calculate.php'; ?>

    <?php 
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
           <?php endif ?>
             


    
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud')or die (mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

        ?>
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2"> Action </th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()): ?> 
                    <tr>
                        <td> <?php echo $row['name']; ?> </td>
                        <td> <?php echo $row['location']; ?> </td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" 
                            class="btn btn-info">Edit</a>

                            <a href="calculate.php?delete=<?php echo $row['id']; ?>" 
                            class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile ?>
                </table>
            </div>
        <?php

        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
       
    ?>
<div class="row justify-content-center">
    <form action="calculate.php" method="POST" >
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" 
            value="<?php echo $name ?>" class="form-control" placeholder="enter your name ">
        </div>
        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" 
            value="<?php echo $location ?>" class="form-control" placeholder="enter your location "> 
        </div>
        <div class="form-group">
            <?php 
            if($update == true):
            ?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>
            <?php endif ?>
        </div>
    
    </form>
</div>
</div>

</body>
</html>








