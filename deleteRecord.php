<?php require 'includes/header.php'; ?>
<h2>Delete Record</h2>
<form method="post" >
    <label for="id">Enter ID of the record you want to delete</label>
    <input type="number" name="id" id=""> <br>
    <button>Delete</button>
    <a href="/">Cancel</a>
</form>
<?php
require 'includes/database.php';
require 'includes/validate.php';
$conn=getDB();
if (isset($_POST['id'])) {
    $record=getRecord($conn, $_POST['id']);
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

        $sql = "DELETE FROM records WHERE id=?";
        $stmt= mysqli_prepare($conn, $sql);
        if ($stmt===false) {
            echo mysqli_error($conn);
        }else{
            mysqli_stmt_bind_param($stmt, 'i', $id);
            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
            }
            else{
                echo mysqli_stmt_error($stmt);
            }
        }
    }

?>

<?php require 'includes/footer.php'; ?>
