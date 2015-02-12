<?php

namespace EmailCleaner\DefaultFilters\Shared;

use EmailCleaner\FilterAbstract;

class RemoveLastLinesFilter extends FilterAbstract {
    
    
    public function run(){
        
    }
    
    /**
     * 
     * @return int
     */
    public function getPriority() {
        return -10000;
    }
}
