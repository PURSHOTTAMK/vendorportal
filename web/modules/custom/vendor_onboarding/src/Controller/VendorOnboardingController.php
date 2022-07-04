<?php
namespace Drupal\vendor_onboarding\Controller;
class VendorOnboardingController {
  public function register_vendor_via_email() {
    $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $user = \Drupal\user\Entity\User::create();
  
  // Required.
    $user->setPassword('admin@123');
    $user->enforceIsNew();
    $user->setEmail('puru@gmail.com');
    $user->setUsername('puru');
  
  // not required.
    // $user->set('init', 'email');
    // $user->set('langcode', $language);
    // $user->set('preferred_langcode', $language);
    // $user->set('preferred_admin_langcode', $language);
    // $user->addRole('administrator');
    // status blocked
    // $user->block();
    // status active
  //  $user->activate();
  
    // Save user account.
    $user->save();

    //Send notification
    _user_mail_notify('register_no_approval_required', $user);
    \Drupal::messenger()->addMessage(t('A welcome message with further instructions has been emailed to the new user '.$username), 'status');


    return array(
        '#markup' => 'User created.'
      );
  }
}