<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- ==Bootstrap 4=== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- ==Bootstrap 5==== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Vendor CSS Files -->
    <link href="./vendor/animate.css/animate.min.css" rel="stylesheet">

    <link href="./vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./src/style.css" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <?php
        session_start();
        $username=$_SESSION['username'];
        $fullName=$_SESSION['accountName'];
        $accountId=$_SESSION['accountId'];

    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light"
        style="background-color: white;  box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);padding:15px">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand me-2">
                <h2> Cuisina</h2>
            </a>

            <!-- Right links -->
            <div class="dropdown ">
                <a class="dropdown-toggle " id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                    aria-expanded="false" style="text-decoration: none;">
                    <img src="https://mdbootstrap.com/img/new/avatars/2.jpg" class="rounded-circle" height="35" alt=""
                        loading="lazy" /> <span class="align-middle"><?php echo $username?></span></a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
            <!-- Right elements -->
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Row -->
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-8" style="border-right:1px solid #D3D3D3">
                <div class="d-flex align-items-center">
                    <select name="" id="" class="form-select mt-3 w-25 p-2">
                        <option selected>Meal Category</option>
                        <option value="1">Breakfast</option>
                        <option value="2">Lunch</option>
                        <option value="3">Dinner</option>
                        <option value="4">Dessert</option>
                    </select>
                    <select name="" id="" class="form-select mt-3 w-25 p-2 ms-3">
                        <option selected>Choose Table</option>
                        <option value="1">Table 1</option>
                        <option value="2">Table 2</option>
                        <option value="3">Table 3</option>
                        <option value="4">Table 4</option>
                        <option value="5">Table 5</option>
                        <option value="6">Table 6</option>
                        <option value="7">Table 7</option>
                        <option value="8">Table 8</option>
                        <option value="9">Table 9</option>
                        <option value="10">Table 10</option>
                    </select>
                    <form class="d-flex">
                        <input class="form-control me-2 p-2 ms-3 mt-3" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-outline-success mt-3 " type="submit">Search</button>
                    </form>
                </div>

                <?php
                    include_once('../waiter/displayMenu.php');
                ?>
                
         </div> 
        <div class="col-sm-4" style="margin-bottom: 50%; padding:50px;">
            <div class="container">
                <table class="table">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">Table</th>
                            <th scope="col">Order</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>Table 1</td>
                        <td>Ginisang Talong</td>
                        
                        <td>40.00</td>
                        <td>5 Bowls</td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>

    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
        crossorigin="anonymous"></script>



</body>

</html>