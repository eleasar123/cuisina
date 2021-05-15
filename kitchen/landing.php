<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kitchen</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link src="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body bgColor="black">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />


<div class="container" style="margin:5%;background-color:white;">
  <div class="row" style=" padding:20px;">

    <?php
    include_once('../admin/connection.php');
    // echo $_SESSION['UserId'];
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
     
      $sql="select table_orders.table_no,menu.menu_name, menu.menu_photo,menu.price, table_orders.quantity,table_orders.bill,table_orders.status, table_orders.ordered_at from ((table_orders inner join menu on table_orders.menu_id=menu.menu_id)inner join tables on tables.table_no=table_orders.table_no)";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()){
         
    ?>  
    
                    <!-- Food -->
                    <div class="card col-sm-4 w-20 m-3 pt-2 ms-s" style="text-align:center">
                        <div class="product-top">
                            <img src="<?php echo $row['menu_photo']?>" class="img-thumbnail" alt="">
                            <div class="card-body text-align-center ">
                                <h6 class="text-center menuName"><span><?php echo $row['menu_name']?></span>
                                <span class="text-muted price"><?php echo '₱'.$row['price']?></span></h6>
                               
                                <h6 class="text-center tableName">
                                <span class="text-center quantity"><?php echo $row['quantity'].' for'?></span>
                                <span><?php echo "Table Number ".$row['table_no']?></span>
                                </h6>
                            <div class="container" style="padding:5%">
                                <button name="button1" class="btn btn-primary  acceptOrder" title="Order" style="margin-right:20px;">
                                    <i class="fa fa-check fa-5px ">Accept</i>
                                </button>
                                <button name="button1" class="btn btn-danger denyOrder" title="Order" style="margin-left:20px;" data-toggle="modal" data-target="#reject">
                                    <i class="fa fa-ban fa-5px">Deny</i>
                                </button>
                                </div>    
                            </div>
                        </div>
                    </div>
    <?php
        }

      }
      
    }
    ?>
  </div>
</div> 

<!--modal for denying request-->
<div class="modal" tabindex="-1" role="dialog" id="reject">
  <div class="modal-dialog" role="document">
    <div class="modal-content w-35">
      <div class="modal-header">
        <h5 class="modal-title">Deny Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Input a reason for denying order</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter reason" name="denyMessage">

            </div><br>
            <button type="submit" name="sendRejection" class="btn btn-primary mb-2">Send to Waiter</button>
        </form>
      </div>
      <div class="modal-footer">
        <h4 style="background-color: pink">Don't want to deny the order?</h4>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){

    })
</script>

<?php
      include_once('../admin/connection.php');
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

      //on insert button click to add new menu
      if(isset($_POST['sendRejection'])){
        
          $status=$_POST['denyMessage'];
       
          //set default timezone to asia or manila-Philippines timezone
          date_default_timezone_set('Asia/Manila');
          $dateCreated=date("Y-m-d h:i:s");
          
          
              $sql = "update table_orders set status='Rejected'";
              if ($conn->query($sql) === TRUE) {
              ?>

                 <!--fire a successful message using sweet alert -->
                <script>
                swal({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Menu added to the restaurant!',
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