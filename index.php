<?php
include('config.php');
if(isset($_SESSION['user_id'])){
    header("location: dashboard.php");
}

$error='';
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        $userfind = Admin::where('username', '=', $username)->where('password', '=', md5($password))->count();

        if ($userfind > 0) {
            $_SESSION['user_id'] = $username;
            header("location: dashboard.php");
        } else {

            $error = "Username or Password is invalid";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FOS-Streaming panel by Tyfix</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background:#F7F7F7;">

<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <?php
            if($error != "") {
                echo "<div class=\"alert alert-error\">
                                    " . $error . "
                                </div>";
            }
            ?>
            <section class="login_content">
                <form action="" method="post">
                    <h1>FOS-Streaming</h1>
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <input type="submit" name="submit" class="btn btn-default submit" value="Log in">
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">


                        <div class="clearfix"></div>
                        <br />
                        <div>


                            <p>&copy;2015 All Rights Reserved FOS-Streaming by <a href="http://www.tyfix.nl" target="_blank">Tyfix</a></p>
                        </div>
                    </div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
    </div>
</div>

</body>

</html>