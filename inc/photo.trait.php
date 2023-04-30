<?php
/**
 * Function : upload_photo
 * Need $_POST["nom"], $_POST["prenom"] and $_FILES[$file][]
 */
function upload_photo($file, $photoName, $toUpdate = false )
{
    $error = "";
    /** 
     * Traitement de la photo
     */
        
    // Modifie le nom de la photo
    $_FILES[$file]["name"] = $photoName.date("Ymdhs").".jpg";
    // Supprime les espaces blancs
    str_replace(' ','',$_FILES[$file]["name"]);

    $target_dir = "../media/";
    $target_file = $target_dir . basename($_FILES[$file]["name"]);
    //Variable pivot de vérification
    (int)$uploadOk = 1;
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$file]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if the file already exist within the folder
    if(!$toUpdate)
    {  
        if(file_exists($target_file)) {    
            $error = "Désolé, le fichier existe déjà. Veuillez en choisir un autre";
            $uploadOk = 0;
        }
    }
    // Check file size
    if ($_FILES[$file]["size"] > 500000) {
        $error = "Désolé, votre image est trop grande. Veuillez la compresser ou choisir une autre image";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return false;
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
           return true;
        } else {
            return false;
        }
    }
}