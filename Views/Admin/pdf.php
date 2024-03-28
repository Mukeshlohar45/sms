<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../Services/ConnectionServices.php';
require_once __DIR__ . '/../../Config/Mail.php';


use Dompdf\Dompdf;
use Dompdf\Options;

$xyz = new Database();
$db = $xyz->getconnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM registration_infos";
    $result = mysqli_query($db, $sql);

    $tableData = '';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // $profileImageSrc = 'http://localhost/student_management_system/Public/uploads/' . $row["profile"];
            $profileImageSrc = BASE_URL . '/Public/uploads/' . $row["profile"];

            $tableData .= '
                <tr>
                    <td><img src="' . $profileImageSrc . '" class="profile rounded-circle ml-5" style="max-width:100px;"></td>
                    <td>' . $row["firstname"] . ' ' . $row["lastname"] . '</td>
                    <td>' . $row["phonenumber"] . '</td>
                    <td>' . $row["gender"] . '</td>
                    <td>' . ($row["status"] == "active" ? 'Active' : 'Deactive') . '</td>
                    <td>' . ($row["is_varified"] == "true" ? 'Yes' : 'No') . '</td>
                    <td>' . ($row["is_approved"] == "true" ? 'Yes' : 'No') . '</td>
                </tr>';
        }
    }

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $html = '
        <html>
        <head>
            <style>
                h2 {
                    text-align: center;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                    padding: 8px;
                    border: none;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h2>Student Information</h2>
            <table>
                <tr>
                    <th>Profile</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Is Varified</th>
                    <th>Is Approved</th>
                </tr>
                ' . $tableData . '
            </table>
        </body>
        </html>';

        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->getCanvas()->get_cpdf()->setEncryption('123', '123', ['print', 'modify', 'copy', 'add']);
    
        $dompdf->render();
    
        $dompdf->stream('student_information.pdf', ['Attachment' => true]);
}
