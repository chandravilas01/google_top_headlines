<?php  
/**  
 * @file  
 * Contains Drupal\google_top_headlines\Form\GoogleSettingForm.  
 */  
namespace Drupal\google_top_headlines\Form; 

use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;

/**
 * config form for google credentials.
 *
 * @internal
 */
class GoogleSettingForm extends ConfigFormBase {  
  
  /** @var string Config settings */
  const SETTINGS = 'google_top_headlines.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'google_top_headlines_admin_settings';
  }  

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  

    //322f9a2f428d40918991be62530e8bc0

    $config = $this->config(static::SETTINGS);

    $form['google_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Google News Api Key'),
      '#default_value' => $config->get('google_api_key'),
      '#required' => TRUE,
      '#attributes' => array(
        'placeholder' => t('322f9a2f428d40918991be62530e8bc0'),
      ),
    ];  

    $form['label']  = array(
      '#type' => 'label',
      '#title' => $this->t('<strong>Select following checkboxes to show these details in a google news block. otherwise these details will not shown in the news section.</strong>'),
      '#id'         => 'lbl1',
      '#prefix'     => '<div class="caption1">',
      '#suffix'     => '</div>',
    );

    $form['author_news'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Author of the News'),
      '#default_value' => $config->get('author_news'),
    ];

    $form['title_news'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Title of the News'),
      '#default_value' => $config->get('title_news'),
    ];

    $form['description_news'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Description of the News'),
      '#default_value' => $config->get('description_news'),
    ];

    $form['link_news'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Link of the News'),
      '#default_value' => $config->get('link_news'),
    ];

    $form['image_news'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Image of the News'),
      '#default_value' => $config->get('image_news'),
    ];

    $form['publishedAt'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Publish date of the News'),
      '#default_value' => $config->get('publishedAt'),
    ];

    $form['content_news'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Content of the News'),
      '#default_value' => $config->get('content_news'),
    ];

    return parent::buildForm($form, $form_state);
  }

 /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      // Retrieve the configuration
    $this->configFactory->getEditable(static::SETTINGS)
    // Set the submitted configuration setting
    ->set('google_api_key', $form_state->getValue('google_api_key'))
    ->set('author_news', $form_state->getValue('author_news'))
    ->set('title_news', $form_state->getValue('title_news'))
    ->set('description_news', $form_state->getValue('description_news'))
    ->set('link_news', $form_state->getValue('link_news'))
    ->set('image_news', $form_state->getValue('image_news'))
    ->set('publishedAt', $form_state->getValue('publishedAt'))
    ->set('content_news', $form_state->getValue('content_news'))
    // You can set multiple configurations at once by making
    // multiple calls to set()
    ->save();

    parent::submitForm($form, $form_state);
  }
}  
