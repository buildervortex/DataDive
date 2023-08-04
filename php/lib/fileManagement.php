<?php
// get the location of the uploads directory
$root = __DIR__."/../../uploads/";
$defaultProfilePicture = $root."author/profilePicture/defaultProfilePicture.jpg";
$defaultThumbnail = $root."publication/thumbnail/defaultThumbnail.png";

function convertPathToLocalPath($path){
    return "/uploads/".(explode("uploads",$path)[1]);
}


function getProfilePictureLocation($userId){
    global $root,$defaultProfilePicture;
    $profilePictureSet = glob($root."author/profilePicture/".$userId."*");
    if(count($profilePictureSet)==1){
        return convertPathToLocalPath($profilePictureSet[0]);
    }
    return convertPathToLocalPath($defaultProfilePicture);
}

function getThumbnailLocation($userId,$publicationId){
    global $root,$defaultThumbnail;
    if(!is_dir($root."publication/thumbnail/".$userId."/"))return null;
    $thumbnailSet = glob($root."publication/thumbnail/".$userId."/".$publicationId."*");
    if(count($thumbnailSet)==1){
        return convertPathToLocalPath($thumbnailSet[0]);
    }
    return convertPathToLocalPath($defaultThumbnail);

}

function getPdfLocation($userId,$publicationId){
    global $root;
    $pdfSet = glob($root."publication/pdf/".$userId."/".$publicationId."*");
    if(count($pdfSet)==1){
        return convertPathToLocalPath($pdfSet[0]);
    }
    return null;
}

function addProfilePicture($userId,$sourcefile){
    global $root;
    $extension = pathinfo($sourcefile,PATHINFO_EXTENSION);
    $oldFiles = glob($root."author/profilePicture/".$userId.".*");
    if(count($oldFiles) == 1){
        unlink($oldFiles[0]);
    }
    $pathForProfilePicture = $root."author/profilePicture/".$userId.".".$extension;
    rename($sourcefile,$pathForProfilePicture);
}

function addThumbnail($userId,$publicationId,$sourcefile){
    global $root;
    $extension = pathinfo($sourcefile,PATHINFO_EXTENSION);
    $pathForThumbnail = $root."publication/thumbnail/".$userId."/";
    if(!is_dir($pathForThumbnail)){
        mkdir($pathForThumbnail);
    }
    else{
        $oldFile = glob($pathForThumbnail.$publicationId.".*");
        if(count($oldFile) ==1){
            unlink($oldFile[0]);
        }
    }
    $pathForThumbnail = $pathForThumbnail.$publicationId.".".$extension;
    rename($sourcefile,$pathForThumbnail);
}
function addPdf($userId,$publicationId,$sourcefile){
    global $root;
    $pathForPdf = $root."publication/pdf/".$userId."/";
    if(!is_dir($pathForPdf)){
        mkdir($pathForPdf);
    }
    $pathForPdf = $pathForPdf.$publicationId.".pdf";
    rename($sourcefile,$pathForPdf);
}
function removeRecursively($path){
    if(!is_dir($path))return;
    $content = glob($path."*");
    
    foreach($content as $file){
        if(is_file($file)){
            unlink($file);
        }
        else{
            removeRecursively($file);
        }
    }
    rmdir($path);
}

function removePublication($userId,$publicationId){
    global $root;
    $pathForPdf = $root."publication/pdf/".$userId."/".$publicationId.".pdf";
    $thumbnailSet = glob($root."publication/thumbnail/".$userId."/".$publicationId."*");
    unlink($thumbnailSet[0]);
    unlink($pathForPdf);
}

function removeUser($userId){
    global $root;
    $pathForProfilePicture = glob($root."author/profilePicture/".$userId.".*");
    if(count($pathForProfilePicture)==1){
        unlink($pathForProfilePicture[0]);
    }

    removeRecursively($root."publication/thumbnail/".$userId."/");
    removeRecursively($root."publication/pdf/".$userId."/");
}

?>