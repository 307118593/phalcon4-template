<?php

namespace App\Core\Models;

class BaseModel extends \Phalcon\Mvc\Model {

    protected ?string $table = NULL;

    /**
     * Initializes Model configuration
     */
    public function initialize() : void {
        if(is_null($this->table)) {
            $this->table = strtolower(preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', '_$0', substr(strrchr(get_class($this), "\\"), 1))));
        }

        $this->setSource($this->table);
    }

}