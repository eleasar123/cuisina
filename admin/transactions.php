<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- ==Bootstrap 4=== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- ==Bootstrap 5==== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Vendor CSS Files -->
    <link href="./vendor/animate.css/animate.min.css" rel="stylesheet">

    <link href="./vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./src/style.css" rel="stylesheet">

    <title>Transactions</title>
</head>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<div class="container-fluid" style="margin-left:10%;padding:20px;">
    <div class="row">
        <div class="container col-sm-4">
            <table class="table w-25">
                <thead class="table-warning">

                    <th scope="col ">Total Items</th>
                    <th scope="col ">Bill</th>
                    <th scope="col ">Transaction Date</th>


                </thead>
                <tbody>
                   

                    <?php
                    include_once('../admin/connection.php');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } else {

                        $sql = "SELECT sum(quantity) as quantity, sum(bill) as bill, DATE(paid_at) as transaction_date FROM sales group by DATE(paid_at)";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                    ?>

                                <tr>
                                    <td class=""><?php echo $row['quantity'] ?></td>

                                    <td class=""><?php echo $row['bill'] ?></td>

                                    <td class=""><?php echo $row['transaction_date'] ?></td>

                                </tr>

                    <?php
                            }
                        }
                    }

                    ?>
                </tbody>
            </table>


            <?php
            date_default_timezone_set('Asia/Manila');
            $dateCreated = date("Y-m-d");
            //query for displaying the menu who is top sales
            //$query="select menu_name from menu inner join table_orders on table_orders.menu_id=menu.menu_id order by date(table_orders.paid_at)";

            $sql = "SELECT sum(quantity) as quantity, sum(bill) as bill, DATE(paid_at) as transaction_date FROM sales where DATE(paid_at)='" . $dateCreated . "'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>
                    <div class="card  mt-5 p-3" style="width:20rem">
                        <h3 class="text-center">Total Sales for the day</h3>

                        <span>Total Items Sold:</span><?php echo $row['quantity'] ?><br>

                        <span>Bill:</span><?php echo '₱' . $row['bill'] ?><br>

                        <span>Date:</span><?php echo date('l  F d, Y', strtotime($row['transaction_date'])) ?><br>

                    </div>

            <?php
                }
            }

            ?>
        </div>
        <div class="container col-sm-8 ">
            <table class="table w-25 table-wrapper-scroll-y my-custom-scrollbar" id="sales">
                <thead class="table-warning">
                    <th scope="col ">Sale_Id</th>
                    <th scope="col ">Table Number</th>
                    <th scope="col ">Customer Name</th>
                    <th scope="col ">Total Items</th>
                    <th scope="col ">Bill</th>
                    <th scope="col ">Transaction Date</th>
                    <th scope="col ">Received By</th>


                </thead>
                <tbody>

                    <?php
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } else {

                        $sql = "SELECT * from sales";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                    ?>

                                <tr>
                                    <td class=""><?php echo $row['sale_id'] ?></td>
                                    <td class=""><?php echo $row['table_no'] ?></td>
                                    <td class=""><?php echo $row['customer_name'] ?></td>
                                    <td class=""><?php echo $row['quantity'] ?></td>
                                    <td class=""><?php echo $row['bill'] ?></td>
                                    <td class=""><?php echo $row['paid_at'] ?></td>
                                    <td class=""><?php echo $row['signature'] ?></td>

                                </tr>

                    <?php
                            }
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.noConflict();
        $('#sales').DataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>
</body>

</html>
<?php
