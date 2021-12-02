<?php

namespace Entity;


abstract class BaseEntity
{

    /**
     * BaseEntity constructor.
     * @param array $datas
     */
    public function __construct(array $datas = [])
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}