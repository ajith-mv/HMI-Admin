<?php
function resizeImage($sourcePath, $targetPath, $maxWidth, $maxHeight)
{
    list($origWidth, $origHeight, $imageType) = getimagesize($sourcePath);

    $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
    $newWidth = round($origWidth * $ratio);
    $newHeight = round($origHeight * $ratio);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        case IMAGETYPE_WEBP:
            $sourceImage = imagecreatefromwebp($sourcePath);
            break;
        default:
            return false; // Unsupported image type
    }

    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
        imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
    }

    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($newImage, $targetPath, 90); // 90% quality
            break;
        case IMAGETYPE_PNG:
            imagepng($newImage, $targetPath, 8); // Compression level 8
            break;
        case IMAGETYPE_GIF:
            imagegif($newImage, $targetPath);
            break;
        case IMAGETYPE_WEBP:
            imagewebp($newImage, $targetPath, 90); // 90% quality
            break;
    }

    imagedestroy($sourceImage);
    imagedestroy($newImage);

    return basename($targetPath);

}

// if (!empty($_FILES['cat_image']['tmp_name'])) {
//     $image = $_FILES['cat_image'];

//     $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp',];
//     if (!in_array($image['type'], $allowedTypes)) {
//         return json_encode(["rslt" => "error", "msg" => "Invalid image type. Only JPG, PNG, WEBP and GIF allowed."]);
//         exit;
//     }

//     // Generate unique file name
//     $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
//     $filename = pathinfo($image['name'], PATHINFO_FILENAME);
//     $newFilename = $filename . '-' . rand(100, 999) . '.' . $extension;

//     $uploadDir = '../uploads/category/';
//     $originalPath = $uploadDir . $newFilename;
//     $resizedPath = $uploadDir . 'resized-' . $newFilename;

//     // Move uploaded file
//     if (move_uploaded_file($image['tmp_name'], $originalPath)) {
//         $maxWidth = 767;
//         $maxHeight = 460;
//         $resizedFilePath = resizeImage($originalPath, $resizedPath, $maxWidth, $maxHeight);

//         return basename($resizedFilePath);

//     } else {
//         return json_encode(["rslt" => "error", "msg" => "Image upload failed."]);
//     }
// } else {
//     return json_encode(["rslt" => "error", "msg" => "No file uploaded."]);
// }
?>