
<?php
require 'includes/database.php';
require 'includes/validate.php';


$conn=getDB();
if (isset($_GET['id'])) {
    $record=getRecord($conn, $_GET['id']);
    if ($record) {
        $id=$record['id'];
        $name = $record['std_name'];
        $contact = $record['contact'];
        $class = $record['class'];
        $maths = $record['maths'];
        $science = $record['science'];
        $social = $record['social'];
        $english = $record['english'];
        $computer = $record['computer'];
    }
    else{
        die("Record not found");
    }
}else{
    die("ID not supplied, record not found");
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $class = $_POST['class'];
    $maths = $_POST['maths'];
    $science = $_POST['science'];
    $social = $_POST['social'];
    $english = $_POST['english'];
    $computer = $_POST['computer'];
    $error = validateRecord($name, $contact, $class, $maths, $science, $social, $english, $computer);
    if (empty($errors)) {
        $sql = "UPDATE records SET std_name=?, contact=?, class=?, maths=?, science=?, social=?, english=?, computer=? WHERE id=?";
        $stmt= mysqli_prepare($conn, $sql);
        if ($stmt===false) {
            echo mysqli_error($conn);
        }else{
            mysqli_stmt_bind_param($stmt, 'ssiiiiiii', $name, $contact, $class, $maths, $science, $social, $english, $computer, $id);
            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
            }
            else{
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}

?>
<?php require 'includes/header.php'; ?>
<h2>Edit Record</h2>
<?php require 'includes/form.php';?>
<?php require 'includes/footer.php'; ?>
