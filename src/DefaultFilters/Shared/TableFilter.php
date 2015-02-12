<?php

namespace EmailCleaner\DefaultFilters\Shared;

use EmailCleaner\FilterAbstract;

class TableFilter extends FilterAbstract {
    
    public function run(){
        $this->dom->find("table")->remove();
    }
}
