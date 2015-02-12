<?php

namespace EmailCleaner\DefaultFilters\iOS;

use DOMText;
use EmailCleaner\FilterAbstract;

class SentFromIphoneFilter extends FilterAbstract {


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
            $prevSecond->parentNode->removeChild($prevSecond);
            
            $nextElement = $el->parentNode;
            $nextElement->removeChild($el);
            while($nextElement = $nextElement->nextSibling){
                $nextElement->parentNode->removeChild($nextElement);
            }

        }
    }


}
