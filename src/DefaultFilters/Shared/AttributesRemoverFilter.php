<?php

namespace EmailCleaner\DefaultFilters\Shared;

use DOMElement;
use EmailCleaner\FilterAbstract;

class AttributesRemoverFilter extends FilterAbstract {
    public $allowedAttrs = array(
        "href"
    );
    public function run(){
        $allowedAttrs = $this->allowedAttrs;
        
        /* @var $el DOMElement */
        $this->dom->find("*")->each(function(DOMElement $el) use($allowedAttrs){
            foreach($el->attributes as $attrName => $item){
                if(in_array(strtolower($attrName), $allowedAttrs)){
                    continue;
                }
                
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
