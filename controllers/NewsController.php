<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionIndex($category = null)
    {
        if ($category === null) {
            $category = 'business';
        }

        $topNews = Yii::$app->newsApi->getTopHeadlines('us', $category);
        
        return $this->render('index', [
            'topNews' => $topNews,
            'category' => $category
        ]);
    }

    public function actionSearch($q = null)
    {
        if ($q === null) {
            throw new \yii\web\BadRequestHttpException("Keyword tidak boleh kosong.");
        }
        
        $results = Yii::$app->newsApi->searchNews($q);
        return $this->render('search', [
            'query' => $q,
            'results' => $results
        ]);
    }

    public static function categories()
    {
        return [
            'general' => 'Umum',
            'business' => 'Bisnis',
            'entertainment' => 'Hiburan',
            'health' => 'Kesehatan',
            'science' => 'Sains',
            'sports' => 'Olahraga',
            'technology' => 'Teknologi',
        ];
    }
}
