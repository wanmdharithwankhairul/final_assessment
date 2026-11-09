
<?php
require_once 'auth.php';
?>

<?php
include 'db.php';

$Student_name = '';
$Matric_no = '';
$Subject_name = '';
$Subject_code = '';
$Test_1 = '';
$Test_2 = '';
$Final_examination = '';

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
        "INSERT INTO result
        (student_name, matric_no, subject_name, subject_code,
        test_1, test_2, final_examination, total_marks, final_grade)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $sql->bind_param(
        "ssssdddds",
        $student_name,
        $matric_number,
        $subject_name,
        $subject_code,
        $test_1,
        $test_2,
        $final_examination,
        $total_marks,
        $final_grade
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

<h2>Add Result</h2>

<?php
include 'form.php';
include 'footer.php';
?>
