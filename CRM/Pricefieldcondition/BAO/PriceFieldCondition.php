<?php
use CRM_Pricefieldcondition_ExtensionUtil as E;

class CRM_Pricefieldcondition_BAO_PriceFieldCondition extends CRM_Pricefieldcondition_DAO_PriceFieldCondition {

  /**
   * Create a new PriceFieldCondition based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Pricefieldcondition_DAO_PriceFieldCondition|NULL
   *
  public static function create($params) {
    $className = 'CRM_Pricefieldcondition_DAO_PriceFieldCondition';
    $entityName = 'PriceFieldCondition';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
