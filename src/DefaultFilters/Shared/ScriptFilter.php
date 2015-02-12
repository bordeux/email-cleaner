<?php

namespace EmailCleaner\DefaultFilters\Shared;

use EmailCleaner\FilterAbstract;

class ScriptFilter extends FilterAbstract {
    
    public function run(){
        $this->dom->find("script")->remove();
    }
}
