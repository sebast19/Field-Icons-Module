<?php

namespace Drupal\field_icons\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the "field_icons" field type.
 *
 * @FieldType(
 *     id = "field_icons_item",
 *     label = @Translation("Icons"),
 *     description = "a filed to icons to content type",
 *     default_widget = "icons_widget_default",
 *     default_formatter = "icons_formatter_default"
 * )
 */

class FieldIconsItem extends FieldItemBase {

    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {

        return [
            'columns' => [
                'icon_select' => [
                    'type' => 'varchar',
                    'length' => '255',
                    'not null' => FALSE,
                ],
            ],
            'indexes' => [],
        ];

    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties = [];
        $properties['icon_select'] = DataDefinition::create('string')
          ->setlabel(t('Icon'));

        return $properties;
    }

}
