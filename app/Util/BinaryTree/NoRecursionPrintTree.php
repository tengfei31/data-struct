<?php


namespace App\Util\BinaryTree;

/**
 * 非递归遍历二叉树
 * Class NoRecursionPrintTree
 * @package App\Util\BinaryTree
 */
class NoRecursionPrintTree
{
    /**
     * 二叉树
     * @var Tree
     */
    public Tree $tree;

    /**
     * NoRecursionPrintTree constructor.
     * @param Tree $tree
     */
    public function __construct(Tree $tree)
    {
        $this->tree = $tree;
    }

    /**
     * 前序遍历
     * @return array
     */
    public function IPreOrder() :array
    {
        $p = $this->tree->root;
        //构造一个空栈
        $stack = new \SplStack();
        $stack->push(NULL);//在栈底压入NULL
        $res = [];
        while ($p) {
            $res[] = $p->element->GetValue();
            if ($p->rightNode) $stack->push($p->rightNode);//若p有右子树，将右子树的根节点地址进栈
            if ($p->leftNode) {//若p有左子树，则转而访问左子树上节点
                $p = $p->leftNode;
            } else {
                $p = $stack->pop();
            }
        }
        return $res;
    }

    /**
     * 中序遍历
     * @return array
     */
    public function IInOrder() :array
    {
        $p = $this->tree->root;
        $stack = new \SplStack();
        $res = [];
        while ($p || !$stack->isEmpty()) {
            if (!$p) {
                //$stack->top();
                $p = $stack->pop();
                $res[] = $p->element->GetValue();
                $p = $p->rightNode;
            } else {
                $stack->push($p);
                $p = $p->leftNode;
            }
        }
        return $res;
    }

    /**
     * TODO: 还有问题
     * 后序遍历
     * @return array
     */
    public function IPostOrder() :array
    {
        $p = $this->tree->root;
        $stack = new \SplStack();
        $prev = NULL;
        $res = [];
        while (!$p || !$stack->isEmpty()) {
            while (!$p) {
                $stack->unshift($p);
                $p = $p->leftNode;
            }
            $p = $stack->top();
            $stack->pop();
            if ($p->rightNode == NULL || $p->rightNode == $prev) {
                $res[] = $p->element->GetValue();
                $prev = $p;
                $p = NULL;
            } else {
                $stack->unshift($p);
                $p = $p->rightNode;
            }
        }
        return $res;
    }
}