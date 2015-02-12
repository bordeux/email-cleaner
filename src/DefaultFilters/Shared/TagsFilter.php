<?php

namespace EmailCleaner\DefaultFilters\Shared;

use EmailCleaner\FilterAbstract;

class TagsFilter extends FilterAbstract {
    
    public function run(){
        $this->dom->find("link")->remove();
    }
}
