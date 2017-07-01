<?php

/**
 * @link 
 * @copyright 
 * @license 
 */

namespace app\components;

use Yii;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

class AitBreadCrumbs extends Breadcrumbs
{

    public function init()
    {
        parent::init();
        $this->tag = "ol";
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        if (empty($this->links))
        {
            return;
        }
        $links = [];
        if ($this->homeLink === null)
        {
            $this->itemTemplate = "<li><i class=\"fa fa-dashboard\"></i>{link}</li>\n";
            $links[] = $this->renderItem([
                'label' => Yii::t('yii', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
            $this->itemTemplate = "<li>{link}</li>\n";
        }
        elseif ($this->homeLink !== false)
        {
            $this->homeLink['icon'] = 'dashboard';
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ($this->links as $link)
        {
            if (!is_array($link))
            {
                $link = ['label' => $link];
            }
            if (isset($link['icon']))
            {
                $this->itemTemplate = "<li><i class=\"fa fa-" . $link['icon'] . "\"></i>{link}</li>\n";
                $this->activeItemTemplate = "<li class=\"active\"><i class=\"fa fa-" . $link['icon'] . "\"></i>{link}</li>\n";
            }
            else
            {
                $this->itemTemplate = "<li>{link}</li>\n";
                $this->activeItemTemplate = "<li class=\"active\">{link}</li>\n";
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $links), $this->options);
    }

}
