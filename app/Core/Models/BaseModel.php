<?php

namespace App\Core\Models;

class BaseModel extends \Phalcon\Mvc\Model {

    protected ?string $table = NULL;

    /**
     * Search for given parameters and fail
     * if not exists
     *
     * @param null $parameters
     *
     * @throws \Exception
     * @return bool|\Phalcon\Mvc\ModelInterface
     */
    public static function findOrFail($parameters = NULL) : self {
        $result = self::findFirst($parameters);

        if(empty($result)) throw new \Exception('Such records doesn\'t exists on ' . substr(strrchr(static::class, "\\"), 1));

        return $result;
    }

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