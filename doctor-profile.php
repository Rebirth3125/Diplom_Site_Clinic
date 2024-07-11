<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль врача</title>
    <link rel="stylesheet" href="doctors-profile.css">
</head>
<body>

<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

$doctorName = $conn->real_escape_string($_GET['doctor_name']);

$query = "SELECT * FROM doctors WHERE doctor_name = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("s", $doctorName);


$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $backgroundImage = $row['background_image'];

    echo "<div class='doctor-profile' style='background-image: url(\"$backgroundImage\");'>";
    echo "<h1>Профиль врача: " . $row['doctor_name'] . "</h1>";
    echo "<img src='" . $row['image_url'] . "' alt='Портрет врача'>";

    echo "<div class='text-section'>";
    echo "<p class='info-label'>Контактная информация:</p>";
    echo "<p class='info-content'>" . $row['contact_info'] . "</p>";

    echo "<p class='info-label'>Стаж работы:</p>";
    echo "<p class='info-content'>" . $row['experience_years'] . " " . getExperienceLabel($row['experience_years']) . "</p>";

    echo "<p class='info-label'>Специальность:</p>";
    echo "<p class='info-content'>" . $row['specialty'] . "</p>";
    echo "</div>"; 

    echo "<button class='back-button' onclick='goBack()'>Назад к списку врачей</button>";
} else {
    echo "<p>Врач не найден</p>";
}

$stmt->close();
$conn->close();

function getExperienceLabel($years) {
    $lastDigit = $years % 10;
    $lastTwoDigits = $years % 100;

    if ($lastDigit === 1 && $lastTwoDigits !== 11) {
        return 'год';
    } elseif (($lastDigit >= 2 && $lastDigit <= 4) && !($lastTwoDigits >= 12 && $lastTwoDigits <= 14)) {
        return 'года';
    } else {
        return 'лет';
    }
}
?>

<script>
function goBack() {
    window.history.back();
}
</script>

</body>
</html>
