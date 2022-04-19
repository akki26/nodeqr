<?php

namespace Drupal\product_qr_code\Controller;


use Drupal\Core\Controller\ControllerBase;
use \Drupal\file\Entity\File;

/**
 * An example controller.
 */
class ProductQrController extends ControllerBase {

  


  /**
   * Returns a render-able array for a test page.
   */
  public function content() {

      
      // The below code will automatically create the path for the img.
    $path = '';
    $directory = "public://Images/QrCodes/";
    //prepareDirectory()($directory, FILE_MODIFY_PERMISSIONS | FILE_CREATE_DIRECTORY);
    \Drupal::service('file_system')->prepareDirectory($directory, \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY);
    // Name of the generated image.
    $qrName = 'myQrcode';
    $uri = $directory . 'QR'. '.png'; // Generates a png image.
    
    $path =  \Drupal::service('file_system')->realpath($uri);
    
    // Generate QR code image.
    \PHPQRCode\QRcode::png("www.google.com", $path, 'H', 10, 2);
  
    $relative_file_url =  \Drupal::service('file_url_generator')
    ->generateAbsoluteString($uri); 
    
      $qr_image = "<img src='{$relative_file_url}'/>";
      

    $build = [
      '#markup' => $qr_image,
    ];
    return $build;
  }



}