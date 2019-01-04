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
 *   label = @Translation("Select List"),
 *   field_types = {
 *      "field_icons_item"
 *   }
 * )
 */
class IconsWidgetDefault extends WidgetBase {

    /**
     * Returns the form for a single field widget.
     * 
     * The BaseWidget methods will set the weight, field name and delta values for each form element,
     * If there are multiple values for this field, the formElement() method will be called as many times as needed.
     * 
     * @param \Drupal\Core\Field\FieldItemListInterface $items 
     *  Array of default values for this field
     * @param int $delta
     *  The order of this item in the array of sub-elements (0, 1, 2, etc.).
     * @param array $element
     *  A form element array containing basic properties for the widget
     * @param array $form
     *  The form structure where widgets are being attached to. This might be a full form structure, or a sub-element of a larger form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *  The current state of the form.
     * @return array 
     *  The form elements for a single widget for this field
     */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state){

        $field_helper = \Drupal::service('field_icons.helper');

        $element['icon_select'] = [
            '#type' => 'select',
            '#description' => $this->t('Add new content type of <strong><em>New Icon</em></strong> for add more icons to the list.'),
            '#empty_option' => $this->t('-None-'),
            '#default_value' => isset($items[$delta]->icon_select) ? $items[$delta]->icon_select: '',
            '#options' => $field_helper->getIcons(),
            '#title' => $this->t('Icon Category'),
        ];

        $element['icon_color'] = [
            '#type' => 'select',
            '#description' => $this->t('Select the color for the icon, if you leave it as default it will take the black color.'),
            '#empty_option' => $this->t('-Default-'),
            '#default_value' => isset($items[$delta]->icon_color) ? $items[$delta]->icon_color: '',
            '#options' => $field_helper->getColors(),
            '#title' => $this->t('Icon Color'),
        ];
        
        return $element;
    }

}
