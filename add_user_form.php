<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <!-- datatable cdns -->
    
    <?php
        include('userModal.php');
    ?>

    <div class="main-container">
        <div class="container mt-5">
            <form id="AddUser" action="add_user.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" class="form-control" id="username" name="name" aria-describedby="username" placeholder="Enter Username">
                </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add User</button>
                </div>    
            </form>
              

        </div>

        <div class="container">
        <table id="userDetail" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Pole</th>
                    
                </tr>
            </thead>
            <tbody>
                
            
                <?php
                    $user_instance = new user();
                    $user_info = $user_instance->getUserDetail();
                    // echo "<pre>";
                    // print_r($user_info);
                    // echo "</pre>";
                    foreach($user_info as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value['Name']; ?></td>
                            <td><?php echo $value['Email']; ?></td>
                            <td><?php echo $value['Amount']; ?></td>
                            <td><?php echo $value['Pole']; ?></td>
                            
                        </tr>
                        <?php
                    }

                ?>
            </tbody>
            
        </table>
        </div>  
    </div>
    <script>
        $(document).ready(function() {
            $('#userDetail').DataTable();
        } );
    </script>
</body>
</html>