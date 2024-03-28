<?php
require __DIR__."/../../Services/ConnectionServices.php";

$chunkSize = 50;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $chunkSize;

$sql = "SELECT * FROM users LIMIT $offset, $chunkSize";
$result = $conn->query($sql);

$hasMore = $result->num_rows === $chunkSize;

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, array('ID', 'Name', 'Email', 'Created At'));

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);

$conn->close();

if ($hasMore) {
    echo '<a href="?page=' . ($page + 1) . '">Next Page</a>';
}
?>
