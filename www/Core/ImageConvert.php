<?php

namespace App\Core;

use Exception;

class ImageConvert
{
    function convertImageToWebp(string $imageData, int $quality = 80): string
    {
        // Détecter le format de l'image via getimagesizefromstring
        $imageInfo = getimagesizefromstring($imageData);
        if ($imageInfo === false) {
            throw new Exception("Données d'image invalides.");
        }

        $mime = $imageInfo['mime'];

        // Charger l'image selon son type MIME avec if / else if
        if ($mime === 'image/jpeg') {
            $image = imagecreatefromstring($imageData);
        } else if ($mime === 'image/png') {
            $image = imagecreatefromstring($imageData);
            // Gestion de la transparence PNG
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        } else if ($mime === 'image/webp') {
            $image = imagecreatefromstring($imageData);
        } else {
            throw new Exception("Format d'image non pris en charge.");
        }

        // Démarrer une capture en mémoire pour récupérer les données binaires
        ob_start();
        imagewebp($image, null, $quality);
        $webpData = ob_get_clean();

        // Libérer la mémoire
        imagedestroy($image);

        return $webpData;
    }
    function renameImage(string $imageData, string $newName): string
    {
        $imageInfo = getimagesizefromstring($imageData);
        if ($imageInfo === false) {
            throw new Exception("Données d'image invalides.");
        }

        $extension = image_type_to_extension($imageInfo[2]);
        return $newName . $extension;
    }


}