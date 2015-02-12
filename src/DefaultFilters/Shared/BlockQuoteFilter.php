<?php

namespace EmailCleaner\DefaultFilters\Shared;

use EmailCleaner\FilterAbstract;

class BlockQuoteFilter extends FilterAbstract {
    
    public function run(){
        $this->dom->find("blockquote")->remove();
    }
}
