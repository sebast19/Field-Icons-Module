<?php

namespace Drupal\field_icons\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'icons_formatter_default' formatter.
 *
 * @FieldFormatter(
 *    id = "icons_formatter_default",               
 *    label = @Translation("Default Icons Size 30px"),
 *    field_types = {
 *      "field_icons_item"
 *    }
 * )
 */
class IconsFormatterDefault extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        foreach ($items as $delta => $item) {

          if (!empty($item->icon_select)) {

            $elements[$delta] = [
              '#theme' => 'icons_template',
              '#class_icon' => $item->icon_select, 
            ];

            return $elements;
          }

          $elements[$delta] = [
            '#type' => 'markup',
            '#markup' => 'None icon selected',
          ];

          return $elements;
            
        }

    }

}
