    <?php

//$id
//$title
//$description
//$path
//$type
//$idParent
//$typeParent
//$isDeleted
//$dateInserted
//$dateUpdated

if( !empty($_POST['title']) && !empty($_POST['description'])) {
    $mediafile = new Mediafile();

    $id = $idUpdate;
    $title = htmlentities($_POST['title']);
    $description = htmlentities($_POST['description']);
    $now = date("Y-m-d H:i:s");
    $path = $pathUpdate;

    $error = false;
    $listOfErrors = [];

    if ($title !== $titleUpdate && $mediafile->populate(['title' => $title])){
        //Le titre est déja utilisé
        $listOfErrors[] = "titleUsed";
        $error = true;
    }

    if (strlen($title) < 0) {
        //Le titre doit faire au moins 2 caractères
        $listOfErrors[] = "nbTitle";
        $error = true;
    }

    //Vérifier le description
    if (strlen($description) < 0) {
        //La description doit faire au moins 2 caractères
        $listOfErrors[] = "nbContent";
        $error = true;
    }


    /*if(isset($_FILES['mediafile']) AND $_FILES['mediafile']['error'] == 0){
        $fileType = ["png", "jpg", "jpeg", "gif", "mp3", "wav", "mp4", "mov"];
        $limitSize = 10000000;
        $infoFile = pathinfo($_FILES["mediafile"]["name"]);

        if (!in_array(strtolower($infoFile["extension"]), $fileType)) {
            $listOfErrors[] = "badMediaFileType";
            $error = true;
        }

        if ($_FILES["mediafile"]["size"] > $limitSize) {
            $listOfErrors[] = "11";
            $error = true;
        }

        switch (strtolower($infoFile["extension"])) {
            case "png":
            case "jpg":
            case "jpeg":
            case "gif":
                $type = "image";
                break;
            case "mp3":
            case "wav":
                $type = "musique";
                break;
            case "mp4":
            case "mov":
                $type = "vidéo";
                break;
        }

        if ($typeUpdate != $type) {
            $listOfErrors[] = "typeDiff";
            $error = true;
        }

        //Est ce que le dossier upload existe}
        $pathUpload = $_SERVER['DOCUMENT_ROOT'] . DS . "esgi-aire" . DS . "images" . DS . "upload";
        $nameFile = explode("/", $pathUpdate);
        $nameFile = $nameFile[2];
        move_uploaded_file($_FILES["mediafile"]["tmp_name"],  $pathUpload.DS.$nameFile);

        if (!file_exists($pathUpload)) {
            //Sinon le créer
            mkdir($pathUpload);
        }

        }*/
    if ($error === false) {
        $pathUpload = $_SERVER['DOCUMENT_ROOT'] . DS . "esgi-aire" . DS . "images" . DS . "upload";

        $nameFile = explode("/", $pathUpdate);
        $nameFile = $nameFile[2];
        $path = $pathUpload.DS.$nameFile;

        $pathServeur = "/images/upload/".$nameFile;

        $mediafile->setId($id);
            $mediafile->setTitle($title);
            $mediafile->setDescription($description);
            $mediafile->setIsDeleted(0);
            $mediafile->setPath($pathServeur);
            $mediafile->setType($typeUpdate);
            $mediafile->setDateInserted($dateInsertedUpdate);
            $mediafile->setDateUpdated($now);

            $mediafile->save();
        $_SESSION['added'] = 1;
        header("Location: ".PATH_RELATIVE."back/mediafile/menu/1");
        } else{
        $_SESSION["form_error"] = $listOfErrors;
        $_SESSION["form_post"] = $_POST;
        $error = true;
    }
} else{
    $listOfErrors[] = "allRequired";
    $_SESSION["form_error"] = $listOfErrors;
    $_SESSION["form_post"] = $_POST;
    $error = true;
}
    if($error==true)
    {
        header("Location: ".PATH_RELATIVE."back/mediafile/add");
    }
