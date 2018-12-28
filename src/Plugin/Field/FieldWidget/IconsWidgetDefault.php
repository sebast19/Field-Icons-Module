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

        $field_helper = \Drupal::service('field_icons.helper')->getIcons();

        $value = isset($items[$delta]->icon_select) ? $items[$delta]->icon_select: ''; 

        $element['icon_select'] = [
            '#type' => 'select',
            '#description' => 'Add new content type of <strong><em>Add New Icon</em></strong> for add more icons to the list',
            '#empty_option' => t('-None-'),
            '#default_value' => $value,
            '#options' => $field_helper,
            '#title' => t('Icon Category'),
        ];
        
        return $element;
    }

}
