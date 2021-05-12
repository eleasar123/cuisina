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
          <th>Account Id</th>
          <th>Name</th>
          <th>Position</th>
          <th>Created_At</th>
        <th>Action</th>
      </tr>
  </thead>
  <tbody>
  <?php
    include_once('connection.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }else{
       
        $sql="SELECT accounts.account_id, accounts.account_name, position.position_name, accounts.created_at, accounts.deleted_at from accounts inner join position on accounts.position=position.position_id order by position.position_name asc, accounts.account_name asc";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          
          while($row = $result->fetch_assoc()){
           
      ?>  
    
      <tr>
          <td class="col-1"><?php echo $row['account_id']; ?></td>
          <td class="col-2"><?php echo $row['account_name']; ?></td>
          <td class="col-2"><?php echo $row['position_name']; ?></td>
          <td class="col-2"><?php echo $row['created_at']; ?></td>          
      <td class="col-2">
        <form method="DELETE" action="">
         <button class="btn btn-info btn-xs" href=""><i class="fa fa-pen"></i>Edit</button>
          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</button>
        </form>
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

<!-- Modal for inserting menu -->
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
                    <input id="title" type="text" name="name" placeholder="Enter account name here"><br><br>
                <h5>Position:</h5>
                <select class="form-select" aria-label="Default select example" name="position">
                    <option value="1">Admin</option>
                    <option value="2">Waiter</option>
                    
                </select><br>
                
                    <input type="submit" name ="submit" value="Add Note"><br>
            </form>    
            </div> 
            <div class="modal-footer">
              <button  type="button" class="close">Cancel</button>
            </div>
        </div>
    </div>
</div>
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
})
</script>
</body>
</html>