<?php

namespace EmailCleaner\DefaultFilters\DreamMail;

use DOMComment;
use EmailCleaner\FilterAbstract;

class HTMLReplyCommentFilter extends FilterAbstract {

    public function run() {
        $comments = $this->dom->xpath->query('//comment()');
       
        /* @var $el DOMComment */
        foreach($comments as $el){
            $content = strtolower($el->nodeValue);
            if(strpos($content, "reply") === -1){
                return;
            }
            
            $nexts = [];
            $next = $el;
            while($next = $next->nextSibling){
                $nexts[] = $next;
            }
            foreach($nexts as $item){
                $item->parentNode->removeChild($item);
            }
            
            $el->parentNode->removeChild($el);
        }
    }

}
