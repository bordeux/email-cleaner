<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmailCleaner;

use Exception;
use phpQuery;
use phpQueryObject;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;

class EmailCleaner {

    /**
     *
     * @var phpQueryObject
     */
    private $dom;

    /**
     *
     * @var FilterAbstract[]
     */
    public $filters;
    
    /**
     *
     * @var boolean 
     */
    private $needSort = false;
    
    /**
     * 
     * @staticvar type $filters
     * @return string[]
     */
    public static function getDefaultFilters() {
        static $filters = null;
        if (!is_null($filters)) {
            return $filters;
        }
        $dirname = realpath(dirname(__FILE__) . '/DefaultFilters/');
        $directory = new RecursiveDirectoryIterator($dirname);
        $iterator = new RecursiveIteratorIterator($directory);
        $regex = new RegexIterator($iterator, '/^.+Filter\.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach ($regex as $filename => $curr) {
            $namespace = strtr($filename, array(
                $dirname => "",
                "/" => "\\",
                ".php" => ""
            ));
            $namespace = __NAMESPACE__ . "\\DefaultFilters" . $namespace;
            $filters[] = $namespace;
        }
        return $filters;
    }
    
    
    /**
     * 
     */
    public function __construct($html = null) {
        
        if(is_string($html)){
            $this->setHTML($html);
        }
        
        if($html instanceof Dom){
            $this->setDom($html);
        }
        
        foreach(static::getDefaultFilters() as $className){
            $this->addFilter(new $className());
        }
    }

    
    /**
     * 
     * @param FilterAbstract $filter
     * @return EmailCleaner
     */
    public function addFilter(FilterAbstract $filter){
        $this->filters[] = $filter;
        $this->needSort = true;
        return $this;
    }
    
    
    /**
     * 
     * @param string $html
     * @return EmailCleaner
     */
    public function setHTML($html) {
        return $this->setDom(phpQuery::newDocumentHTML($html));
    }

    /**
     * 
     * @param phpQueryObject $dom
     * @return EmailCleaner
     */
    public function setDom(phpQueryObject $dom) {
        $this->dom = $dom;
        return $this;
    }
    
    /**
     * 
     * @return boolean
     */
    private function sortFilters(){
        if(!$this->needSort){
            return true;
        }

        usort($this->filters, function($a, $b) {
            return $a->getPriority() > $b->getPriority();
        });
        return true;
    }
    
    /**
     * 
     * @return string
     */
    public function parse(){
        if(!$this->dom){
            throw new Exception(__CLASS__. ': You must set HTML content to class by setHTML or setHTML', 503);
        }
        
        $this->sortFilters();
        
        
        foreach($this->filters as $filter){
            $filter->clean();
            $filter->setDom($this->dom);
            $filter->run();
        }
        $this->dom->document->doctype->textContent = "";
        $result = preg_replace("/<!DOCTYPE [^>]+>/", "", $this->dom->html());
        $result = trim($result);
        return $result;
    }

}
