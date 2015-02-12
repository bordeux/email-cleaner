<?php

namespace EmailCleaner\DefaultFilters\Shared;

use DOMElement;
use EmailCleaner\FilterAbstract;

class AttributesRemoverFilter extends FilterAbstract {
    
    public function run(){
        /* @var $el DOMElement */
        $this->dom->find("*")->each(function(DOMElement $el){
            foreach($el->attributes as $attrName => $item){
                $el->removeAttribute($attrName);
            }
        });
        
        
    }
    
    /**
     * 
     * @return int
     */
    public function getPriority() {
        return 1000;
    }
}
