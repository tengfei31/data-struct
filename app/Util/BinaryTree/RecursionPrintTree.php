<?php


namespace App\Util\BinaryTree;

/**
 * 递归遍历二叉树
 * Class RecursionPrintTree
 * @package App\Util\BinaryTree
 */
class RecursionPrintTree
{
    /**
     * 二叉树
     * @var Tree
     */
    public Tree $tree;

    /**
     * RecursionPrintTree constructor.
     * @param Tree $tree
     */
    public function __construct(Tree $tree)
    {
        $this->tree = $tree;
    }

    /**
     * 前序遍历
     * @param TreeNode|NULL $node
     * @param array $res
     * @return array
     */
    private function PreOrd(TreeNode $node = NULL, array &$res = []) :array
    {
        if ($node) {
            array_push($res, $node->element->GetValue());
            $this->PreOrd($node->leftNode, $res);
            $this->PreOrd($node->rightNode, $res);
        }
        return $res;
    }

    /**
     * 前序遍历
     * @return array
     */
    public function PreOrder() :array
    {
        $res = [];
        return $this->PreOrd($this->tree->root, $res);
    }

    /**
     * 中序遍历
     * @param TreeNode|NULL $node
     * @param array $res
     * @return array
     */
    private function InOrd(TreeNode $node = NULL, array &$res = []) :array
    {
        if ($node) {
            $this->InOrd($node->leftNode, $res);
            if (!$node->leftNode) {
                $node->LTag = 1;
            }
            array_push($res, $node->element->GetValue());
            $this->InOrd($node->rightNode, $res);
            if (!$node->rightNode) {
                $node->RTag = 1;
            }
        }
        return $res;
    }

    /**
     * 中序遍历
     * @return array
     */
    public function InOrder() :array
    {
        $res = [];
        return $this->InOrd($this->tree->root, $res);
    }

    public function MakeThread(TreeNode $t, TreeNode $ppr)
    {

    }

    public function BuildThreadBT(Tree $tree)
    {
        $pr = NULL;//@var TreeNode
        if ($tree->root) {

        }
    }

    /**
     * 后序遍历
     * @param TreeNode|NULL $node
     * @param array $res
     * @return array
     */
    private function PostOrd(TreeNode $node = NULL, array &$res = []) :array
    {
        if ($node) {
            $this->PostOrd($node->leftNode, $res);
            $this->PostOrd($node->rightNode, $res);
            array_push($res, $node->element->GetValue());
        }
        return $res;
    }

    /**
     * 后序遍历
     * @return array
     */
    public function PostOrder() :array
    {
        $res = [];
        return $this->PostOrd($this->tree->root, $res);
    }

    /**
     * 计算节点数
     * @param TreeNode|NULL $node
     * @return int
     */
    private function Size(TreeNode $node = NULL) :int
    {
        $size = 0;
        if ($node) {
            $leftSize = $this->Size($node->leftNode);
            $rightSize = $this->Size($node->rightNode);
            $size += 1 + $leftSize + $rightSize;
        }
        return $size;
    }

    /**
     * 计算二叉树几点个数
     * @return int
     */
    public function SizeBT() :int
    {
        return $this->Size($this->tree->root);
    }

    /**
     * 计算二叉树的高度
     * @param TreeNode|NULL $node
     * @return int
     */
    private function Depth(TreeNode $node = NULL) :int
    {
        $depth = 0;
        if ($node) {
            $leftDepth = $this->Depth($node->leftNode);
            $rightDepth = $this->Depth($node->rightNode);
            $depth += 1 + max($leftDepth, $rightDepth);
        }
        return $depth;
    }

    /**
     * 计算二叉树的高度
     * @return int
     */
    public function DepthBT() :int
    {
        return $this->Depth($this->tree->root);
    }

    /**
     * 复制节点
     * @param TreeNode|null $p
     * @return TreeNode|null
     */
    private function Copy(TreeNode $p = NULL) :?TreeNode
    {
        $q = NULL;//TreeNode
        if (!$p) {
            return NULL;
        }
        $q = TreeNode::CreateNode();
        $q->element = Element::getInstance($p->element->GetValue());
        $q->leftNode = $this->Copy($p->leftNode);
        $q->rightNode = $this->Copy($p->rightNode);
        return $q;
    }

    /**
     * 复制树
     * @return Tree
     */
    public function CopyBT() :Tree
    {
        $newTree = Tree::CreateTree();
        $newTree->root = $this->Copy($this->tree->root);
        return $newTree;
    }

}