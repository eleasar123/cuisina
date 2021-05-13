<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Admin</title>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link src="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <style>
        body{
            color: white;
        }
        a{
          text-decoration: none;
        }

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a{
  padding: 6px 6px 6px 32px;
  text-decoration: none;
  font-size: 25px;
  /* color: #818181; */
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.modal{
            color:black;
            border: solid 2px white; 
            display:none; 
        }
        #button1{
          background-color: blue;
          border-style: none;
          border-radius: 15%;
          color:skyblue;
          font-size: 20px;
        }
        #button1:hover{
          color: white;
        }

     .update{
       width:50%;
       height: 40px;
       border-radius: 20%;
       background-color:skyblue;

     }
    </style>
    
</head>

<body bgColor="black">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<div class="sidenav">
  <h3>&nbsp;Dashboard</h3>
  <a href="admin.php">Home</a>
  <button id="button1" style="margin-left: 30px">Add New</button>
  <a href="accounts.php">Accounts</a>
  <a href="transactions.php">Transactions</a>
</div>

<div class="row">
    <div class="col-lg-12">           
        <h2>Products CRUD           
            <div class="pull-right">
               <button class="btn btn-primary"> Create New User</button>
            </div>
        </h2>
     </div>
</div>
<div class="table-responsive" style="margin-left:220px;margin-right:40px">
<table class="table table-bordered">
  <thead>
      <tr>
          <th scope="col">Account Id</th>
          <th scope="col">Name</th>
          <th scope="col">Password</th>
          <th scope="col">Position</th>
          <th scope="col">Created_At</th>
          <th scope="col">Updated_At</th>
         
        <th>Action</th>
      </tr>
  </thead>
  <tbody>
  <?php
    include_once('../admin/connection.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }else{
       
        $sql="SELECT accounts.account_id, accounts.account_name, accounts.password, position.position_name, accounts.created_at, accounts.updated_at, accounts.deleted_at from accounts inner join position on accounts.position=position.position_id where deleted_at IS NULL order by position.position_name asc, accounts.account_name asc ";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          
          while($row = $result->fetch_assoc()){
           
      ?>  
    
      <tr>
          <td class="col-1 id"><?php echo $row['account_id']; ?></td>
          <td class="col-1 name"><?php echo $row['account_name']; ?></td>
          <td class="col-1 password"><?php echo $row['password']; ?></td>
          <td class="col-1 position"><?php echo $row['position_name']; ?></td>
          <td class="col-1"><?php echo $row['created_at']; ?></td>
          <td class="col-1"><?php echo $row['updated_at']; ?></td>
                 
      <td class="col-1">
        
         <button class="btn btn-info btn-xs" href=""><i class="fa fa-pen"></i></button>
         <a href="../admin/deleteAccount.php?id=<?php echo $row['account_id']; ?>">
          <button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button></a>
        
      </td>     
      </tr>
      <?php }?>
  </tbody>
  <?php
        }
      }
    ?>
</table>
</div>

<!-- Modal for inserting new account -->
<div class="modal" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width:80%; margin-left:auto; margin-right:auto; text-align:left;padding: 10px;border-radius:20%;padding:20px">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">New Account</h5>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form method="POST">
              
                <h5>Name:</h5>
                    <input  type="text" name="accountName" placeholder="Enter account name here"><br><br>
                <h5>Password:</h5>
                    <input  type="password" name="accountPassword" placeholder="Enter account password here"><br><br>
                <h5>Position:</h5>
                <select class="form-select" aria-label="Default select example" name="position">
                    <option value="1">Admin</option>
                    <option value="2">Waiter</option>
                    
                </select><br>
                
                    <input type="submit" name ="addAccount" value="Add Account"><br>
            </form>    
            </div> 
            <div class="modal-footer">
              <button  type="button" class="close">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for updating account -->
