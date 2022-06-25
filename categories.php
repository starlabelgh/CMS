<?php require_once("Includes/DB.php")?>
<?php require_once("Includes/Functions.php")?>
<?php require_once("Includes/Sessions.php")?>
<?php require_once("Includes/DateTime.php")?>
<?php
    if(isset($_POST["Submit"])){
        $category = $_POST["CategoryTitle"];
        $Admin = "Moses";
        date_default_timezone_set("Africa/Accra");
        $CurrentTime=time();
        $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

        if(empty($Category)){
            $_SESSION["ErrorMessage"]= "All field must be filled";
            Redirect_to("categories.php");
        }elseif (strlen($Category)<3) {
            $_SESSION["ErrorMessage"]= "Category title should be greater than 2 characters";
            Redirect_to("categories.php");
        }elseif (strlen($Category)>49){
            $_SESSION["ErrorMessage"]= "Category title should be less than 50 characters";
            Redirect_to("categories.php");
        }else{
            //Query to insert data into the database
            $sql = "INSERT INTO category(title, author, datetime)";
            $sql .= "VALUES(:categoryName, :adminname, :datetime)";
            $stmt = $ConnetingDB->prepare(sql);
            $stmt->bindValue(':categoryName')
            $stmt->bindValue(':adminName',$Admin);
            $stmt->bindValue('datetime',$DateTime);
            $Execute=$stmt->execute();

            if($Execute){
                $_SESSION["SuccessMessage"]="Category with id : ".$ConnectingDB->lastInsertId()."Added Successfully";
                Redirect_to("Index.html");
            }else {
                $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
                Redirect_to("categories.php")
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
    <title>CMS</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://use.fontawesome.com/release/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ81WUE00s/" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div style="height: 10px; background:rgb(157, 110, 1) ;"></div>

    <!-- navbar start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
        <div class="container">
            <a href="index.html" class="navbar-brand">Starlabel</a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class="navbar-toggle-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="MyProfile.html" class="nav-link"><i class="fa-duotone fa-user"></i> My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="Dashboard.html" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="Post.html" class="nav-link">Post</a>
                    </li>
                    <li class="nav-item">
                        <a href="categories.php" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="ManageAdmin.html" class="nav-link">Manage Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"></a>
                    </li>                <li class="nav-item">
                        <a href="liveblog.html" class="nav-link">Live Blog</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
                        <i class="fas fa-user-times"></i>Logout
                    </a></li>
                </ul>
            </div> 
        </div>
    </nav>
    <!-- end of navbar -->
    <div style="height: 10px; background:rgb(157, 110, 1) ;"></div>

    <!-- start of head section -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-nd-12">
                    <h1><i class="fas fa-edit" style="color: #27aae1;"></i> Manage Categories</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- end of head section -->

    <!-- start of main content -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-lg-1 col-lg-10">
                <?php 
                    echo ErrorMessage()
                    echo SuccessMessage()
                ?>
                <form class="" action="categories.php" method="post">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Category</h1>
                        </div> 
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FielfInfo">Category Title:</span></label>
                                <input class="form-control" type="text" name="Title" id="title" placeholder="Type title here">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="Submit" class="btn btn-success btn-block"><i class="fas fa-check"></i>Publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </form>
            </div>

        </div>
    </section>
    <!-- end of main content -->
    <!-- footer start -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <p class="lead text-center">Theme By | Starlabel | <span id="year"></span> &copy; ---All right reserved</p>
            </div>
        </div>
    </footer>
    <!-- end of footer -->
    <div style="height: 10px; background:rgb(157, 110, 1) ;"></div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <script>
        $('#year').text(new Date().getFullYear())
    </script>
</body>
</html>