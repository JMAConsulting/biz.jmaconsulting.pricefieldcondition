<?php

require_once 'pricefieldcondition.civix.php';
use CRM_Pricefieldcondition_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function pricefieldcondition_civicrm_config(&$config) {
  _pricefieldcondition_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function pricefieldcondition_civicrm_xmlMenu(&$files) {
  _pricefieldcondition_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function pricefieldcondition_civicrm_install() {
  _pricefieldcondition_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function pricefieldcondition_civicrm_postInstall() {
  _pricefieldcondition_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function pricefieldcondition_civicrm_uninstall() {
  _pricefieldcondition_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function pricefieldcondition_civicrm_enable() {
  _pricefieldcondition_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function pricefieldcondition_civicrm_disable() {
  _pricefieldcondition_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function pricefieldcondition_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _pricefieldcondition_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function pricefieldcondition_civicrm_managed(&$entities) {
  _pricefieldcondition_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function pricefieldcondition_civicrm_caseTypes(&$caseTypes) {
  _pricefieldcondition_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function pricefieldcondition_civicrm_angularModules(&$angularModules) {
  _pricefieldcondition_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function pricefieldcondition_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _pricefieldcondition_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function pricefieldcondition_civicrm_entityTypes(&$entityTypes) {
  _pricefieldcondition_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function pricefieldcondition_civicrm_themes(&$themes) {
  _pricefieldcondition_civix_civicrm_themes($themes);
}

function pricefieldcondition_civicrm_buildForm($formName, &$form) {
  $templatePath = realpath(dirname(__FILE__)."/templates");
  if ($formName === 'CRM_Price_Form_Field') {
    $fieldId = $form->get('fid');
    $fieldCount = 1;
    $defaults = [];
    if ($fieldId) {
      $currentConditions = civicrm_api3('PriceFieldCondition', 'get', ['entity_id' => $fieldId, 'entity_table' => 'civicrm_price_field']);
      if (!empty($currentConditions['values'])) {
        foreach ($currentConditions['values'] as $currentCondition) {
          $defaults['condition_field_' . $fieldCount] = substr($currentCondition['condition_entity_table'], 8) . '_' . $currentCondition['condition_entity_id'];
          $fieldCount++;
        }
      }
    }
    $priceSetId = $form->get('sid');
    $priceFieldsWithOptions = civicrm_api3('PriceField', 'get', [
      'price_set_id' => $priceSetId,
      'api.PriceFieldValue.get' => ['price_field_id' => "\$value.id"],
    ]);
    $selectOptions = [];
    if ($priceFieldsWithOptions['count']) {
      $selectOptions[0] = E::ts('-- Select -- ');
      foreach ($priceFieldsWithOptions['values'] as $priceField)  {
        if ($priceField['api.PriceFieldValue.get']['count']) {
          foreach ($priceField['api.PriceFieldValue.get']['values'] as $priceFieldOption) {
            $selectOptions['price_field_value_'. $priceFieldOption['id']] = $priceFieldOption['label'] . ' (Price Field Value)';
          }
        }
      }
    }
    if (!empty($selectOptions)) {
      $ids = [1, 2];
      foreach ($ids as $id) {
        $form->add('Select', 'condition_field_' . $id, E::ts('Conditional Field'), $selectOptions);
      }
      if (!empty($defaults)) {
        drupal_set_message(json_encode($defaults));
        $form->setDefaults($defaults);
      }
      CRM_Core_Region::instance('form-body')->add([
        'template' => "{$templatePath}/CRM/Price/Form/conditionField.tpl"
      ]);
    }
  }
  if ($formName === 'CRM_Event_Form_Registration_Register' || $formName === 'CRM_Event_Form_Registration_AdditionalParticipant') {
    $affectedFields = $ifClauses = [];
    foreach ($form->_priceSet['fields'] as $fieldId => $details) {
      $condition = civicrm_api3('PriceFieldCondition', 'get', ['squential' => 1, 'entity_id' => $fieldId, 'entity_table' => 'civicrm_price_field']);
      if (!empty($condition['values'])) {
        if ($condition['count'] === 1) {
          if ($condition['values'][$condition['id']]['condition_entity_table'] === 'civicrm_price_field_value') {
            $parentField = civicrm_api3('PriceFieldValue', 'getsingle', ['id' => $condition['values'][$condition['id']]['condition_entity_id']])['price_field_id'];
            CRM_Core_Resources::singleton()->addScript(
              "CRM.$(function($) {
                $(\"input[name='price_" . $parentField . "']\").change(function() {
                 if (\$(this).val() == " . $condition['values'][$condition['id']]['condition_entity_id'] . ") {
                   $(\"#price_" . $fieldId . "\").parent().parent().show();
                 }
                 else {
                   $(\"#price_" . $fieldId . "\").parent().parent().hide();
                 }
                });
                $(\"#price_" . $fieldId . "\").parent().parent().hide();
              });");
          }
        }
        else {
          foreach ($condition['values'] as $con) {
            $parentField = civicrm_api3('PriceFieldValue', 'getsingle', ['id' => $con['condition_entity_id']])['price_field_id'];
            if (array_search($parentField, $affectedFields) === FALSE) {
              $affectedFields[] = $parentField;
            }
            $ifClause[$parentField][] = "\$(this).val() == " . $con['condition_entity_id'];
          }
          if (count($affectedFields) == 1) {
            $parentField = $affectedFields[0];
            CRM_Core_Resources::singleton()->addScript(
              "CRM.$(function($) {
              $(\"input[name='price_" . $parentField . "']\").change(function() {
              if (" . implode(' || ', $ifClause[$parentField]) . ") {
                   $(\"#price_" . $fieldId . "\").parent().parent().show();
                 }
                 else {
                   $(\"#price_" . $fieldId . "\").parent().parent().hide();
                 }
                });
                $(\"#price_" . $fieldId . "\").parent().parent().hide();
              });");
          }
          else {
            // @todo handle multiple separate price fields for which options are selected.
          }
        }
      }
    }
  }
}

function pricefieldcondition_civicrm_postProcess($formName, &$form) {
  if ($formName === 'CRM_Price_Form_Field') {
    $params = $form->controller->exportValues('Field');
    $fieldId = $form->getVar('_fid');
    if (empty($fieldId)) {
      $field = civicrm_api3('PriceField', 'getsingle', [
        'price_set_id' => $params['sid'],
        'label' => $params['label'],
      ]);
      $fieldId = $field['id'];
    }
    $ids = [1, 2];
    foreach ($ids as $id) {
      $conditionField = 'condition_field_' . $id;
      if (!empty($params[$conditionField])) {
        if (substr($params[$conditionField], 0, 18) === 'price_field_value_') {
          $condition_entity_id = substr($params[$conditionField], 18);
          $condition_entity_table = 'civicrm_price_field_value';
        }
        $apiParams = [
          'entity_id' => $fieldId,
          'entity_table' => 'civicrm_price_field',
          'condition_entity_id' => $condition_entity_id,
          'condition_entity_table' => $condition_entity_table,
        ];
        try {
          $currentCondition = civicrm_api3('PriceFieldCondition', 'getsingle', $apiParams);
          $apiParams['id'] = $currentCondition['id'];
        }
        catch (Exception $e) {
        }
        civicrm_api3('PriceFieldCondition', 'create', $apiParams);
      }
    }
  }
}
