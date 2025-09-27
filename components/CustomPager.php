<?php
namespace app\components;

use yii\bootstrap5\LinkPager;
use yii\helpers\Html;

class CustomPager extends LinkPager
{
    public $options = ['class' => 'pages']; // wrapper div

    public function renderPageButton(string $label, int $page, string $class, bool $disabled, bool $active): string
    {
        $classes = 'page ' . $class;
        if ($active) {
            $classes .= ' active';
        }
        if ($disabled) {
            $classes .= ' disabled';
        }

        return Html::a($label, $this->pagination->createUrl($page), [
            'class' => $classes,
        ]);
    }

    public function run(): string
    {
        return Html::tag('div', $this->renderPageButtons(), $this->options);
    }
}
