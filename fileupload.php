<?php
session_start();
$sp = mysqli_connect("localhost", "root", "", "oas");

if ($sp->connect_errno) {
    echo "Error <br/>".$sp->error;
}

function validateFile($file, $allowedTypes, $maxSize)
{
    // Check for file upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "Error uploading file";
    }

    // Check if file types are allowed
    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileType, $allowedTypes)) {
        return "Invalid file type";
    }

    // Check if file sizes are within the allowed limit
    if ($file['size'] > $maxSize) {
        return "File size exceeds limit";
    }

    return "";
}

$picpath = "studentpic/";
$docpath = "studentdoc/";
$proofpath = "studentproof/";
$id = $_SESSION['user'];

if (isset($_POST['fpicup'])) {
    $allowedImageTypes = array('image/jpeg', 'image/png', 'image/gif');
    $allowedDocumentTypes = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $allowedProofTypes = array('image/jpeg', 'image/png', 'image/gif', 'application/pdf');
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    $picValidation = validateFile($_FILES['fpic'], $allowedImageTypes, $maxFileSize);
    $doc1Validation = validateFile($_FILES['ftndoc'], $allowedDocumentTypes, $maxFileSize);
    $doc2Validation = validateFile($_FILES['ftcdoc'], $allowedDocumentTypes, $maxFileSize);
    $doc3Validation = validateFile($_FILES['fdmdoc'], $allowedDocumentTypes, $maxFileSize);
    $doc4Validation = validateFile($_FILES['fdcdoc'], $allowedDocumentTypes, $maxFileSize);
    $proof1Validation = validateFile($_FILES['fide'], $allowedProofTypes, $maxFileSize);
    $proof2Validation = validateFile($_FILES['fsig'], $allowedProofTypes, $maxFileSize);

    if ($picValidation || $doc1Validation || $doc2Validation || $doc3Validation || $doc4Validation || $proof1Validation || $proof2Validation) {
        echo $picValidation . " " . $doc1Validation . " " . $doc2Validation . " " . $doc3Validation . " " . $doc4Validation . " " . $proof1Validation . " " . $proof2Validation;
        exit;
    }

    $picpath = $picpath . $_FILES['fpic']['name'];
    $docpath1 = $docpath . $_FILES['ftndoc']['name'];
    $docpath2 = $docpath . $_FILES['ftcdoc']['name'];
    $docpath3 = $docpath . $_FILES['fdmdoc']['name'];
    $docpath4 = $docpath . $_FILES['fdcdoc']['name'];
    $proofpath1 = $proofpath . $_FILES['fide']['name'];
    $proofpath2 = $proofpath . $_FILES['fsig']['name'];

    // Check if the files were uploaded successfully
    if (move_uploaded_file($_FILES['fpic']['tmp_name'], $picpath) &&
    move_uploaded_file($_FILES['ftndoc']['tmp_name'], $docpath1) &&
    move_uploaded_file($_FILES['ftcdoc']['tmp_name'], $docpath2) &&
    move_uploaded_file($_FILES['fdmdoc']['tmp_name'], $docpath3) &&
    move_uploaded_file($_FILES['fdcdoc']['tmp_name'], $docpath4) &&
    move_uploaded_file($_FILES['fide']['tmp_name'], $proofpath1) &&
    move_uploaded_file($_FILES['fsig']['tmp_name'], $proofpath2))
    {
        // Update the user's profile with the file paths
        $query = "UPDATE t_userdoc SET s_pic='$picpath', s_tenmarkpic='$docpath1', s_tencerpic='$docpath2', s_twdmarkpic='$docpath3', s_twdcerpic='$docpath4', s_idprfpic='$proofpath1', s_sigpic='$proofpath2' WHERE s_id='$id'";
        $result = $sp->query($query);
        if ($result) {
            echo "Files uploaded successfully";
        } else {
            echo "Error uploading files";
        }
    } else
    {
        echo "Error uploading files";
    }
}
?>