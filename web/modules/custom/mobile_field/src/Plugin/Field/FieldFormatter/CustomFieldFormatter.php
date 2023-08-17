<?php

namespace Drupal\mobile_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'custom_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "custom_field_formatter",
 *   label = @Translation("Formatted Indian Mobile Number"),
 *   field_types = {
 *     "custom_field_type"
 *   }
 * )
 */
class CustomFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      // Get the mobile number.
      $mobile_number = $item->value;

      // Format the mobile number with "+91" prefix.
      $formatted_mobile_number = '+91 ' . $mobile_number;

      $elements[$delta] = [
        '#markup' => $formatted_mobile_number,
      ];
    }

    return $elements;
  }
}
