<?php

namespace Drupal\field_icons\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * PLugin implementation of the 'icons_widget_default'.
 *
 * @FieldWidget(
 *   id = "icons_widget_default",
 *   module = "field_icons",
 *   label = @Translation("Select one option"),
 *   field_types = {
 *      "field_icons_item"
 *   }
 * )
 */
class IconsWidgetDefault extends WidgetBase {

    /**
     * {@inheritdoc}
     */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state){

        $value = isset($items[$delta]->icon_select) ? $items[$delta]->icon_select: ''; 

        $element['icon_select'] = [
            '#type' => 'select',
            '#description' => 'Add new content type of <strong><em>Add New Icon</em></strong> for add more icons to the list',
            '#empty_option' => t('-None-'),
            '#default_value' => $value,
            '#options' => $this->getIcons(),
            '#title' => t('Icons'),
        ];

        return $element;
    }


    /**
     * Function to load the options(List of values) of the Select Element.
     *
     *@return array $icons
     *  array with the options to show in the select Element.          
     */
    private function getIcons() {

        // Set one default value in the select element.

        $icons = [
            'icon-accion' => 'Accion',
        ];     

        // Obtains the name typed in the content type add_icon
        $icons_content_type = \Drupal::service('database')->query('SELECT field_icon_label_target_id FROM node__field_icon_label')->fetchAll();

        // Load the entities taxonomy term

        if (count($icons_content_type) > 0) {
            
            foreach ($icons_content_type as $id_taxonomy) {

                $tids[] = $id_taxonomy->field_icon_label_target_id;
    
            }

            $entities = \Drupal::entityTypeManager()
					->getStorage('taxonomy_term')
                    ->loadMultiple($tids);

            foreach ($entities as $entity) {

                if (in_array($entity->getName(), $icons)) {
                    continue;
                } else {
    
                    // Add icon to the list.
                    $icons += [
                        'icon-' . strtolower($entity->getName()) => ucfirst($entity->getName()),
                    ];
    
                }
            }         

        }          
 
        return $icons;

    }
}
