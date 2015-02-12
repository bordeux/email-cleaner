# EmailCleaner

Class removes all previus replay messages, leave only new content.
## Installation
```php
composer require "bordeux/email-cleaner"
```
or
```php
{
	"bordeux/email-cleaner": "dev-master"
}
```

## Example usage
```php
<?php
use EmailCleaner\EmailCleaner;
    $emailCleaner = new EmailCleaner();
    $simpeEmailHTMLContent = "<your html email code>";
    $emailCleaner->setHTML(file_get_contents($filename));
    $resultHTML = $emailCleaner->parse();
    var_dump($resultHTML); //html only with response to email
?>
```


## Custom filters
```php
<?php
use EmailCleaner\EmailCleaner;
use EmailCleaner\FilterAbstract;

class YourCustomFilter extends FilterAbstract {
    public function run() {
        $this->dom->find(".gmail_extra")->remove();
    }
}

    $emailCleaner = new EmailCleaner();
    $emailCleaner->addFilter(new YourCustomFilter());
    
    $simpeEmailHTMLContent = "<your html email code>";
    $emailCleaner->setHTML(file_get_contents($filename));
    $resultHTML = $emailCleaner->parse();
    var_dump($resultHTML); //html only with response to email
?>
```



##### Thank you to:
* Tobiasz Cudnik < [phpQuery](https://github.com/TobiaszCudnik/phpquery) > - CSS2XPATH parser