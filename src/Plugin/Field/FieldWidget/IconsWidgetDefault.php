<?php

namespace Drupal\field_icons\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;


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

        // Obtains the name typed in the content type add_icon
        $icons_content_type = \Drupal::service('database')->query('SELECT field_icon_label_value FROM node__field_icon_label');
        
        // One default value in the select element.
        $icons = [
            'icon-accion' => 'Accion',
        ];  

        while ($icon_name = $icons_content_type->fetchAssoc()) {

            $label_icon = strtolower($icon_name['field_icon_label_value']);

            // Validation is in array the value obtained from the query.
            if (in_array($label_icon, $icons)) {
                continue;
            } else {

                // Add icon to the list.
                $icons += [
                    'icon-' . $label_icon => ucfirst($label_icon),
                ];

            }
        }

        return $icons;

    }
}
