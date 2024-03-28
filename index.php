<?php
require __DIR__ . "./Services/ConnectionServices.php";
require __DIR__ . "/Config/Mail.php";
// require __DIR__ . "/Config/github.php";

$login_url = $client->createAuthUrl();

$authorizationUrl = $provider->getAuthorizationUrl($options);

session_start();

$errorLogFilePath = __DIR__ . "/errors.log";

function logError($errorMessage, $errorLogFilePath)
{
  try {
    $errorFile = fopen($errorLogFilePath, "a");
    $timestamp = date("Y-m-d H:i:s");
    $fileInfo = pathinfo($_SERVER['PHP_SELF']);
    $fileName = $fileInfo['basename'];
    // for geting the line for error
    $lineNumber = __LINE__;
    fwrite($errorFile, "[$timestamp] [$fileName] [Line $lineNumber] - $errorMessage" . PHP_EOL);
    fclose($errorFile);
  } catch (Exception $e) {
    echo "failed error logging: " . $e->getMessage();
  }
}

if (isset($_SESSION['role'])) {
  require __DIR__ . "/Middleware/CheckRole.php";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $xyz = new Database();
  $db = $xyz->getconnect();
  $sql = "SELECT * FROM login_infos WHERE (username = '$username' or email = '$username') ";
  $res = $db->query($sql);
  if ($res->num_rows >= 1) {
    $row = $res->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $sid = $row['sid'];
      $q = "SELECT status, is_varified, is_approved FROM registration_infos WHERE id = $sid";
      $result = $db->query($q);
      $status = $result->fetch_assoc();
      if ($row['role'] == 'admin') {
        $_SESSION["role"] = $row['role'];
        $_SESSION["id"] = $row['sid'];
        $_SESSION["username"] = $row['username'];
        header("Location: ./Views/Admin/adminprofile.php");
      } elseif ($row['role'] == 'student') {
        if ($status['status'] == "active") {
          if ($status['is_varified'] == 'true') {
            if ($status['is_approved'] == 'true') {
              $_SESSION["role"] = $row['role'];
              $_SESSION["id"] = $row['sid'];
              $_SESSION["username"] = $row['username'];
              header("Location: ./Views/Student/studentinfo.php");
            } else {
              logError("Please connect to admin approval.", $errorLogFilePath);
              echo '
                            <div>
                              <div class="toast-container" style="position: absolute; top: 10px; right: 10px">
                                <div class="toast fade show">
                                  <div class="toast-header">
                                    <strong class="me-auto"><i class="bi-globe"></i>Sorry!</strong>
                                    <small>just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                                  </div>
                                  <div class="toast-body">Please connect to admin approval.</div>
                                </div>
                              </div>
                            </div>
                            ';
            }
          } else {
            logError("Please verify email address", $errorLogFilePath);
            echo '
                        <div>
                          <div class="toast-container" style="position: absolute; top: 10px; right: 10px">
                            <div class="toast fade show">
                              <div class="toast-header">
                                <strong class="me-auto"><i class="bi-globe"></i>Sorry!</strong>
                                <small>just now</small>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="toast"
                                ></button>
                              </div>
                              <div class="toast-body">Please verify email address</div>
                            </div>
                          </div>
                        </div>';
          }
        } else {
          logError("You Are Deactivated! Please Verify Your Email Address", $errorLogFilePath);
          echo '
                    <div>
                      <div class="toast-container" style="position: absolute; top: 10px; right: 10px">
                        <div class="toast fade show">
                          <div class="toast-header">
                            <strong class="me-auto"><i class="bi-globe"></i>Sorry!</strong>
                            <small>just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                          </div>
                          <div class="toast-body">
                            You Are Deactivated! Please Verify Your Email Address
                          </div>
                        </div>
                      </div>
                    </div>
                    ';
        }
      } else {
        logError("Please enter login credentials.", $errorLogFilePath);
        echo '
                <div>
                  <div class="toast-container" style="position: absolute; top: 10px; right: 10px">
                    <div class="toast fade show">
                      <div class="toast-header">
                        <strong class="me-auto"><i class="bi-globe"></i>Sorry!</strong>
                        <small>just now</small>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="toast"
                        ></button>
                      </div>
                      <div class="toast-body">Please enter login credential.</div>
                    </div>
                  </div>
                </div>';
      }
    }
  } else {
    logError("Please enter valid login credentials.", $errorLogFilePath);
    echo '
        <div>
          <div class="toast-container" style="position: absolute; top: 10px; right: 10px">
            <div class="toast fade show">
              <div class="toast-header">
                <strong class="me-auto"><i class="bi-globe"></i>Sorry!</strong>
                <small>just now</small>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="toast"
                ></button>
              </div>
              <div class="toast-body">Please enter valid login credential.</div>
            </div>
          </div>
        </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./Public/assets/css/login.css" />
  <script src="./Public/assets/js/loginvalidation.js"></script>
</head>

<body class="form-v5">
  <div class="page-content">
    <div class="form-v5-content">
      <form id="loginvalidate" class="form-detail" action="#" method="POST">
        <img style="margin-left: 45%;" id="myimg" src="public/assets/images//student-management-8.svg" width="50px" height="50px" class="myimg" alt="">
        <h2 style="margin-top: 10px;">Sign In</h2>
        <div class="form-row">
          <label for="exampleInputEmail1">Username or Email</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" />
          <i class="fas fa-user"></i>
        </div>
        <div class="form-row">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" id="password" class="input-text" placeholder="" />
          <i class="fas fa-lock"></i>
          <a href="./Views/Auth/forgotpassword.php" class="form-control btn btn-link">Forgot Password?</a>
        </div>

        <div class="btnm">
          <a href="<?php echo $login_url ?>"><img src="https://tinyurl.com/46bvrw4s" alt="Google Logo"> Login with Google</a>
        </div>
        <div class="githubbtn">
          <a style="" href="<?php echo $authorizationUrl ?>"><img src="data:image/png;base64,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" alt="GitHub Logo"> Sign in with GitHub</a>
        </div>


        <div class="form-row-last">
          <input id="myButton" type="submit" name="register" class="register" value="Sign In" />
          <p>Don't have an account? <a href="./Views/Auth/signup.php">Sign Up</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js " integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/js/bootstrap-toaster.min.js"></script>
<script>
  $(document).ready(function() {
    $(".toast").toast({
      autohide: false,
    });
  });
</script>

</html>