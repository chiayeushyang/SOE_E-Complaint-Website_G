<?php

$zip_file = "file/all-file.zip";
touch($zip_file);

//open zip file
$zip = new ZipArchive;
$this_zip = $zip->open($zip_file);

if ($this_zip) {

    // $file_with_path = "uploads/paip.jpg";
    // $name = "paip.jpg";
    // $zip->addFile($file_with_path, $name );

    $folder = opendir("uploads");

    if ($folder) {

        while (false !== ($file  = readdir($folder))) {
            if ($file !== "." && $file !== "..") {
                $file_with_path = "uploads/" . $file;
                $zip->addFile($file_with_path, $file);   
            }
        }
        $zip->close();
        closedir($folder);
    }

    if (file_exists($zip_file)) {
        //name when downloaded
        $download_name = "complaint.zip";

        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="' . $download_name . '"');

        readfile($zip_file); // auto download    
        unlink($zip_file);
    }
}

// // include database connection
// include 'config/database.php';
// try {
//     // get record ID
//     // isset() is a PHP function used to verify if a value is there or not
//     // $id=isset($_GET['id']) ? $_GET['id'] :  die('ERROR: Record ID not found.');
//     $id = 9;

//     $zip_file = "file/all-file.zip";

//     if (!is_file($zip_file)) {
//         fopen($zip_file, 'w');
//     }

//     $zip = new ZipArchive;
//     $opening_zip = $zip->open($zip_file);

//     if ($opening_zip) {

//         $folder = opendir('uploads');

//         if ($folder) {
//             while (false !== ($file  = readdir($folder))) {
//                 if ($file !== "." && $file !== "..") {
//                     $file_with_path = "uploads/".$file;
//                     $zip->addFile($file_with_path, $file);
//                 }
//             }
//             closedir($folder);
//         }
//     }

//     if(file_exists($zip_file))
//     {
//         $demo_name = "complaint.zip";

//         header('Content-type: application/zip');
//         header('Content-Disposition: attachment; filenmae="'.$demo_name.'"');

        
//     }

// }
// // show error
// catch (PDOException $exception) {
//     die('ERROR: ' . $exception->getMessage());
// }
