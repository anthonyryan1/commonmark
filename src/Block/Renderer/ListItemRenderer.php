<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmarkjs)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Block\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\HtmlRenderer;

class ListItemRenderer implements BlockRendererInterface
{
    /**
     * @param ListItem $block
     * @param HtmlRenderer $htmlRenderer
     * @param bool $inTightList
     *
     * @return string
     */
    public function render(AbstractBlock $block, HtmlRenderer $htmlRenderer, $inTightList = false)
    {
        $contents = $htmlRenderer->renderBlocks($block->getChildren(), $inTightList);
        if (substr($contents, 0, 1) === '<') {
            $contents = "\n" . $contents;
        }
        if (substr($contents, -1, 1) === '>') {
            $contents .= "\n";
        }

        return trim($htmlRenderer->inTags('li', array(), $contents));
    }
}
