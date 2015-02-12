<?php



namespace EmailCleaner\DefaultFilters\Gmail;

use EmailCleaner\FilterAbstract;

class GmailQuoteFilter extends FilterAbstract {
    
    public function run(){
        $this->dom->find(".gmail_quote")->remove();
    }
}
