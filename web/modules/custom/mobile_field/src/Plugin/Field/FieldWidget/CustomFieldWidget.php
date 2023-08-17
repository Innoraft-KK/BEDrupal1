<?php

namespace Drupal\mobile_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'custom_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "custom_field_widget",
 *   label = @Translation("Custom Field Widget"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */
class CustomFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Number'),
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : '+91 ',
      '#size' => 20,
      '#maxlength' => 15,
      '#element_validate' => [[$this, 'validateValue']],
    ];

    return $element;
  }

  /**
   * Element validation handler for the 'value' element.
   */
  public function validateValue(array $element, FormStateInterface $form_state) {
    $value = $element['#value'];

    // Remove spaces and "+91" prefix for validation.
    $cleaned_value = preg_replace('/\s+/', '', $value);
    $cleaned_value = preg_replace('/^\+91/', '', $cleaned_value);

    // Validate the length and format of the mobile number.
    if (strlen($cleaned_value) !== 10 || !ctype_digit($cleaned_value)) {
      $form_state->setError($element, $this->t('Invalid Indian mobile number.'));
    }
  }
}
