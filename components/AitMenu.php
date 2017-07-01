<?php

/**
 * @link 
 * @copyright 
 * @license 
 */

namespace app\components;

use yii\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class AitMenu extends Menu
{

    /**
     * @var string the template used to render the body of a menu which is NOT a link.
     * In this template, the token `{icon}` will be replaced with the icon of the menu item.
     * This property will be overridden by the `template` option set in individual menu items via [[items]].
     */
    public $iconTemplate = '{icon}';

    public function init()
    {
        parent::init();
        $this->linkTemplate = '<a href="{url}" title="{label}"><i class="fa fa-{icon}"></i><span>{label}</span></a>';
        $this->submenuTemplate = "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n";
    }

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     */
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            if ($tag === false) {
                $lines[] = $menu;
            } else {
                $lines[] = Html::tag($tag, $menu, $options);
            }
        }

        return implode("\n", $lines);
    }

    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     */
    protected function renderItem($item)
    {
        if (isset($item['url']))
        {
            if( !empty($item['items']) ){
                $this->linkTemplate = '<a href="{url}" title="{label}"><i class="fa fa-{icon}"></i><span>{label}</span><i class="fa fa-angle-left pull-right"></i></a>';
            }
            else{
                $this->linkTemplate = '<a href="{url}" title="{label}"><i class="fa fa-{icon}"></i><span>{label}</span></a>';
            }
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
                '{icon}' => isset($item['icon']) ? $item['icon']:"circle-o",
            ]);
        }
        else
        {
            if( !empty($item['items']) ){
                $this->labelTemplate = '{label}<i class="fa fa-angle-left pull-right"></i>';
            }
            else{
                $this->labelTemplate = '{label}';
            }
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{label}' => $item['label'],
                '{icon}' => isset($item['icon']) ? $item['icon']:"minus",
            ]);
        }
    }

}
