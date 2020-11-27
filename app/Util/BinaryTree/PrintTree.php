<?php


namespace App\Util\BinaryTree;


class PrintTree
{
    /**
     * 打印节点的元素值
     * @return callable
     */
    public static function Visit() :callable
    {
        return function (TreeNode $node) {
            printf("%s ", $node->element->GetValue());
        };
    }
}