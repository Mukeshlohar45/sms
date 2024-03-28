<?php session_start();
require __DIR__ . "../../../Services/ConnectionServices.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/assets/css/admin.css">
</head>

<body>
    <?php
    if (!isset($_SESSION['role'])) {
        header("Location: ./index.php");
    }
    ?>
    <?php
    if ($_SESSION['role'] != 'student') {
        header("Location: ./index.php");
    }
    ?>
    <?php
    include_once "layout/studentnav.php";
    ?>
    <div class="container rounded bg-white mt-5 mb-5">

        <?php
        $xyz = new Database();
        $db = $xyz->getconnect();
        $id = $_SESSION['id'];

        $sql = "SELECT * FROM registration_infos WHERE id = $id";
        $res = $db->query($sql);
        while ($rows = $res->fetch_assoc()) {
            $datahobby = explode(',', $rows['hobby']);
        ?>
            <a class="backbtn btn-primary mr-3" id="backbtnn" href="studentinfo.php"><i class='fas fa-angle-left'></i>Back</a>
            <form action="../../Controllers/Student/UpdateProfile.php" method="POST" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" height="175px" width="175px" src="./../../Public/uploads/<?php echo $rows['profile']; ?>"><span class="font-weight-bold"><?php echo $rows['firstname']; ?></span><span class="text-black-50"><?php echo $rows['phonenumber']; ?></span><span> </span></div>
                        <div class="col-md-12">
                            <label for="profile">Profile Picture:</label>
                            <input type="hidden" name="old_image" value="<?php echo $rows['profile']; ?>">
                            <input type="file" name="profile" value=""><br>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile </h4>
                            </div>
                            <div class="row mt-2">
                                <input type="hidden" class="form-control" placeholder="" name="sid" value="<?php echo $rows['id']; ?>">
                                <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" name="firstname" value="<?php echo $rows['firstname']; ?>"></div>
                                <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" name="lastname" value="<?php echo $rows['lastname']; ?>"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $rows['firstname'] . "@gmail.com"; ?>"></div>
                                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value="<?php echo $rows['phonenumber']; ?>" name="phonenumber"></div>
                                <div class="col-md-12">
                                    <label>Gender:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <p class='pqr'>
                                        <input type="radio" name="gender" id="male" class="form-check-input" value="male" <?php echo ($rows['gender'] == 'male') ? 'checked' : '' ?>>
                                        <label for="male">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="gender" id="female" class="form-check-input" value="female" <?php echo ($rows['gender'] == 'female') ? 'checked' : '' ?>>
                                        <label for="female">Female</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <label>Hobby:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <p class='xyz'>
                                        <label for="chPainting">Painting</label>
                                        <input type="checkbox" name="hobby[]" value="Painting" id="chPainting" class="form-check-input" <?php if (in_array("Painting", $datahobby)) echo "checked"; ?>>
                                        <label for="chPainting">Learning</label>
                                        <input type="checkbox" name="hobby[]" value="Learning" id="chLearning" class="form-check-input" <?php if (in_array("Learning", $datahobby)) echo "checked"; ?>>
                                        <label for="chPainting">Other</label>
                                        <input type="checkbox" name="hobby[]" value="Other" id="chOther" class="form-check-input" <?php if (in_array("Other", $datahobby)) echo "checked"; ?>>
                                    </p>
                                </div>
                            </div>
                            <?php
                            $citysql = "SELECT * FROM `grades`";
                            $city = $db->query($citysql);
                            ?>
                            <label>Grade:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <select name="grade" size="n" class="form-label form-control" id="inpgrade">
                                <option class="form-control">Select</option>
                                <?php
                                while ($cityrows = $city->fetch_assoc()) {
                                    if ($cityrows["grade_value"] == $rows["grade"]) {
                                ?>
                                        <option value=<?php echo $cityrows["grade_value"]; ?> class="form-control" selected> <?php echo $cityrows["grade_value"]; ?></option>

                                    <?php continue;
                                    } ?>
                                    <option value=<?php echo $cityrows["grade_value"]; ?> class="form-control"> <?php echo $cityrows["grade_value"]; ?></option>
                                <?php } ?>
                            </select>
                            <div class="mt-5 text-center">
                                <!-- <div class="btn btn-primary profile-button" id="updateprofile">Save</div> -->
                                <input class="btn btn-primary profile-button" type="submit" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

    </div>
    </div>
    </div>
    </div>
<?php } ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- <script src="./assets/js/student.js"></script> -->

</html>