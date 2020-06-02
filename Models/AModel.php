<?php

namespace models{
abstract class AModel{


        protected $requiredArgs = [];

        protected function getValueFromArg($arg,$params)
        {
            $itsInThere = key_exists($arg,$params);
            if(!$itsInThere && in_array($arg, $this->requiredArgs))
            {
                throw new \Exception($arg." is required.");
            }
            return $itsInThere? $params[$arg]: "";
        }

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
                $valueIsPrimitive = is_scalar( $this->$name);
                $object->$name = $this->$name;
                
                if($valueIsPrimitive) continue;
                if(!$this->$name)  continue;

                $object_lvl2 =  new \StdClass();
                $object_lvl2->_class      = get_class($this);

                $innerProps = $this->getProperties($object->$name);
                foreach($innerProps as $innerProp)
                {
                    $innerName = $innerProp->getName();
                   $object_lvl2-> $innerName  =   $object->$name->$innerName;  

                }
                $object->$name =   $object_lvl2;
                   //  method_exists( $this->$name, '_toJson') ? $object->_toJson() : json_encode($object);
            }
            return json_encode($object);
        }

        public function getProperties($obj= null)
        {
            if(!$obj)
              $obj = $this;       
            $reflect = new \ReflectionClass($obj);
            $props   = $reflect->getProperties();
            return $props;
        }

    }
}
?>