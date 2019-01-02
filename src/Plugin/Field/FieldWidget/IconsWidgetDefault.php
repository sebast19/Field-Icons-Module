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
 *   label = @Translation("Default Select List"),
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

        $default_value = isset($items[$delta]->icon_select) ? $items[$delta]->icon_select: ''; 

        $element['icon_select'] = [
            '#type' => 'select',
            '#description' => 'Add new content type of <strong><em>Add New Icon</em></strong> for add more icons to the list',
            '#empty_option' => t('-None-'),
            '#default_value' => $default_value,
            '#options' => $field_helper,
            '#title' => t('Icon Category'),
        ];

        $element['icon_color'] = [
            '#type' => 'number',
            '#min' => 15,
            '#max' => 99,
            '#title' => 'Icon Color',
        ];

        $element['icon_size'] = [
            '#type' => 'number',
            '#min' => 15,
            '#max' => 99,
            '#title' => 'Icon Size',
        ];
        
        return $element;
    }

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {

        return [
            'size' => 60,
        ] + parent::defaultSettings();

    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {

        $element['size'] = [
            '#type' => 'number',
            '#title' => t('Size of textfield'),
            '#default_value' => $this->getSetting('size'),
            '#required' => TRUE,
            '#min' => 1,
          ];
        
          return $element;

    }

}
