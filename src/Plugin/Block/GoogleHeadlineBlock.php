<?php
/**
 * @file
 * Contains \Drupal\google_top_headlines\Plugin\Block\XaiBlock.
 */

namespace Drupal\google_top_headlines\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Cache\Cache;
use GuzzleHttp\Exception\RequestException;

/**
 * Provides a block for google top headlines.
 *
 * @Block(
 *   id = "google_headlines_block",
 *   admin_label = @Translation("Google Headlines Block"),
 *   category = @Translation("Custom Google Headlines block"),
 * )
 */
class GoogleHeadlineBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
  	 /** @var \GuzzleHttp\Client $client */
    
    $config = \Drupal::config('google_top_headlines.settings');
    
    if (!empty($config->get('google_api_key'))) {
      
      try {

        $client = \Drupal::service('http_client_factory')->fromOptions([
        'base_uri' => 'https://newsapi.org/',
        ]);

        $response = $client->get('v2/top-headlines', [
          'query' => [
            'sources' => 'google-news',
            'apiKey' => $config->get('google_api_key')
          ]
        ]);
      
      } catch(RequestException $exception) {
        $result = array (
        '#type' => 'markup',
        '#markup' => '<p>Configure the Google Credentials, Goto /Configuration/System/Google Top Headlines </p>',
        ); 
        //early return 
        return $result;   
      }
    }

    $result = Json::decode($response->getBody());
    if (empty($config->get())) {
      $result = array (
        '#type' => 'markup',
        '#markup' => '<p>Configure the Google Credentials, Goto /Configuration/System/Google Top Headlines </p>',
      ); 
    } else if (!empty($result)) {
        
      $result = array(
        '#theme' => 'google_top_headlines',

        '#author0' => ($config->get('author_news'))? $result['articles'][0]['author']:'',
        '#title0' => ($config->get('title_news'))? $result['articles'][0]['title']:'',
        '#description0' => ($config->get('description_news'))? $result['articles'][0]['description']:'',
        '#link0' => ($config->get('link_news'))? $result['articles'][0]['url']:'',
        '#imgsrc0' => ($config->get('image_news'))? $result['articles'][0]['urlToImage']:'',
        '#date0' => ($config->get('publishedAt'))? $result['articles'][0]['publishedAt']:'',
        '#content0' => ($config->get('content_news'))? $result['articles'][0]['content']:'',   

        '#author1' => ($config->get('author_news'))? $result['articles'][1]['author']:'',
        '#title1' => ($config->get('title_news'))? $result['articles'][1]['title']:'',
        '#description1' => ($config->get('description_news'))? $result['articles'][1]['description']:'',
        '#link1' => ($config->get('link_news'))? $result['articles'][1]['url']:'',
        '#imgsrc1' => ($config->get('image_news'))? $result['articles'][1]['urlToImage']:'',
        '#date1' => ($config->get('publishedAt'))? $result['articles'][1]['publishedAt']:'',
        '#content1' => ($config->get('content_news'))? $result['articles'][1]['content']:'',  

        '#author2' => ($config->get('author_news'))? $result['articles'][2]['author']:'',
        '#title2' => ($config->get('title_news'))? $result['articles'][2]['title']:'',
        '#description2' => ($config->get('description_news'))? $result['articles'][2]['description']:'',
        '#link2' => ($config->get('link_news'))? $result['articles'][2]['url']:'',
        '#imgsrc2' => ($config->get('image_news'))? $result['articles'][2]['urlToImage']:'',
        '#date2' => ($config->get('publishedAt'))? $result['articles'][2]['publishedAt']:'',
        '#content2' => ($config->get('content_news'))? $result['articles'][2]['content']:'',  

        '#author3' => ($config->get('author_news'))? $result['articles'][3]['author']:'', 
        '#title3' => ($config->get('title_news'))? $result['articles'][3]['title']:'',
        '#description3' => ($config->get('description_news'))? $result['articles'][3]['description']:'',
        '#link3' => ($config->get('link_news'))? $result['articles'][3]['url']:'',
        '#imgsrc3' => ($config->get('image_news'))? $result['articles'][3]['urlToImage']:'',
        '#date3' => ($config->get('publishedAt'))? $result['articles'][3]['publishedAt']:'',
        '#content3' => ($config->get('content_news'))? $result['articles'][3]['content']:'',  

        '#author4' => ($config->get('author_news'))? $result['articles'][4]['author']:'',
        '#title4' => ($config->get('title_news'))? $result['articles'][4]['title']:'',
        '#description4' => ($config->get('description_news'))? $result['articles'][4]['description']:'',
        '#link4' => ($config->get('link_news'))? $result['articles'][4]['url']:'',
        '#imgsrc4' => ($config->get('image_news'))? $result['articles'][4]['urlToImage']:'',
        '#date4' => ($config->get('publishedAt'))? $result['articles'][4]['publishedAt']:'',
        '#content4' => ($config->get('content_news'))? $result['articles'][4]['content']:'',  
        
        '#author5' => ($config->get('author_news'))? $result['articles'][5]['author']:'',
        '#title5' => ($config->get('title_news'))? $result['articles'][5]['title']:'',
        '#description5' => ($config->get('description_news'))? $result['articles'][5]['description']:'',
        '#link5' => ($config->get('link_news'))? $result['articles'][5]['url']:'',
        '#imgsrc5' => ($config->get('image_news'))? $result['articles'][5]['urlToImage']:'',
        '#date5' => ($config->get('publishedAt'))? $result['articles'][5]['publishedAt']:'',
        '#content5' => ($config->get('content_news'))? $result['articles'][5]['content']:'',  
        
        '#author6' => ($config->get('author_news'))? $result['articles'][6]['author']:'',
        '#title6' => ($config->get('title_news'))? $result['articles'][6]['title']:'',
        '#description6' => ($config->get('description_news'))? $result['articles'][6]['description']:'',
        '#link6' => ($config->get('link_news'))? $result['articles'][6]['url']:'',
        '#imgsrc6' => ($config->get('image_news'))? $result['articles'][6]['urlToImage']:'',
        '#date6' => ($config->get('publishedAt'))? $result['articles'][6]['publishedAt']:'',
        '#content6' => ($config->get('content_news'))? $result['articles'][6]['content']:'' , 
        
        '#author7' => ($config->get('author_news'))? $result['articles'][7]['author']:'',
        '#title7' => ($config->get('title_news'))? $result['articles'][7]['title']:'',
        '#description7' => ($config->get('description_news'))? $result['articles'][7]['description']:'',
        '#link7' => ($config->get('link_news'))? $result['articles'][7]['url']:'',
        '#imgsrc7' => ($config->get('image_news'))? $result['articles'][7]['urlToImage']:'',
        '#date7' => ($config->get('publishedAt'))? $result['articles'][7]['publishedAt']:'',
        '#content7' => ($config->get('content_news'))? $result['articles'][7]['content']:'', 
        
        '#author8' => ($config->get('author_news'))? $result['articles'][8]['author']:'',
        '#title8' => ($config->get('title_news'))? $result['articles'][8]['title']:'',
        '#description8' => ($config->get('description_news'))? $result['articles'][8]['description']:'',
        '#link8' => ($config->get('link_news'))? $result['articles'][8]['url']:'',
        '#imgsrc8' => ($config->get('image_news'))? $result['articles'][8]['urlToImage']:'',
        '#date8' => ($config->get('publishedAt'))? $result['articles'][8]['publishedAt']:'',
        '#content8' => ($config->get('content_news'))? $result['articles'][8]['content']:'',  
        
        '#author9' => ($config->get('author_news'))? $result['articles'][9]['author']:'',    
        '#title9' => ($config->get('title_news'))? $result['articles'][9]['title']:'',
        '#description9' => ($config->get('description_news'))? $result['articles'][9]['description']:'',
        '#link9' => ($config->get('link_news'))? $result['articles'][9]['url']:'',
        '#imgsrc9' => ($config->get('image_news'))? $result['articles'][9]['urlToImage']:'',
        '#date9' => ($config->get('publishedAt'))? $result['articles'][9]['publishedAt']:'',
        '#content9' => ($config->get('content_news'))? $result['articles'][9]['content']:'',  
      );
    } else {
      $result = array (
        '#type' => 'markup',
          '#markup' => '<p>Google top headlines not found.</p>',
      );   
    }
    
    return $result;
  }
}