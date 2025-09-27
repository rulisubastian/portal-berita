<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

class NewsApi extends Component
{
    private $baseUrl = 'https://newsapi.org/v2/';
    private $apiKey;

    public function __construct($config = [])
    {
        $this->apiKey = Yii::$app->params['newsApiKey'];
        parent::__construct($config);
    }

    public function getTopHeadlines($country = 'us', $category = null)
    {
        $client = new Client(['baseUrl' => $this->baseUrl]);

        $response = $client->get('top-headlines', [
            'country' => $country,
            'category' => $category,
            // 'pageSize' => 10
        ], [
            'X-api-key' => $this->apiKey,
            'User-Agent' => 'MyYiiApp/1.0 (https://example.com)'
        ])->send();

        return $response->isOk ? $response->data['articles'] : [];
    }

    public function searchNews($query)
    {
        $client = new Client(['baseUrl' => $this->baseUrl]);
        $response = $client->get('everything', [
            'q' => $query,
            // 'pageSize' => 20
        ], [
            'X-Api-Key' => $this->apiKey,
            'User-Agent' => 'MyYiiApp/1.0 (https://example.com)'
        ])->send();

        return $response->isOk ? $response->data['articles'] : [];
    }
}
