<?php

namespace EmailCleaner\DefaultFilters\Shared;

use DOMElement;
use EmailCleaner\FilterAbstract;

class EmptyTagsFilter extends FilterAbstract {
    
    public function run(){
        /* @var $el DOMElement */
        $this->dom->find("*")->each(function(DOMElement $el){
            $content = trim($el->textContent);
            if($content !== ""){
                return;
            }
            
            $pEl = pq($el);
            if(in_array(strtolower($el->tagName), array("span", "i", "a", "strike" ,"s"))){
                 $pEl->remove();
                 return;
            }
            $pEl->replaceWith("<br />");
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
