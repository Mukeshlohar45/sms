<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Public/assets/css/login.css">
</head>

<body>
    <div class="page-content">
        
        <div class="form-v5-content">
            
            <form class="form-detail" id="forgotpass" method="POST" enctype="multipart/form-data" action="../../Controllers/Auth/ForgotPasswordLink.php">
                <a style="float: right;" id="backbtnn" class="backbtnn btn-warning"href="../../index.php">Back</a>
                <img style="margin-left: 45%;" id="myimg" src="../../Public/assets/images//student-management-8.svg" width="50px" height="50px" class="myimg" alt="">
                <h2 style="margin-top: 15px;">Forgot Password</h2>
                <div class="form-row">
                    <input type="email" placeholder="Please Enter Your Email " class="form-control" name="email" id="inpemail" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-row">
                    <a href="../../index.php">Sign In</a>
                </div>
                <div class="form-row-last">
                    <input id='myButton' type="submit" name="register" class="register" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="../../Public/assets/js/loginvalidation.js"></script>

</html>