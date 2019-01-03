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

        $field_helper = \Drupal::service('field_icons.helper');

        $default_value = isset($items[$delta]->icon_select) ? $items[$delta]->icon_select: ''; 

        $element['icon_select'] = [
            '#type' => 'select',
            '#description' => $this->t('Add new content type of <strong><em>New Icon</em></strong> for add more icons to the list.'),
            '#empty_option' => $this->t('-None-'),
            '#default_value' => $default_value,
            '#options' => $field_helper->getIcons(),
            '#title' => $this->t('Icon Category'),
        ];

        $element['icon_color'] = [
            '#type' => 'select',
            '#description' => $this->t('Select the color for the icon, if you leave it as default it will take the black color.'),
            '#empty_option' => $this->t('-Default-'),
            '#default_value' => isset($items[$delta]->icon_color) ? $items[$delta]->icon_color: '',
            '#options' => [
                'red' => 'Red',
                'green' => 'Green',
            ],
            '#title' => $this->t('Icon Color'),
        ];

        $element['icon_size'] = [
            '#type' => 'number',
            '#description' => $this->t('Indicates the size of the icon, the <em>minimum 15 and the maximum 99</em>'),
            '#default_value' => isset($items[$delta]->icon_size) ? $items[$delta]->icon_size: '20',
            '#min' => 15,
            '#max' => 50,
            '#title' => $this->t('Icon Size'),
        ];
        
        return $element;
    }

}
