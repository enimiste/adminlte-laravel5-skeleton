<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 21/11/16
 * Time: 19:16
 */

namespace App\Menu;


use Dowilcox\KnpMenu\Matcher\MatcherInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\RendererInterface;

class MyListRendrer implements RendererInterface
{
    /**
     * @var MatcherInterface
     */
    private $matcher;

    /**
     * MyListRendrer constructor.
     * @param MatcherInterface $matcher
     */
    public function __construct(MatcherInterface $matcher)
    {
        $this->matcher = $matcher;
    }


    /**
     * Renders menu tree.
     *
     * Common options:
     *      - depth: The depth at which the item is rendered
     *          null: no limit
     *          0: no children
     *          1: only direct children
     *      - currentAsLink: whether the current item should be a link
     *      - currentClass: class added to the current item
     *      - ancestorClass: class added to the ancestors of the current item
     *      - firstClass: class added to the first child
     *      - lastClass: class added to the last child
     *
     * @param ItemInterface $root Menu item
     * @param array $options some rendering options
     *
     * @return string
     */
    public function render(ItemInterface $root, array $options = array())
    {
        //Set the current item
        $this->setCurrentItemIfFound($root, $this->matcher);
        //None of the items is current
        $this->setDefaultCurrentItemIfNotExists($root, $this->matcher);

        $html = $this->buildHtml($root, $options);
        return $html;
    }

    /**
     * @param ItemInterface $root
     * @param $matcher
     */
    protected function setCurrentItemIfFound(ItemInterface $root, MatcherInterface $matcher)
    {
        collect($root->getChildren())
            ->each(function (ItemInterface $item) use ($matcher) {
                $item->setCurrent($matcher->isCurrent($item));
            });
    }

    /**
     * @param ItemInterface $root
     * @param $matcher
     */
    protected function setDefaultCurrentItemIfNotExists(ItemInterface $root, MatcherInterface $matcher)
    {
        if (collect($root->getChildren())
            ->filter(function (ItemInterface $item) use ($matcher) {
                return $item->isCurrent();
            })
            ->isEmpty()
        ) {
            //aucun menu n'est séléctionnés
            collect($root->getChildren())
                ->filter(function (ItemInterface $item) {
                    $extras = $item->getExtras();
                    return array_key_exists('current', $extras) && $extras['current'] == true;
                })->each(function (ItemInterface $item) {
                    $item->setCurrent(true);
                });
        }
    }

    /**
     * @param ItemInterface $root
     * @param array $options
     * @return mixed|string
     */
    protected function buildHtml(ItemInterface $root, array $options)
    {
        $html = sprintf('<ul class="%s">', $root->getAttribute('class'));
        $html = collect($root->getChildren())
            ->reduce(function ($acc, ItemInterface $item) use ($options, $root) {
                $treeview = $root->getChildrenAttribute('class');
                $class = sprintf('class="%s %s"', $treeview, $item->isCurrent() ? $options['currentClass'] : '');
                $html = sprintf('<li %s>', $class);
                $linkAttr = collect($item->getLinkAttributes())
                    ->map(function ($val, $k) {
                        return ['name' => $k, 'value' => $val];
                    })
                    ->reduce(function ($a, $attr) {
                        return $a .= sprintf(' %s="%s" ', $attr['name'], $attr['value']);
                    }, '');
                $html .= sprintf('<a href="%s" %s>%s</a>', $item->getUri(), $linkAttr, $item->getLabel());
                $html .= '</li>';
                return $acc . $html;
            }, $html);
        $html .= '</ul>';
        return $html;
    }
}