<?php
/**
 * @file
 * Contains \Drupal\vendor_onboarding\Form\VendorRegistration.
 */
namespace Drupal\vendor_onboarding\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\Query\QueryFactory;

class VendorRegistration extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'vendor_onboarding_form';
  }
  
 //$buCodeArr=getBUCode();
	//print_r($buCodeArr);
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $buCode=array();
	 $bundle = 'business_unit';
	$query = \Drupal::entityQuery('vendor_management');
	//$query->condition('status', 1);
	$query->condition('type', $bundle);
	//$query->condition('field_name.value', 'default', '=');
	$entity_ids = $query->execute();
	//$nodes = \Drupal\node\Entity\Node::loadMultiple(array $entity_ids = NULL);
	  $wrapper = \Drupal::entityTypeManager()->getStorage('vendor_management')->loadMultiple($entity_ids);
	

	foreach ($wrapper as $key => $value) {	
		$nodes=$value->toArray();
		
		$buCode[$nodes['field_business_unit_code'][0]['value']]= $nodes['field_business_unit_code'][0]['value'];	
		
	}
	
	$id= "eck_entity_type";
	$form['vendor_bucode'] = array (
      '#description' => t('Please ctrl+select to choose more than one option.'),
	   '#default_value' => '--Select--',
	  '#type' => 'select',
	  '#multiple'    => TRUE,
      '#title' => t('Select BU Code:'),
      '#options' => $buCode,
	  '#required' => TRUE,
      
    );
	$form['vendor_email'] = array(
      '#type' => 'email',
      '#title' => t('Enter Email ID:'),
      '#required' => TRUE,
    );    
    
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Send Invitation'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $email = $form_state->getValue('vendor_email');
	$ids = \Drupal::entityQuery('user')
    ->condition('mail', $email)
    ->execute();

  
    //$accept = $form_state->getValue('accept');

    if (!empty($ids)) {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('vendor_email', $this->t('This email address already exist.'));
    }

   /* if (empty($accept)){
      // Set an error for the form element with a key of "accept".
      $form_state->setErrorByName('accept', $this->t('You must accept the terms of use to continue'));
    }*/

  }
    
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage(t("Vendor Registration Done!! Registered Values are:"));
	foreach ($form_state->getValues() as $key => $value) {
		
	  \Drupal::messenger()->addMessage($key . ': ' . $value);
    }
	
	 $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $user = \Drupal\user\Entity\User::create();
	$values = $form_state->getValues();
	
	$userEmail=$values['vendor_email'];
	
	
	$uEmail=@explode('@',$userEmail);
  // Required.
    $user->setPassword('admin@123');
    $user->enforceIsNew();
    $user->setEmail($userEmail);
    $user->setUsername($uEmail[0]);
	if(!empty($values['vendor_bucode'])){
		$buValString='';
		foreach($values['vendor_bucode'] as $buVal){
			$buValString .= $buVal.',';
		}
	}
	$user->set('field_business_unit_code', substr($buValString,0,-1));
  // not required.
    // $user->set('init', 'email');
    // $user->set('langcode', $language);
    // $user->set('preferred_langcode', $language);
    // $user->set('preferred_admin_langcode', $language);
     $user->addRole('vendor');
    // status blocked
    // $user->block();
    // status active
    $user->activate();
  
    // Save user account.
    $user->save();
 //user_pass_reset_url($user); 
    //Send notification
    _user_mail_notify('register_no_approval_required', $user);	
 

    \Drupal::messenger()->addMessage(t('A welcome message with further instructions has been emailed to the new user '.$username), 'status');
	
	
  }
  
	public function getBUCode(){
	 $bundle = 'business_unit';
	$query = \Drupal::entityQuery('vendor_management');
	//$query->condition('status', 1);
	$query->condition('type', $bundle);
	//$query->condition('field_name.value', 'default', '=');
	$entity_ids = $query->execute();
	//$nodes = \Drupal\node\Entity\Node::loadMultiple(array $entity_ids = NULL);
	  $wrapper = \Drupal::entityTypeManager()->getStorage('vendor_management')->loadMultiple($entity_ids);
	//$entity_data = $wrapper->value();
	//$final_data = get_object_vars($entity_data);
	//kint($wrapper);
	//$node = reset($wrapper);

	//print_r($node->field_business_unit_code());
	foreach ($wrapper as $key => $value) {	
		$nodes=$value->toArray();
		
		$buCode[]= $nodes['field_business_unit_code'][0]['value'];	
		
	}
	 return $buCode;
 }
}