<div class="modal" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width:80%; margin-left:auto; margin-right:auto; text-align:left;padding: 10px;border-radius:20%;padding:20px">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Account</h5>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form method="POST">
                <input type="hidden" id="accountId"name="accountId" value="">
                <h5>Name:</h5>
                    <input id="accountName" type="text" name="accountName" placeholder="Enter account name here"><br><br>
                <h5>Password:</h5>
                    <input id="accountPassword" type="password" name="accountPassword" placeholder="Enter account password here"><br><br>
                <h5>Position:</h5>
                <select class="form-select" aria-label="Default select example" id="position" name="position">
                    <option value="1">Admin</option>
                    <option value="2">Waiter</option>
                    
                </select><br>
                
                    <input type="submit" name ="updateAccount" value="Update Account"><br>
            </form>    
            </div> 
            <div class="modal-footer">
              <button  type="button" class="close">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){

//trigger modal for inserting new account
    $("#button1").click(function(){
    
        $('#addUser').modal({ backdrop: 'static', keyboard: false })
        $('#addUser').modal('show');

        $(".close").click(() => {
            $('#addUser').modal('hide');

        })
    })

    $(".btn-info").click(function(){
    
    $('#updateUser').modal({ backdrop: 'static', keyboard: false })
    $('#updateUser').modal('show');

    $accountId=$(this).parent().siblings('.id').html()
    $accountName=$(this).parent().siblings('.name').html()
    $accountPassword=$(this).parent().siblings('.password').html()
    $accountPosition=$(this).parent().siblings('.position').html()
    $("#accountId").val($accountId)
    if($accountPosition=="Admin"){
      $("#position").val("1")
    }else{
      $("#position").val("2")
    }
    
    $("#accountPassword").val($accountPassword)
    $("#accountName").val($accountName)
    $(".close").click(() => {
        $('#updateUser').modal('hide');

    })
})


})
</script>
<script>
    //prevent form to submit on page reload
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
<?php
      include_once('../admin/connection.php');
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

      //on insert button click to add new account
      if(isset($_POST['addAccount'])){
        
          $accountName=$_POST['accountName'];
          $accountPassword=$_POST['accountPassword'];
          $position=$_POST['position'];
          

          //set default timezone to asia or manila-Philippines timezone
          date_default_timezone_set('Asia/Manila');
          $dateCreated=date("Y-m-d h:i:s");
          
              $sql = "insert into accounts(account_name, password, position, created_at) 
              VALUES('".$accountName."','".$accountPassword."','".$position."','".$dateCreated."') ";
              if ($conn->query($sql) === TRUE) {
              ?>

                 <!--fire a successful message using sweet alert -->
                <script>
                swal({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Account successfully added!',
                  showConfirmButton: false,
                  timer: 1800
                })
                setTimeout(() => {
                location.reload()
              }, 2000);
              </script>
                <?php
          
          
              }
          
          
      }

       //on insert button click to update an account
       if(isset($_POST['updateAccount'])){
        $accountId=$_POST['accountId'];
        $accountName=$_POST['accountName'];
        $accountPassword=$_POST['accountPassword'];
        $position=$_POST['position'];
        

        //set default timezone to asia or manila-Philippines timezone
        date_default_timezone_set('Asia/Manila');
        $dateUpdated=date("Y-m-d h:i:s");
        // echo "<script>alert('$acccountId+$accountName+$accountPassword+$position+$dateUpdated')</script>";
            $sql = "update accounts set account_name='".$accountName."', password='".$accountPassword."', position='".$position."', updated_at='".$dateUpdated."' where account_id='".$accountId."'";
            if ($conn->query($sql) === TRUE) {
            ?>

               <!--fire a successful message using sweet alert -->
              <script>
              swal({
                position: 'top-end',
                icon: 'success',
                title: 'Account successfully updated!',
                showConfirmButton: false,
                timer: 1800
              })
              setTimeout(() => {
              location.reload()
            }, 2000);
            </script>
              <?php
        
        
            }
        
        
    }
?>

</body>
</html>