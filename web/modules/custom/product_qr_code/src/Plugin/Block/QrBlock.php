<?php

/**
 * @file
 * Contains \Drupal\product_qr_code\Plugin\Block\QrBlock.
 */
namespace Drupal\product_qr_code\Plugin\Block;

use \Drupal\Core\Block\BlockBase;
use \Drupal\file\Entity\File;

/**
 * Provides a 'QR' Block.
 *
 * @Block(
 *   id = "qr_block",
 *   admin_label = @Translation("QR block"),
 *   category = @Translation("QR World"),
 * )
 */
class QrBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $node = \Drupal::routeMatch()->getParameter('node');
    
    if ($node instanceof \Drupal\node\NodeInterface) {

      $product_link_array = $node->get("field_app_purchase_link")->getValue()[0]['uri'];
      
      $path = '';
      $directory = "public://Images/QrCodes/";
      //prepareDirectory()($directory, FILE_MODIFY_PERMISSIONS | FILE_CREATE_DIRECTORY);
      \Drupal::service('file_system')->prepareDirectory($directory, \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY);
       // Name of the generated image.

      $request_time = \Drupal::time()
      ->getRequestTime();
      
      $qrName = 'myQrcode'.$request_time;

      $uri = $directory . $qrName. '.png'; // Generates a png image.
    
      $path =  \Drupal::service('file_system')->realpath($uri);
    
      // Generate QR code image.
      \PHPQRCode\QRcode::png($product_link_array, $path, 'H', 10, 2);
  
      $relative_file_url =  \Drupal::service('file_url_generator')
      ->generateAbsoluteString($uri); 
    
      $qr_image = "<div style='style='border-style: solid;'><p>Tap purchase this Product on your app to avail exclusive app only</p><img src='{$relative_file_url}'/></div>";
       
      $build = [
        '#markup' => $qr_image,
        '#cache' => ['tags' => $node->getCacheTags()],
      ];
    }

    $build['#cache']['contexts'] = ['route'];
    return $build;
    
  }

}