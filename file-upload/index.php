<?php
$file_dir = 'uploads';
$message = '';

if (!is_dir($file_dir)) {
    mkdir($file_dir, 0755, true);
}

if (isset($_FILES['file'])) {
    $filename = basename($_FILES['file']['name']);
    $file_path = "{$file_dir}/{$filename}";
    $imageFileType = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        $message = 'Only JPG, JPEG, and PNG files are allowed.';
    } elseif (file_exists($file_path)) {
        $message = 'File already exists.';
    } elseif (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
        $message = 'File uploaded successfully';
    } else {
        $message = 'Error uploading file.';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>File Upload</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <p><?php echo $message; ?></p>
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
</body>

</html>