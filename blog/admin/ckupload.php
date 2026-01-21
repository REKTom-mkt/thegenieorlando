<?php
//Start session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//Return JSON response
header('Content-Type: application/json');
$response = ['error' => 'Invalid request'];

//Catch errors
try {

    if (!isset($_SESSION['user_id'], $_SESSION['user_role'])) {
        throw new \Exception('Request Not Authorized');
    }

    if (!$_SERVER['REQUEST_METHOD'] === 'POST' || !isset($_FILES['upload'])) {
        throw new \Exception('Invalid Request');
    }

    $uploadedFile = $_FILES['upload'];
    if (isset($uploadedFile['error']) && $uploadedFile['error'] != UPLOAD_ERR_OK) {
        $uploadError = '';
        switch ($uploadedFile['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $uploadError = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $uploadError = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $uploadError = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $uploadError = 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $uploadError = 'Missing a temporary folder.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $uploadError = 'Failed to write file to disk.';
                break;
            case UPLOAD_ERR_EXTENSION:
                $uploadError = 'A PHP extension stopped the file upload.';
                break;
            default:
                $uploadError = 'Unknown upload error.';
                break;
        }
        throw new \Exception('Error processing image - ' . $uploadError);
    }

    $fileTempName = $uploadedFile['tmp_name'];
    $fileName = strtolower(basename($uploadedFile['name']));
    $fileSize = $uploadedFile['size'];
    $fileType = $uploadedFile['type'];

    // File Size Filter 1128902
    if ($file_size > 5000000) {
        throw new \Exception('Error processing image - Image too large. Max size is 5MB');
    }

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    //check image mime types
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mtype = finfo_file($finfo, $fileTempName);
    finfo_close($finfo);

    //Check file type and extension
    if (!in_array($mtype, ['image/jpeg', 'image/png']) && !in_array($extension, ['jpg', 'jpeg', 'png'])) {
        throw new \Exception('Invalid File Format');
    }

    $currentDirectory = __DIR__;
    $fileName = str_replace(' ', '_', $fileName);

    //If file already uploaded with the same name then add timestamp to new version name
    $targetPath = $currentDirectory . '/ckuploads/' . $fileName;
    if (file_exists($targetPath)) {
        $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
        $fileName = str_replace(' ', '_', strtolower($fileNameWithoutExtension . '_' . time() . '.' . $extension));
        $targetPath = $currentDirectory . '/ckuploads/' . $fileName;
    }

    // Move Uploaded File to folder
    $uploadSuccess = move_uploaded_file($fileTempName, $targetPath);
    if (!$uploadSuccess) {
        $systemError = error_get_last();
        throw new \Exception('Unexpected Error uploading the file');
    }

    //make uploaded image urls relative
    $requestUriParts = explode('/ckupload.php', $_SERVER['REQUEST_URI']);
    $response = ['url' => $requestUriParts[0] . "/ckuploads/" . $fileName];

} catch (\Exception $th) {
    $response = ['error' => $th->getMessage()];
}

echo json_encode($response);
exit;
