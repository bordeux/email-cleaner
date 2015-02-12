<?php

namespace EmailCleaner\DefaultFilters\Thunderbird;

use DOMElement;
use EmailCleaner\FilterAbstract;

class MozSignatureFilter extends FilterAbstract {

    public function run() {
        $signature = $this->dom->find(".moz-signature");
        if(!$signature->count()){
            return;
        }
        
        /* @var $el DOMElement */
        $signature->each(function(DOMElement $el){
            $nexts = [];
            $next = $el;
            while($next = $next->nextSibling){
                $nexts[] = $next;
            }
            foreach($nexts as $item){
                pq($item)->remove();
            }
        });
        
        
        $signature->remove();
    }

}
