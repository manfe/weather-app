<?php

namespace App\Entities;

/** this need to be a model in an application (eg. Symphony), 
 *  so we can retrieve a list of partners, and each partner is
 *  going to be your own classe to parse the response, since possibly there are
 *  partners that doesn't use REST yet, etc. 
*/

class Partner 
{
    private $name;
    private $baseUri;
    private $format;

    public function __construct($name, $baseUri, $format = 'json')
    {
        $this->name = $name;
        $this->baseUri = $baseUri;
        $this->format = $format;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getBaseURI() {
        return $this->baseUri;
    }

    public function getFormat() {
        return $this->format;
    }

}
