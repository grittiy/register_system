<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $firstname_up= $_REQUEST['txt_firstname'];
        $lastname_up = $_REQUEST['txt_lastname'];
        $email_up = $_REQUEST['txt_email'];
        

        if (empty($firstname_up)) {
            $errorMsg = "Please Enter Fisrtname";
        } else if (empty($lastname_up)) {
            $errorMsg = "Please Enter Lastname";
        } else if (empty($email_up)) {
            $errorMsg = "Please Enter email";
        
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE users SET firstname = :firstname_up, lastname = :lastname_up, email = :email_up  WHERE id = :id");
                    $update_stmt->bindParam(':firstname_up', $firstname_up);
                    $update_stmt->bindParam(':lastname_up', $lastname_up);
                    $update_stmt->bindParam(':email_up', $email_up);
                  
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;admin.php");
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
       
    <?php 
         if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
    <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="txt_firstname" value="<?php echo $firstname; ?>">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="txt_lastname" value="<?php echo $lastname; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="txt_email" value="<?php echo $email; ?>">
            </div>
         
            

            
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="admin.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>

           
    </form>
    </tr>
                         
                         </tbody>
                     </table>
                 </div>
             </div>
         </div> 
   
 
    
 
 
       
        
       
 
 
  
             <a href="logout.php" class="btn btn-danger">Logout</a>
 
         </div>
     </div>
    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>