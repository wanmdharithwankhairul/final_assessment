
<?php
require_once 'auth.php';
?>

<?php
include 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    header("Location: index.php");
    exit;
}

$sql = $conn->prepare("SELECT * FROM result WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();

$row = $sql->get_result()->fetch_assoc();
$sql->close();

if (!$row) {
    header("Location: index.php");
    exit;
}

$Student_name = $row['student_name'];
$Matric_no = $row['matric_no'];
$Subject_name = $row['subject_name'];
$Subject_code = $row['subject_code'];
$Test_1 = $row['test_1'];
$Test_2 = $row['test_2'];
$Final_examination = $row['final_examination'];

if (isset($_POST['submit'])) {

    $student_name = trim($_POST['student_name']);
    $matric_number = trim($_POST['matric_number']);
    $subject_name = trim($_POST['subject_name']);
    $subject_code = trim($_POST['subject_code']);
    $test_1 = (float) $_POST['test_1'];
    $test_2 = (float) $_POST['test_2'];
    $final_examination = (float) $_POST['final_examination'];

    if (
        $student_name === '' ||
        $matric_number === '' ||
        $subject_name === '' ||
        $subject_code === '' ||
        $test_1 < 0 || $test_1 > 20 ||
        $test_2 < 0 || $test_2 > 30 ||
        $final_examination < 0 || $final_examination > 50
    ) {
        die("Invalid input. Please check all fields.");
    }

    $total_marks = $test_1 + $test_2 + $final_examination;

    if ($total_marks >= 80) {
        $final_grade = 'A';
    } elseif ($total_marks >= 65) {
        $final_grade = 'B';
    } elseif ($total_marks >= 50) {
        $final_grade = 'C';
    } elseif ($total_marks >= 40) {
        $final_grade = 'D';
    } else {
        $final_grade = 'E';
    }

    $sql = $conn->prepare(
        "UPDATE result SET
        student_name = ?,
        matric_no = ?,
        subject_name = ?,
        subject_code = ?,
        test_1 = ?,
        test_2 = ?,
        final_examination = ?,
        total_marks = ?,
        final_grade = ?
        WHERE id = ?"
    );

    $sql->bind_param(
        "ssssddddsi",
        $student_name,
        $matric_number,
        $subject_name,
        $subject_code,
        $test_1,
        $test_2,
        $final_examination,
        $total_marks,
        $final_grade,
        $id
    );

    if ($sql->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
}

include 'header.php';
?>

<style>
    label {
        display: inline-block;
        width: 200px;
    }
</style>

<h2>Edit Result</h2>

<?php
include 'form.php';
include 'footer.php';
?>
