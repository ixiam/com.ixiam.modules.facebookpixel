<?php

require_once 'facebookpixel.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function facebookpixel_civicrm_config(&$config) {
  _facebookpixel_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function facebookpixel_civicrm_xmlMenu(&$files) {
  _facebookpixel_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function facebookpixel_civicrm_install() {
  _facebookpixel_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function facebookpixel_civicrm_uninstall() {
  _facebookpixel_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function facebookpixel_civicrm_enable() {
  _facebookpixel_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function facebookpixel_civicrm_disable() {
  _facebookpixel_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function facebookpixel_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _facebookpixel_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function facebookpixel_civicrm_managed(&$entities) {
  _facebookpixel_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function facebookpixel_civicrm_caseTypes(&$caseTypes) {
  _facebookpixel_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function facebookpixel_civicrm_angularModules(&$angularModules) {
_facebookpixel_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function facebookpixel_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _facebookpixel_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *
*/


function facebookpixel_civicrm_buildForm($formName, &$form)   {    
  
  
  if ($formName == 'CRM_Contribute_Form_ContributionPage_Settings') {    
    
    $pixel_value = CRM_Core_BAO_Setting::getItem("com.ixiam.modules.facebookpixel", $form->getVar("_id"));    
    if(!(isset($pixel_value) && $pixel_value > 0 )) {
      $pixel_value = "";
    }
    $form->add('text', 'id_facebook_pixel', ts('Facebook Pixel'));
    CRM_Core_Region::instance('form-bottom')->add(array(
      'jquery' => "
      cj(function() {        
        $('.crm-contribution-contributionpage-settings-form-block-is_confirm_enabled').append('<div id=\"id_facebook_pixel\"><label>"  . ts('Pixel identificator:', array( 'domain' => 'com.ixiam.modules.facebookpixel'))  ."</label><input maxlength=\"255\" size=\"45\" name=\"facebook_pixel\" type=\"text\" value=\"". $pixel_value . "\"  ></div>');                         
      });",
    ));
      
        
  }
  
  
  if($formName == "CRM_Contribute_Form_Contribution_Main" && isset($form->_mode) && $form->_mode == "live" ) {
    $pixel_value = CRM_Core_BAO_Setting::getItem("com.ixiam.modules.facebookpixel", $form->getVar("_id"));    
    if( isset($pixel_value) && $pixel_value > 0 ) {
      $contribution_page_id = $form->getVar("_id");
      CRM_Core_Region::instance('form-bottom')->add(array(
        'script' => "                    
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','//connect.facebook.net/en_US/fbevents.js');
        // Insert Your Custom Audience Pixel ID below. 
        fbq('init', '$pixel_value');
        fbq('track', 'PageView');             
          ",
      ));
    }
  }
  
  if($formName == 'CRM_Contribute_Form_Contribution_ThankYou'  && isset($form->_mode) && $form->_mode == "live" ) {      
    
    $pixel_value = CRM_Core_BAO_Setting::getItem("com.ixiam.modules.facebookpixel", $form->getVar("_id"));
    if(isset($pixel_value) && $pixel_value > 0 ) {
    
      $currency = $form->_values["currency"];
      $contribution_page_id = $form->getVar("_id");
      $amount = $form->_amount;
      CRM_Core_Region::instance('form-bottom')->add(array(
        'script' => "              
          !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
          n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
          document,'script','//connect.facebook.net/en_US/fbevents.js');
          
          // Insert Your Facebook Pixel ID below. 
          fbq('init', '$pixel_value');
          fbq('track', 'CompleteRegistration', {
            content_name: 'Thank you CiviCRM',
            content_category: 'donation',
            content_ids: ['$contribution_page_id'],
            content_type: 'donation',
            value: $amount,
            currency: '$currency',           
            userAgent: navigator.userAgent,
            language: navigator.language
           });        
          ",
      ));
    }
  }  
}


/**
 * Implements hook_civicrm_postProcess().
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function facebookpixel_civicrm_postProcess($formName, &$form) {  
  if($formName == "CRM_Contribute_Form_ContributionPage_Settings") {    
    CRM_Core_BAO_Setting::setItem( $form->_submitValues["facebook_pixel"], "com.ixiam.modules.facebookpixel", $form->getVar("_id"));    
  }
}


function facebookpixel_civicrm_pageRun(&$page) {
  // CRM_Core_Error::debug($page);  
  // die;
}
