<?php


namespace App\Util\BinaryTree;


class TreeNode
{
    /**
     * @var Element
     */
    public ?Element $element;

    /**
     * @var self
     */
    public ?self $leftNode;

    /**
     * @var $this |null
     */
    public ?self $rightNode;

    public int $LTag;

    public int $RTag;

    /**
     * @return static
     */
    public static function CreateNode() :self
    {
        return new self;
    }
}