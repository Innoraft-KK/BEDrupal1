<?php

namespace Drupal\mobile_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'custom_field_type' field type.
 *
 * @FieldType(
 *   id = "custom_field_type",
 *   label = @Translation("Custom Field Type"),
 *   description = @Translation("Stores Indian mobile numbers."),
 *   default_widget = "custom_field_widget",
 *   default_formatter = "custom_field_formatter"
 * )
 */
class CustomFieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];

    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Mobile Number'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $columns = [
      'value' => [
        'type' => 'varchar',
        'length' => 15,
        'not null' => FALSE,
      ],
    ];

    return [
      'columns' => $columns,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }
}
