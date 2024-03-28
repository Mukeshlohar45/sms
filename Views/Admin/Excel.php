<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../Services/ConnectionServices.php';

use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Options;


$xyz = new Database();
$db = $xyz->getconnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $activeSql = "SELECT * FROM registration_infos WHERE Status = 'active'";
    $activeResult = mysqli_query($db, $activeSql);

    $deactiveSql = "SELECT * FROM registration_infos WHERE Status = 'deactive'";
    $deactiveResult = mysqli_query($db, $deactiveSql);

    $options = new Options();

    $writer = new Writer($options);
    $style = new OpenSpout\Common\Entity\Style\Style();
    $style->setFontBold(true);
    $writer->openToBrowser('student_information.xlsx');

    $firstSheet = $writer->getCurrentSheet();
    $writer->addRow(Row::fromValues([
        'ID', 'Firstname', 'Lastname', 'PhoneNumber', 'Gender', 'Hobby', 'Message', 'Profile', 'Grade', 'Status', 'Is_varified', 'Is-approved', 'Created_at', 'Updated_at'
    ], $style));

    addRowsFromResult($activeResult, $writer);

    $newSheet = $writer->addNewSheetAndMakeItCurrent();
    $writer->addRow(Row::fromValues([
        'ID', 'Firstname', 'Lastname', 'PhoneNumber', 'Gender', 'Hobby', 'Message', 'Profile', 'Grade', 'Status', 'Is_varified', 'Is-approved', 'Created_at', 'Updated_at'
    ], $style));

    addRowsFromResult($deactiveResult, $writer);

    $writer->close();
}

function addRowsFromResult($result, $writer)
{
    $data = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row_data = mysqli_fetch_assoc($result)) {
            $data[] = Row::fromValues($row_data);
        }
        $writer->addRows($data);
    }
}
?>
