<?php

/* 
 * The MIT License
 *
 * Copyright 2018 Ibrahim.
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
/**
 * A class that represents a stack data structure.
 *
 * @author Ibrahim <ibinshikh@hotmail.com>
 * @version 1.0
 */
class Stack{
    /**
     * The bottom node of the stack.
     * @var Node
     * @since 1.0 
     */
    private $head;
    /**
     * The top node of the stack.
     * @var Node
     * @since 1.0 
     */
    private $tail;
    /**
     * The number of elements in the stack.
     * @var Node
     * @since 1.0 
     */
    private $size;
    /**
     * The maximum number of elements the stack can hold.
     * @var int
     * @since 1.0 
     */
    private $max;
    /**
     * Constructs a new instance of the class.
     * @param int $max The maximum number of elements the stack can hold. 
     * if a negative number is given or 0, the stack will have unlimited number 
     * of elements. Also if the given value is not an integer, the maximum will be set 
     * to unlimited.
     */
    public function __construct($max=0) {
        $this->head = NULL;
        $this->tail = NULL;
        $this->size = 0;
        if(gettype($max) == 'integer'){
            $this->max = $max;
        }
        else{
            $this->max = 0;
        }
    }
    /**
     * Returns the number of maximum elements the stack can hold.
     * @return int If the maximum number of elements was set to 0 or a 
     * negative number, the function will return <b>-1</b>. Other than that, 
     * the function will return the maximum number of elements
     */
    public function max(){
        if($this->max <= 0){
            return -1;
        }
        return $this->max;
    }
    /**
     * Adds new element to the top of the stack.
     * @param mixed $el The element that will be added. If it is <b>NULL</b>, the 
     * function will not add it.
     * @return boolean The function will return <b>TRUE</b> if the element is added. 
     * The function will return <b>FALSE</b> only in two cases, If the maximum 
     * number of elements is reached and trying to add new one or the given element 
     * is <b>NULL</b>.
     * @since 1.0
     */
    public function push($el) {
        if($el != NULL){
            if($this->validateSize()){
                if($this->size() == 0){
                    $this->head = new Node($el);
                    $this->size++;
                    return TRUE;
                }
                else if($this->size() == 1){
                    $this->tail = new Node($el);
                    $this->head->setNext($this->tail);
                    $this->size++;
                    return TRUE;
                }
                else{
                    $node = $this->tail;
                    $this->tail = new Node($el);
                    $node->setNext($this->tail);
                    $this->size++;
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
    /**
     * Returns the element that exist on the top of the stack.
     * @return mixed The element at the top. If the stack is empty, the function 
     * will return <b>NULL</b>.
     * @since 1.0
     */
    public function peek(){
        if($this->size() == 1){
            return $this->head->data();
        }
        else if($this->size() > 1){
            return $this->tail->data();
        }
        else{
            return NULL;
        }
    }
    /**
     * Removes an element from the top of the stack.
     * @return mixed The element after removal from the stack. If the stack is 
     * empty, the function will return <b>NULL</b>.
     * @since 1.0
     */
    public function pop(){
        if($this->size() == 0){
            return NULL;
        }
        else if($this->size() == 1){
            $data = $this->head->data();
            $this->head = NULL;
            $this->tail = NULL;
            $this->size--;
            return $data;
        }
        else{
            $node = $this->head;
            $nextNode = $this->head->next();
            while ($nextNode->next() != NULL){
                $node = $nextNode;
                $nextNode = $nextNode->next();
            }
            $data = $nextNode->data();
            $null = NULL;
            $node->setNext($null);
            $this->tail = $node;
            $this->size--;
            return $data;
        }
    }
    /**
     * Checks if the stack can hold more elements or not.
     * @return boolean <b>TRUE</b> if the stack can hold more elements.
     * @since 1.0
     */
    private function validateSize(){
        $max = $this->max();
        if($max == -1){
            return TRUE;
        }
        if($max > $this->size()){
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * Returns the number of elements in the stack.
     * @return int The number of elements in the stack.
     * @since 1.0
     */
    public function size(){
        return $this->size;
    }
    public function __toString() {
        $retVal = 'Stack[';
        $node = $this->head;
        while ($node != NULL){
            $data = $node->data();
            if($node->next() == NULL){
                $retVal .= $data.'('. gettype($data).')';
            }
            else{
                $retVal .= $data.'('. gettype($data).'), ';
            }
            $node = $node->next();
        }
        $retVal .= ']';
        return $retVal;
    }
}