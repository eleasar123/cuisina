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

<div class="container" style="margin-left:20%;background-color:white;">
  <div class="row" style=" padding:20px;">

      <?php
    include_once('../admin/connection.php');
    // echo $_SESSION['UserId'];
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
     
      $sql="select * from menu order by menu_type asc, menu_name asc";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()){
         
    ?>  
      <div class="card col-sm-4" style="box-shadow:5px 5px gray; width:20rem;margin:10px;margin-top:20px;margin-bottom:20px;border:solid black 2px;height:fit-content;font-size:18px; border-radius:10%;border:solid black 2px;color:black;padding:10px;border-radius: 10px;">
   
        <div>
        <label><strong>Id:</strong></label>
            <span><em><?php echo $row['menu_id'] ?></em></span><br>
          <label><strong>Name:</strong></label>
            <span><em><?php echo $row['menu_name'] ?></em></span><br>
            <label><strong>Photo:</strong></label>
            <div class="container"><img style="width:100%;height:auto;border-radius:5%"src="<?php echo $row['menu_photo'] ?>"></div>
            <label><strong>Menu Type:</strong></label>
            <span><?php echo $row['menu_type'] ?></span><br>
            <label><strong>Status:</strong></label>
            <span><?php echo $row['availability'] ?></span><br>
            <label><strong>Price:</strong></label>
            <span><?php echo "Php".$row['price'] ?></span><br>
            <label><strong>Date Created:</strong></label> 
             <span><?php echo $row['created_at'] ?></span><br>
             <label><strong>Date Updated:</strong></label> 
             <span><?php echo $row['updated_at'] ?></span><br> 
              
              <button type="button" class="update"><i class="fa fa-pen"></i>Edit Menu</button>   
        </div>
    </div>
        
 
          <?php
          }
        }
      }
          ?>
  </div>
</div> 

<!-- Modal for inserting menu -->
<div class="modal" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width:80%; margin-left:auto; margin-right:auto; text-align:left;padding: 10px;border-radius:20%;padding:20px">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">New Menu</h5>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form method="POST">
              
                <h5>Name:</h5>
                    <input id="title" type="text" name="name" placeholder="Enter menu name here"><br>
                <h5>Photo:</h5>
                    <textarea id="photo" rows="2" cols="45" name="photo">
                    Enter menu photo here...</textarea>
                    <input id="body" name="body" type ="text" style="visibility:hidden;height:20px;width:20px;margin:0px" value="">
                <h5>Menu Type</h5>
                <select class="form-select" aria-label="Default select example">
                    <option value="breakfast">breakfast</option>
                    <option value="lunch">lunch</option>
                    <option value="dessert">dessert</option>
                    <option value="dinner">dinner</option>
                </select>
                <h5>Availability:</h5>
                    <input type="checkbox" id="done"  value="Done"><label>Available</label><br><br>
                    <input id="status" name="status" type ="hidden" value="">
                    <span><strong>Price:<strong></span>
                    <input type="number" id="price"  value=""><br><br>
                    <input type="submit" name ="submit" value="Add Note"><br>
            </form>    
            </div> 
            <div class="modal-footer">
              <button  type="button" class="close">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for updating menu -->
<div class="modal" id="updateMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width:80%; margin-left:auto; margin-right:auto; text-align:left;padding: 10px;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Menu</h5>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form method="POST">
                
                <h5>Name:</h5>
                <input id="title" type="text" name="name" placeholder="Enter title here"><br>
                <h5>Photo:</h5>
                <textarea id="photo" rows="4" cols="45" name="photo">
                Enter the online link of the photo...</textarea>
                <input id="body" name="body" type ="text" style="visibility:hidden;height:20px;width:20px;margin:0px" value="">
                <h5>Availability:</h5>
                <input type="checkbox" id="done"  value="Done"><label>Available</label>
                <input id="status" name="status" type ="text" style="visibility:hidden;height:10px;width:20px;margin:0px" value=""><br><br>
                <span><strong>Price:<strong></span>
                <input type="number" id="price"  value=""><br><br>
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

     //trigger modal for inserting new menu
    $("#button1").click(function(){
      
      $('#addMenu').modal({ backdrop: 'static', keyboard: false })
      $('#addMenu').modal('show');

      $(".close").click(() => {
          $('#addMenu').modal('hide');

        })
    })
    
    //checkbox
    x=0;
    $("#status").val("Not Done");
    $('#done').click(function(){
      if(x%2==0){
      $(this).attr("checked",true);
      $("#status").val("Done");
      
      x++;
      }else{
        $(this).attr("checked",false);
      $("#status").val("Not Done");
      
      x++;
      } 
    })

    //trigger modal for updating menu
    $(".update").click(function(){
      var title=$(this).siblings('h3').html();
      var body=$(this).siblings('div.container').html();
      var status=$(this).siblings('span').html();
      var date_created=$(this).siblings('p').html();  
      $('#updateMenu').modal({ backdrop: 'static', keyboard: false })
      $('#updateMenu').modal('show');
      $('#title').val(title);
      $('#noteBody').val(body);
      $('status').val(status);
      $("date").val(date_created);
      $(".close").click(() => {
          $('#updateMenu').modal('hide');

        })

    })
 })
</script>
<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>
  <?php
      include_once("connection.php");
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
      if(isset($_POST['submit'])){
          $title=$_POST['title'];
          $body=trim($_POST['body'],' ');
          $status=$_POST['status'];
          date_default_timezone_set('Asia/Manila');
          $date=date("Y-m-d h:i:s");
          if($title!="" && $body!="" && $status!=""){
              $sql = "insert into notes(Title,Body,Status,created_at) VALUES('".$title."','".$body."','".$status."','".$date."') ";
              if ($conn->query($sql) === TRUE) {
                header("Location: notes.php");
          
              }
          } 
          
      }
  ?>

</body>
</html>