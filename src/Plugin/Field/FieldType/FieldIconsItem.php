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
 *     label = @Translation("Icons Field"),
 *     description = "a filed to icons to content type",
 *     category = @Translation("Icons"),
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
                    'length' => '50',
                    'not null' => FALSE,
                ],

                'icon_color' => [
                    'type' => 'varchar',
                    'length' => '20',
                    'not null' => TRUE,
                ],

                'icon_size' => [
                    'type' => 'varchar',
                    'length' => '5',
                    'not null' => TRUE,
                ],
            ],

            'indexes' => [
                'icon_select' => 'icon_select',
                'icon_color' => 'icon_color',
                'icon_size' => 'icon_size',
            ],
        ];

    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties = [];
        
        $properties['icon_select'] = DataDefinition::create('string')
            ->setlabel(t('Icons Field'));

        $properties['icon_color'] = DataDefinition::create('string')
            ->setlabel(t('Icons Color'));

        $properties['icon_size'] = DataDefinition::create('string')
            ->setlabel(t('Icons Size'));

        return $properties;
    }

}
