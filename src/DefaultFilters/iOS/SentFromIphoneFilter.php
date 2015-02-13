<?php

namespace EmailCleaner\DefaultFilters\iOS;

use DOMText;
use EmailCleaner\FilterAbstract;

class SentFromIphoneFilter extends FilterAbstract {


    public function getParent(){
        
    }
    
    
    public function run() {
        $comments = $this->dom->xpath->query('//text()');
       
        /* @var $el DOMText */
        foreach($comments as $el){
            $content = strtolower($el->nodeValue);
            if($content !== "sent from my iphone"){
                continue;
            }
            $prev = $el->previousSibling;
            
            if($prev && $prev->nodeName != "br"){
                continue;
            }
            $prevSecond = $prev->previousSibling;
            if($prevSecond && $prevSecond->nodeName != "br"){
                continue;
            }
            
            $prev->parentNode->removeChild($prev);
            
            $nextElement = $prevSecond->parentNode;
            $prevSecond->parentNode->removeChild($prevSecond);
            $nextElement->removeChild($el);
            $nextElementsList = [];
            while($nextElement = $nextElement->nextSibling){
                $nextElementsList[] = $nextElement;
            }
            
            foreach($nextElementsList as $item){
                $item->parentNode->removeChild($item);
            }
            

        }
    }


}
