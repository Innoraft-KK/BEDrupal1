<?php 
namespace Drupal\student_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Exception;

class StudentDashboardController extends ControllerBase {

  public function dashboard() {
    try {
      $db = \Drupal::database();

      // Fetching data related to user entity fields.
      $query = $db->select('user__field_joining_year', 'u');
      $query->addField('u', 'entity_id', 'user_id');
      $query->addField('u', 'field_joining_year_value', 'joining_date');
      // Add more fields if needed.
      $query->condition('u.bundle', 'user');
      // Add more conditions if needed.
      $user_data = $query->execute()->fetchAll();

      // Fetching data related to the 'Passing Year' field.
      $passing_year_query = $db->select('user__field_passing_year', 'p');
      $passing_year_query->addField('p', 'entity_id', 'user_id');
      $passing_year_query->addField('p', 'field_passing_year_value', 'passing_year');
      // Add more fields if needed.
      $passing_year_query->condition('p.bundle', 'user');
      // Add more conditions if needed.
      $passing_year_data = $passing_year_query->execute()->fetchAll();

      // Fetching display name data from the users_field_data table.
      $display_name_query = $db->select('users_field_data', 'ufd');
      $display_name_query->addField('ufd', 'uid', 'user_id');
      $display_name_query->addField('ufd', 'name', 'display_name');
      // Add more fields if needed.
      $display_name_data = $display_name_query->execute()->fetchAll();

      // Fetching data from user__roles table where roles_target_id is 'students'.
      $user_roles_query = $db->select('user__roles', 'ur');
      $user_roles_query->addField('ur', 'entity_id', 'user_id');
      $user_roles_query->condition('ur.roles_target_id', 'students');
      $user_roles_data = $user_roles_query->execute()->fetchAll();
      //var_dump($user_roles_data);
      return [  
        '#theme' => 'student_dashboard',
        '#user_data' => $user_data,
        '#passing_year_data' => $passing_year_data,
        '#display_name_data' => $display_name_data,
        '#user_roles_data' => $user_roles_data,
      ];
    } catch (Exception $e) {
      // Handle exceptions.
      return [
        '#markup' => 'Error: ' . $e->getMessage(),
      ];
    }
  }

}
