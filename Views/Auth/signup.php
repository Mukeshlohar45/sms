<?php
require __DIR__ . "/../../Services/ConnectionServices.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Public/assets/css/style.css">
</head>

<body>
    <?php
    $xyz = new Database();
    $db = $xyz->getconnect();

    $sql = "SELECT * FROM grades";
    $res = $db->query($sql)
    ?>
    <div class="container">
        
        <img style="margin-left: 47%;" id="myimg" src="../../Public/assets/images/student-management-8.svg" width="50px" height="50px" class="myimg" alt="">
        <h1 style="margin-top: 10px;">Sign Up</h1>
        <form class="form form-control" id="validate" method="POST" , enctype="multipart/form-data" action="../../Controllers/Auth/Insert.php">
            <label for="firstname">Firstname</label>
            <input type="text" placeholder="" class="form-control" name="firstname" id="inpfname">
            <label for="lastname">Lastname</label>
            <input type="text" placeholder="" class="form-control" name="lastname" id="inplname">
            <label for="email">Email</label>
            <input type="email" placeholder="" class="form-control" name="email" id="inpemail">
            <label for="password">Password</label>
            <input type="password" placeholder="" class="form-control" name="password" id="inppassword">
            <label for="cpassword">Confirm password</label>
            <input type="password" placeholder="" class="form-control" name="cpassword" id="inpcpassword">
            <label for="number">Phone Number</label>
            <input type="number" placeholder="" class="form-control" name="phonenumber" id="inpnumber">
            <div class="form-control">
                <label>Gender:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <p class='pqr'>
                    <input type="radio" name="gender" id="male" class="form-check-input" value="male">
                    <label for="male">male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="gender" id="female" class="form-check-input" value="female">
                    <label for="female">female</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="form-control">
                <label>Hobby:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <p class='xyz'>
                    <label for="chPainting">Painting</label>
                    <input type="checkbox" name="hobby[]" value="Painting " id="chPainting" class="form-check-input">
                    <label for="chPainting">Learning</label>
                    <input type="checkbox" name="hobby[]" value="Learning" id="chLearning" class="form-check-input">
                    <label for="chPainting">Other</label>
                    <input type="checkbox" name="hobby[]" value="Other" id="chOther" class="form-check-input">
                </p>
            </div>

            <textarea name="message" id="inpmessage" cols="15" rows="5" class="form-control" placeholder="Message"></textarea>

            <input type="file" class="form-control" name="profile">

            <select name="grade" size="n" class="form-label form-control" id="inpgrade">
                <option class="form-control">select</option>
                <?php
                while ($rows = $res->fetch_assoc()) {
                ?>
                    <option value = <?php echo $rows["grade_value"]; ?> class="form-control"> <?php echo $rows["grade_value"]; ?></option>
                <?php } ?>
            </select>
            <input type="submit" class="btn btn-primary form-control" id="add" value="Sign Up">
            <p>Already have an account? <a href="../../index.php">Sign In</a></p>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="../../Public/assets/js/main.js"></script>

</html>