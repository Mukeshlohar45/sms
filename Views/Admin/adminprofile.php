<?php
require __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/../../Config/Mail.php";
// require __DIR__."/../../Controllers/Admin/GeneratePdf.php";
use Dompdf\Dompdf;
use Dompdf\Options;
session_start();

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Student management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../public/assets/css/adminprofile.css">
  <link rel="stylesheet" href="../../public/assets/css/admin.css">

</head>

<body>
  <?php
  // echo BASE_URL;
  if (!isset($_SESSION['role'])) {
    header("Location: ./index.php");
  }

  if ($_SESSION['role'] != 'admin') {
    header("Location: ./index.php");
  }
  ?>
  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <img class="mb-5 ml-5" src="../../public/assets/images/student-management-8.svg" width="85px" height="85px" alt="">
        <ul class="list-unstyled components mb-5">
          <li>
            <a href="" style="margin:20px" id="dashboard"><i class="fa fa-dashboard m-2" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashboard</span></a>
          </li>
          <li>
            <a href="" style="margin:20px" id="allstudent"><i class="fa fa-users m-2" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Students</span></a>
          </li>
          <li>
            <a href="" style="margin:20px" id="notification"><i class="fa fa-bell m-2" aria-hidden="true"></i><span class="hidden-xs hidden">Notifications</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <div id="content" class="p-4 p-md-5">

      <nav class="navbar navbar-expand-xl navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
          </button>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item active">
                <img src="../../public/assets/images/1.jpg" alt="" class="img logo rounded-circle mr-3" height="40px" width="40px">
              </li>
              <li class="nav-item">
                <a class="btn btn-danger" href="../../Controllers/Auth/DestroySession.php">Sign Out <i class="fa fa-sign-out"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="conntt">
        <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
      </div>
      <div id="tbody">
        <div class="d-flex mb-3">
          <div class="btnn">
            <form action="./Excel.php" method="POST">
              <input type="submit" class="btn btn-info" value="Export">
            </form>
            </div>
          <div class="btnn ml-auto">
            <form method="POST" action="./pdf.php">
              <input type="submit" class="btn btn-warning" value="Generate PDF">
            </form>
          </div>
          
        </div>
        
        <table id="myTable" class="display">
          <thead>
            <tr>
              <th>Profile</th>
              <th>Name</th>
              <th>Mobile Number</th>
              <th>Gender</th>
              <th>Status</th>
              <th>Is Varified?</th>
              <th>Is Approved?</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>`
      
      </div>

      <div id="notify">
        <div class="notificationform">
          <button id="sendMessageButton" class="sendmessage float-right"><i class="fa fa-envelope m-2"></i>Send Email</button>
          <div id="sendMessageModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <form id="sendMessageForm" method="POST" action="./../../Controllers/Admin/sendEmail.php">
                <label for="subject">Subject:</label>
                <input type="text" name="subject">
                <label for="recipientEmail">Recipient Email:</label>
                <select id="recipientEmail" name="recipientEmail[]" multiple="multiple">
                  <option value="" class="form-control">Select</option>
                  <?php
                  include_once "../../Controllers/Admin/SendMessage.php";
                  ?>
                </select>
                <label for="message">Message:</label>
                <textarea id="message" name="message"></textarea>
                <input type="submit" value="Send" class="btn btn-primary">
              </form>
            </div>
          </div>
          <div id="popupContainer" class="popupContainer">
            <div class="popupContent" id="popupContent">

            </div>
          </div>


        </div>
        <table id="myTab" class="displayNotifications">
          <thead>
            <tr>
              <th>Recipients</th>
              <th>Subject</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../../public/assets/js/adminprofile.js"></script>
    <script src="../../public/assets/js/popper.js"></script>
    <script src="../../public/assets/js/admin.js"></script>

    
</body>

</html>