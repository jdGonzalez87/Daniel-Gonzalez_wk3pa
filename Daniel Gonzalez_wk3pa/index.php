<?php
include("db_connect.php");

// ADD new record
if (isset($_POST['add'])) {
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $color = $_POST['color'];
    $place = $_POST['place'];
    $nickname = $_POST['nickname'];

    $sql = "INSERT INTO personal_info (FullName, Birthdate, FavoriteColor, FavoritePlace, Nickname)
            VALUES ('$fullname', '$birthdate', '$color', '$place', '$nickname')";
    $conn->query($sql);
}

// DELETE record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM personal_info WHERE UserNo=$id");
}

// UPDATE record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $color = $_POST['color'];
    $place = $_POST['place'];
    $nickname = $_POST['nickname'];

    $sql = "UPDATE personal_info 
            SET FullName='$fullname', Birthdate='$birthdate', FavoriteColor='$color', 
                FavoritePlace='$place', Nickname='$nickname'
            WHERE UserNo=$id";
    $conn->query($sql);
}

// LOAD record for editing
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = $conn->query("SELECT * FROM personal_info WHERE UserNo=$id");
    $editData = $editResult->fetch_assoc();
}

// GET all records
$result = $conn->query("SELECT * FROM personal_info");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Name Wk 3 Performance Assessment</title>
</head>
<body>

<h2>Your Name Wk 3 Performance Assessment</h2>

<!-- ADD/UPDATE FORM -->
<form method="POST">

    <input type="hidden" name="id" value="<?= $editData['UserNo'] ?? '' ?>">

    <label>Full Name:</label><br>
    <input type="text" name="fullname" value="<?= $editData['FullName'] ?? '' ?>"><br><br>

    <label>Birthdate:</label><br>
    <input type="text" name="birthdate" value="<?= $editData['Birthdate'] ?? '' ?>"><br><br>

    <label>Favorite Color:</label><br>
    <input type="text" name="color" value="<?= $editData['FavoriteColor'] ?? '' ?>"><br><br>

    <label>Favorite Place To Visit:</label><br>
    <input type="text" name="place" value="<?= $editData['FavoritePlace'] ?? '' ?>"><br><br>

    <label>Nickname:</label><br>
    <input type="text" name="nickname" value="<?= $editData['Nickname'] ?? '' ?>"><br><br>

    <?php if ($editData): ?>
        <button type="submit" name="update">Update</button>
    <?php else: ?>
        <button type="submit" name="add">Add New</button>
    <?php endif; ?>

</form>

<hr>

<h3>Stored Personal Information</h3>

<table border="1" cellpadding="5">
<tr>
    <th>UserNo</th>
    <th>FullName</th>
    <th>Birthdate</th>
    <th>FavoriteColor</th>
    <th>FavoritePlace</th>
    <th>Nickname</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['UserNo'] ?></td>
    <td><?= $row['FullName'] ?></td>
    <td><?= $row['Birthdate'] ?></td>
    <td><?= $row['FavoriteColor'] ?></td>
    <td><?= $row['FavoritePlace'] ?></td>
    <td><?= $row['Nickname'] ?></td>
    <td>
        <a href="index.php?edit=<?= $row['UserNo'] ?>">Edit</a> |
        <a href="index.php?delete=<?= $row['UserNo'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
