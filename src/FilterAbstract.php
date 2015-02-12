<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmailCleaner;

use phpQueryObject;

/**
 * 
 */
abstract class FilterAbstract {

    /**
     *
     * @var phpQueryObject 
     */
    public $dom;

    
    /**
     * 
     * @return int
     */
    public function getPriority(){
        return 1;
    }
    

    /**
     * 
     * @param phpQueryObject $dom
     * @return FilterAbstract
     */
    public function setDom(phpQueryObject $dom) {
        $this->dom = $dom;
        return $this;
    }

    /**
     * 
     * @return Dom
     */
    public function getDom() {
        return $this->dom;
    }

    
    /**
     * 
     * @return FilterAbstract
     */
    public function clean() {
        $this->dom = null;
        return $this;
    }
    
    /**
     * 
     */
    public function run() {
        
    }
    


}
