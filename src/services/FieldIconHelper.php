<?php

namespace Drupal\field_icons\services;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManager;

class FieldIconHelper {

  /**
	 * @var Drupal\Core\Database\Connection $connection
	 */

  protected $connection;
    
	/**
	 * @var Drupal\Core\Entity\EntityTypeManager $entity_type
	 */

  protected $entity_type;
  
  /**
	 * Class Construct
	 *
	 * @param Drupal\Core\Database\Connection $connection
	 *  The Database Connection
   * 
	 * @param Drupal\Core\Entity\EntityTypeManager $entity_type
	 *  The Entity Type Manager
	 */
	public function __construct(Connection $connection , EntityTypeManager $entity_type) {

		$this->connection = $connection;
		$this->entity_type = $entity_type;

  }

  /**
   * Collect data from database to add new icons
   * 
   * @return object $entities
   *  Entities loaded by entity type manager
   */
  private function getData() {

    // Obtains the name typed in the content type add_icon
    $icons_content_type = $this->connection->query('SELECT field_icon_label_target_id FROM node__field_icon_label')->fetchAll();

    // Load the entities taxonomy term

    if (count($icons_content_type) > 0) {
        
      foreach ($icons_content_type as $id_taxonomy) {

          $tids[] = $id_taxonomy->field_icon_label_target_id;

      }

      $entities = $this->entity_type
        ->getStorage('taxonomy_term')
        ->loadMultiple($tids);

        return $entities;
    }

  }

  /**
   * Load the options(List of values) of the Select Element.
   *
   * @return array $icons_data
   *  array with the options to show in the select Element and the twig template.          
   */
  public function getIcons() {

    $icons_data = [];

    // Set one default value in the select element.

    $icons_data = ['icon-accion' => 'Accion'];
    
    if ($this->getData()) {

        foreach ($this->getData() as $entity) {

            if (in_array($entity->getName(), $icons_data)) {
                continue;
            } else {
    
                // Add icon to the list.
                $icons_data += [
                    'icon-' . strtolower($entity->getName()) => ucfirst($entity->getName()),
                ];
    
            }
        }

    }         
       
    return $icons_data;

  }
  
}