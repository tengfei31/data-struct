<?php


namespace App\Util\BinaryTree;


class Tree
{
    /**
     * @var TreeNode
     */
    public $root;

    /**
     * 创建一个空树
     * @return static
     */
    public static function CreateTree() :self
    {
        $obj = new self();
        $obj->root = NULL;
        return $obj;
    }

    /**
     * 给bt的左右节点、元素赋值
     * @param Tree $bt
     * @param Element $element
     * @param Tree $lt
     * @param Tree $rt
     */
    public static function MakeBinaryTree(Tree $bt, Element $element, Tree $lt, Tree $rt) :void
    {
        $p = TreeNode::CreateNode();
        $p->element = $element;
        $p->leftNode = $lt->root;
        $p->rightNode = $rt->root;
        $lt->root = $rt->root = $element = NULL;
        $bt->root = $p;
    }

    /**
     * 将bt的左右节点赋值给新的树
     * @param Tree $bt
     * @param Element $element
     * @param Tree $lt
     * @param Tree $rt
     */
    public static function BreakBinaryTree(Tree $bt, Element $element, Tree $lt, Tree $rt) :void
    {
        $p = $bt->root;
        if ($p) {
            $element = $p->element;
            $lt->root = $p->leftNode;
            $rt->root = $p->rightNode;
            $bt->root = NULL;
        }
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return json_encode($this->root);
    }
}