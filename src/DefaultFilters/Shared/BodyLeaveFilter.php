<?php

namespace EmailCleaner\DefaultFilters\Shared;

use EmailCleaner\FilterAbstract;

class BodyLeaveFilter extends FilterAbstract {
    
    
    public function run(){
        $body = $this->dom->find("body");
        if(!$body->count()){
            return;
        }

        $body->wrap("<div></div>");
        $this->dom->find("html")->replaceWith($body->html());
    }
    
    /**
     * 
     * @return int
     */
    public function getPriority() {
        return -1000;
    }
}
