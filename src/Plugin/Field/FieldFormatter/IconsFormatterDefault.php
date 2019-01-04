<?php

namespace Drupal\field_icons\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'icons_formatter_default' formatter.
 *
 * @FieldFormatter(
 *    id = "icons_formatter_default",               
 *    label = @Translation("Default"),
 *    field_types = {
 *      "field_icons_item"
 *    }
 * )
 */
class IconsFormatterDefault extends FormatterBase {

    /**
     * Builds a renderable array for a field value.
     * 
     * @param \Drupal\Core\Field\FieldItemListInterface $items The field values to be rendered.
     * 
     * @param string $langcode The language that should be used to render the field.
     * 
     * @return array A renderable array for $items, as an array of child elements keyed by consecutive numeric indexes starting from 0.
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
      
      $elements = [];

      foreach ($items as $delta => $item) {

        if (!empty($item->icon_select)) {

          $elements[$delta] = [
            '#theme' => 'icons_template',
            '#class_icon' => $item->icon_select,
            '#name_icon' => ucfirst(str_replace('icon-', '', $item->icon_select)),
            '#color_icon' => $item->icon_color,
            '#size_icon' => $this->getSetting('size_icon'),
          ];

        } else {

          $elements[$delta] = [
            '#theme' => 'icons_template',
            '#class_icon' => 'uncategorized',
          ];

        }

        return $elements;
          
      }

    }

    /**
     * Defines the default settings for this plugin.
     * 
     * @return array A list of default settings, keyed by the setting name.
     * 
     */
    public static function defaultSettings() {
      
      return [
        'size_icon' => 20,
      ] + parent::defaultSettings();

    }

    /**
     * Returns a form to configure settings for the formatter.
     * 
     * Invoked from \Drupal\field_ui\Form\EntityDisplayFormBase to allow administrators to configure the formatter.
     * The field_ui module takes care of handling submitted form values.
     * 
     * @param array $form The form where the settings form is being included in.
     * 
     * @param \Drupal\Core\Form\FormStateInterface $form_state The current state of the form.
     * 
     * @return array The form elements for the formatter settings.
     * 
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {

      $element['size_icon'] = [
        '#type' => 'number',
        '#title' => $this->t('Size of the icon'),
        '#default_value' => $this->getSetting('size_icon'),
        '#required' => TRUE,
        '#min' => 15,
      ];

      return $element;
    }

}
