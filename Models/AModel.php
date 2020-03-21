<?php

namespace models{
abstract class AModel{


        /**
         * 
         * inspired from this:
         * https://stackoverflow.com/questions/33632621/handling-php-properties-like-those-in-c-sharp-getter-setter
         * 
         */
        public function __get($name)
        {
            $method = sprintf('get%s', ucfirst($name));

            if (!method_exists($this, $method)) {
                throw new \Exception();
            }
            return $this->$method();
        }

        public function __set($name, $v)
        {
            $method = sprintf('set%s', ucfirst($name));

            if (!method_exists($this, $method)) {
                throw new \Exception();
            }

            $this->$method($v);
        }

        /**
         * influenced from this:
         * http://jrgns.net/json-encode-ing-private-and-protected-properties/index.html
         * 
         */
        public function _toJson()
        {
            $properties = $this->getProperties();

         
            $object     = new \StdClass();
            $object->_class      = get_class($this);

            
            foreach ($properties as $prop) 
            {
                 $name =  $prop->getName();
               $object->$name = $this->$name;
            }
            return json_encode($object);
        }

        public function getProperties()
        {
                    
            $reflect = new \ReflectionClass($this);
            $props   = $reflect->getProperties();
            return $props;
        }

    }
}
?>