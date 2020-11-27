<?php


namespace App\Util\BinaryTree;


class Element
{
    /**
     * @var string
     */
    public string $value;

    /**
     * @var Element
     */
    public static Element $instance;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    private function __clone(){}

    /**
     * @param string $value
     * @return static
     */
    public static function getInstance($value) :self
    {
//        if (!self::$instance) {
//            self::$instance = new self();
//        }
        self::$instance = new self($value);
        return self::$instance;
    }

    /**
     * @return string
     */
    public function GetValue() :string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function SetValue(string $value) :self
    {
        $this->value = $value;
        return $this;
    }
}