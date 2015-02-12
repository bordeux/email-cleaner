<?php

namespace EmailCleaner\DefaultFilters\Gmail;

use EmailCleaner\FilterAbstract;

class GmailExtraFilter extends FilterAbstract {

    public function run() {
        $this->dom->find(".gmail_extra")->remove();
    }

}
