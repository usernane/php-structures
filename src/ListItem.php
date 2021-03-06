<?php
/*
 * The MIT License
 *
 * Copyright (c) 2019 Ibrahim BinAlshikh, WebFiori UI Package.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace webfiori\ui;

/**
 * A class that represents List Item node.
 *
 * @author Ibrahim
 * 
 * @version 1.1.1
 */
class ListItem extends HTMLNode {
    /**
     * Constructs new list item
     * 
     * @param string|HTMLNode $listItemBody An optional body for the list item. 
     * It can be a string or an instance of the class HTMLNode. Default is null.
     * 
     * @since 1.0
     */
    public function __construct($listItemBody = null) {
        parent::__construct('li');
        $this->addChild($listItemBody);
    }
    /**
     * Adds a sub list to the body of the list item.
     * 
     * @param array $listItems An array that holds all list items which 
     * will be in the body of the list. It can contain text items or it can have 
     * objects of type 'ListItem'.
     * 
     * @param string $type The type of the sub list. It can be 'ul' or 'ol'. 
     * Default is 'ul'.
     * 
     * @param array $attrs An optional associative array of attributes which 
     * will be set for the list.
     * 
     * @return ListItem The method will return the instance at which the method 
     * is called on.
     * 
     * @since 1.1.1
     */
    public function addList(array $listItems, $type = 'ul', array $attrs = []) {
        $lType = strtolower(trim($type));

        if ($lType == 'ol') {
            $list = new OrderedList();
        } else {
            $list = new UnorderedList();
        }

        if (gettype($listItems) == 'array') {
            $this->addChild($list);

            foreach ($listItems as $itemTextOrObj) {
                $list->addListItem($itemTextOrObj);
            }

            if (gettype($attrs) == 'array') {
                foreach ($attrs as $attr => $val) {
                    $list->setAttribute($attr, $val);
                }
            }
        }

        return $this;
    }
}
