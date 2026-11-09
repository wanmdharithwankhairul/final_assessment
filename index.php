
<?php
require_once 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment - Student Grading</title>
</head>

<body>

<?php
include 'db.php';
include 'header.php';

$search = $_GET['search'] ?? "";
$like = "%" . $search . "%";

$sql = $conn->prepare(
    "SELECT * FROM result
    WHERE student_name LIKE ?
    OR matric_no LIKE ?
    OR subject_name LIKE ?
    OR subject_code LIKE ?
    ORDER BY student_name"
);

$sql->bind_param("ssss", $like, $like, $like, $like);
$sql->execute();

$result = $sql->get_result();
?>

<h2>Student Records</h2>

<a href="add.php">Add Result</a>

<br><br>

<form method="get" action="index.php">
    <input
        type="text"
        name="search"
        placeholder="Search by name or ID"
        value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
    >

    <button type="submit">Search</button>
    <a href="index.php">Show All</a>
</form>

<br><br>

<table border="1">
    <tr>
        <th>No.</th>
        <th>Student Name</th>
        <th>Matric No.</th>
        <th>Subject</th>
        <th>Test 1 (20%)</th>
        <th>Test 2 (30%)</th>
        <th>Final (50%)</th>
        <th>Total</th>
        <th>Grade</th>
        <th>Actions</th>
    </tr>

    <?php
    $count = 1;

    while ($row = $result->fetch_assoc()) {
        $id = (int) $row['id'];

        echo "<tr>";
        echo "<td>" . $count++ . "</td>";
        echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['matric_no']) . "</td>";
        echo "<td>" . htmlspecialchars($row['subject_name']) .
             "<br>(" . htmlspecialchars($row['subject_code']) . ")</td>";
        echo "<td>" . htmlspecialchars($row['test_1']) . "</td>";
        echo "<td>" . htmlspecialchars($row['test_2']) . "</td>";
        echo "<td>" . htmlspecialchars($row['final_examination']) . "</td>";
        echo "<td>" . htmlspecialchars($row['total_marks']) . "</td>";
        echo "<td>" . htmlspecialchars($row['final_grade']) . "</td>";

        echo "<td>";

        echo "<a href='edit.php?id=" . $id . "'>Edit</a> ";

        echo "<form method='post' action='delete.php'
                onsubmit='return confirm(\"Are you sure you want to delete this record?\");'
                style='display:inline;'>";

        echo "<input type='hidden' name='delete' value='" . $id . "'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";

        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
if ($result->num_rows == 0) {
    if ($search != "") {
        echo "<h3 style='color:red;'>
                No records match your search criteria.
              </h3>";
    } else {
        echo "<h3 style='color:grey;'>
                No records found.
              </h3>";
    }
}

$sql->close();

include 'footer.php';
?>

</body>
</html>
