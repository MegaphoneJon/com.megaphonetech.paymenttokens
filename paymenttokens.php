<?php

require_once 'paymenttokens.civix.php';
use CRM_Paymenttokens_ExtensionUtil as E;


function paymenttokens_civicrm_tokens(&$tokens) {
  $tokens['lastpayment'] = [
    'lastpayment.receive_date' => E::ts('Last Payment: Receive Date'),
    'lastpayment.total_amount' => E::ts('Last Payment: Amount'),
  ];
}

function paymenttokens_civicrm_tokenValues(&$values, $cids, $job = NULL, $tokens = [], $context = NULL) {
  if (!isset($tokens['lastpayment'])) {
    return;
  }
  foreach ($cids as $cid) {
    $contributions = civicrm_api3('Contribution', 'get', [
      'sequential' => 1,
      'contact_id' => $cid,
      'options' => ['sort' => "receive_date DESC"],
    ]);
    if ($contributions['count']) {
    $lastContribution = $contributions['values'][0];
    }
    $payments = CRM_Contribute_BAO_Contribution::getPaymentInfo($lastContribution['id'], 'contribution', TRUE, TRUE);
    $lastPayment = end($payments['transaction']);
    $values[$cid]['lastpayment.receive_date'] = CRM_Utils_Date::customFormat($lastPayment['receive_date'], NULL, ['j', 'm', 'Y']);
    $values[$cid]['lastpayment.total_amount'] = $lastPayment['total_amount'];
    $temp = 1;
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function paymenttokens_civicrm_config(&$config) {
  _paymenttokens_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function paymenttokens_civicrm_xmlMenu(&$files) {
  _paymenttokens_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function paymenttokens_civicrm_install() {
  _paymenttokens_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function paymenttokens_civicrm_postInstall() {
  _paymenttokens_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function paymenttokens_civicrm_uninstall() {
  _paymenttokens_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function paymenttokens_civicrm_enable() {
  _paymenttokens_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function paymenttokens_civicrm_disable() {
  _paymenttokens_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function paymenttokens_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _paymenttokens_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function paymenttokens_civicrm_managed(&$entities) {
  _paymenttokens_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function paymenttokens_civicrm_caseTypes(&$caseTypes) {
  _paymenttokens_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function paymenttokens_civicrm_angularModules(&$angularModules) {
  _paymenttokens_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function paymenttokens_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _paymenttokens_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function paymenttokens_civicrm_entityTypes(&$entityTypes) {
  _paymenttokens_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function paymenttokens_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function paymenttokens_civicrm_navigationMenu(&$menu) {
  _paymenttokens_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _paymenttokens_civix_navigationMenu($menu);
} // */
