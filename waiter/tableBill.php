
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<style>
body {
  font-family: "Sofia", sans-serif;
}
</style>
</head>

<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

<div class="container-fluid" style="margin-left:15%"> 
    <div class="row">
<?php
    include_once('../admin/connection.php');
    // echo $_SESSION['UserId'];
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
     
    //   $sql="SELECT table_orders.table_no, menu.menu_name,table_orders.quantity, table_orders.bill, table_status FROM ((table_orders inner join tables on table_orders.table_no=tables.table_no) inner join menu on menu.menu_id=table_orders.menu_id) where status='Delivered'";
        $sql="SELECT table_orders.table_no, menu.menu_name,table_orders.quantity, table_orders.bill, SUM(table_orders.bill) AS total_bill, table_status FROM ((table_orders inner join tables on table_orders.table_no=tables.table_no) inner join menu on menu.menu_id=table_orders.menu_id) where status='Delivered' group by table_no";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()){
         
    ?>  
    
                    <!-- Food -->
                    <div class="card col-sm-4 w-25 mt-5 ms-s m-2" style="text-align:center">
                        <form method="post">
                        <div class="product-top">
                           <h2 class="jumbotron"><?php echo 'Table Number '.$row['table_no']?></h2>
                                <div class="card-body text-align-center ">
                                    <h3 class="text-center menuName"><span><?php echo $row['table_status']?></span></h3>
                                    <h4>Total Bill:&nbsp;<span class="text-center price"><?php echo '₱'.$row['total_bill']?></span></h4>
                                    
                                    <button type="button" name="paid" class="btn btn-primary" title="Order">
                                        <i class="fa fa-check"></i>Confirm Bill Receipt
                                    </button>
                                    
                                </div>
                           
                        </div>
                        </form>
                    </div>
    <?php
        }

      }
      
    }
    ?>
    </div>
</div>


<!-- Modal for confirming bill receipt -->
<div class="modal fade" id="issueReceipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width:80%; margin-left:auto; margin-right:auto; text-align:left;padding: 10px;border-radius:20%;padding:20px">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Issue Receipt</h5>
            <button class="btn btn-danger"type="button" data-toggle="modal" data-target="#issueReceipt" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form method="POST">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Table Number:</span>
                </div>
                <input class="form-control" type="text" readonly id="tableNo" name="tableNo" value="">
                </div>
           
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Total Bill: ₱</span>
                </div>
                <input type="text" readonly class="form-control" aria-label="">
                </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend m-2" >
                    <label class="input-group-text " id="">Name for Signature</label>
                </div>
                <input type="text" class="form-control" id="signature" name="signature" value="">
            </div>
              
                <input type="submit" name ="issueReceipt" value="Confirm"><br>
            </form>    
            </div> 
            <div class="modal-footer">
              <button  class ="btn btn-danger"type="button" data-toggle="modal" data-target="#issueReceipt">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.btn-primary').click(function(){
            $('#issueReceipt').modal({ backdrop: 'static', keyboard: false })

            $('#issueReceipt').modal('show');
        })
    })
</script>

<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>  
</body>
</html>
