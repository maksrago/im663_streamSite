<?php
// Handles upload of badge file
include "../../config.php";
include "../../database.php";

$badge_name = filter_input(INPUT_POST, "badgename", FILTER_SANITIZE_STRING);
$badge_name = str_replace(' ', '', $badge_name);
$stream_id = filter_input(INPUT_POST, "stream_id", FILTER_SANITIZE_NUMBER_INT);
if(isset($_POST["upload_badge"])) {
    $target_file = "../../" . badge_dir . basename($_FILES["badgefile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["badgefile"]["tmp_name"]);
        if($check == false) {
            header("Location: " . access_point . admin_panel . "forms/uploadbadge.php?error=notimage");
            die();
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        header("Location: " . access_point . admin_panel . "forms/uploadbadge.php?error=file_exists");
        die();
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > max_badge_size) {
        header("Location: " . access_point . admin_panel . "forms/uploadbadge.php?error=filetoobig");
        die();
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        header("Location: " . access_point . admin_panel . "forms/uploadbadge.php?error=badformat");
        die();
    }
// Check if $uploadOk is set to 0 by an error

        if (move_uploaded_file($_FILES["badgefile"]["tmp_name"], $target_file)) {

            $add_to_badges = $dbh->prepare("INSERT INTO badges (filename, name, stream_id) VALUES (:filename, :name, :stream_id)");
            $add_to_badges->execute(["filename" => basename($_FILES["badgefile"]["name"]), "name" => $badge_name, "stream_id" => $stream_id]);

            header("Location: " . access_point . admin_panel . "forms/uploadbadge.php?success=upload");
            die();
        } else {
            header("Location: " . access_point . admin_panel . "forms/uploadbadge.php?error=errorupload");
            die();
}