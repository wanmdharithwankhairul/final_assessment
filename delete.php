
<?php
require_once 'auth.php';
?>

<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {

    $id = filter_var($_POST['delete'], FILTER_VALIDATE_INT);

    if ($id === false || $id <= 0) {
        header("Location: index.php");
        exit;
    }

    $sql = $conn->prepare("DELETE FROM result WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $sql->close();

    header("Location: index.php");
    exit;
}

header("Location: index.php");
exit;
?>
