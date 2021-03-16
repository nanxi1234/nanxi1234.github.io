---
date: 2021-3-14 16:10:40
layout: post
title: LeetCode题目总结
author: 
---



###### 1.下一个更大的元素

描述：

  给你两个 没有重复元素 的数组 nums1 和 nums2 ，其中nums1 是 nums2 的子集。

请你找出 nums1 中每个元素在 nums2 中的下一个比其大的值。

nums1 中数字 x 的下一个更大元素是指 x 在 nums2 中对应位置的右边的第一个比 x 大的元素。如果不存在，对应位置输出 -1 。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/next-greater-element-iclass 
  <center><img src="https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210314140346.png" alt="image-20210313225004520" style="zoom:50%;" ></center>

######  2.两数相加

给你两个 非空 的链表，表示两个非负的整数。它们每位数字都是按照 逆序 的方式存储的，并且每个节点只能存储 一位 数字。

请你将两个数相加，并以相同形式返回一个表示和的链表。

你可以假设除了数字 0 之外，这两个数都不会以 0 开头。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/add-two-numbers
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

<center><img src="https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210313225706.png" alt="image-20210313225706230" style="zoom:50%;" ></center>





思路：将倒序的链表1和2的数顺序取出，求和(注意进位)后添加到新链表的尾端



<center><img src="https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210313225737.png" alt="image-20210313215454214" style="zoom:50%;"  /></center>

###### 3.设计哈希集合

不使用任何内建的哈希表库设计一个哈希集合（HashSet）。

实现 MyHashSet 类：

void add(key) 向哈希集合中插入值 key 。
bool contains(key) 返回哈希集合中是否存在这个值 key 。
void remove(key) 将给定值 key 从哈希集合中删除。如果哈希集合中没有这个值，什么也不做。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/design-hashset
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

```java
class MyHashSet {

  private static final int BASE = 769;

  private LinkedList[] data;//定义变量

  /** Initialize your data structure here. */

  public MyHashSet() {//构造函数

    data = new LinkedList[BASE];//数组

   for (int i = 0; i < BASE; ++i) {

      data[i] = new LinkedList<Integer>();//数组的每个位置是一个链表

    }

  }

  public void add(int key) {

    int h = hash(key);//软缓存，将每个键的散列值（数组索引值）存储在h变量中

    Iterator<Integer> iterator = data[h].iterator();//根据散列值作为数组索引，遍历此处的链表，并在尾部插入

    while (iterator.hasNext()) {

     Integer element = iterator.next();
      
      if (element == key) {

        return;//如果链表中已存在，则退出方法（哈希表不允许有相同元素存在）

      }

    }

    data[h].offerLast(key);//链表尾部插入元素

  }

  public void remove(int key) {

    int h = hash(key);

    Iterator<Integer> iterator = data[h].iterator();

    while (iterator.hasNext()) {

      Integer element = iterator.next();

      if (element == key) {

        data[h].remove(element);

        return;

      }

    }

  }

  /** Returns true if this set contains the specified element */

  public boolean contains(int key) {

    int h = hash(key);

    Iterator<Integer> iterator = data[h].iterator();

    while (iterator.hasNext()) {

      Integer element = iterator.next();

      if (element == key) {

        return true;

      }

    }

    return false;

  }

  private static int hash(int key) {

    return key % BASE;//键值转换成哈希值作为数组的索引

  }

}
```

###### 4.螺旋矩阵

给你一个 `m` 行 `n` 列的矩阵 `matrix` ，请按照 **顺时针螺旋顺序** ，返回矩阵中的所有元素。

![image-20210315121415357](https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210315121422.png)

```java
class Solution {

  public List<Integer> spiralOrder(int[][] matrix) {

  LinkedList<Integer> result=new LinkedList<>();

  if(matrix==null||matrix.length==0) return result;

  int top=0;

  int left=0;

  int right=matrix[0].length-1;

  int bottom=matrix.length-1;

  int vals=matrix.length*matrix[0].length;

  while(vals >= 1)

  {

    for(int k=left;k <= right && vals >= 1;k++)

    {

      result.add(matrix[top][k]); 

      vals--;

    }

    top++;

     for(int k=top;k <= bottom && vals >= 1;k++)

   {

     result.add(matrix[k][right]); 

      vals--; 

    }

    right--;

     for(int k=right;k >= left && vals >= 1;k--)

    {

      result.add(matrix[bottom][k]);

       vals--; 

    }

    bottom--;

     for(int k=bottom;k >= top && vals >= 1;k--)

    {

      result.add(matrix[k][left]); 

       vals--; 

    }

    left++;



  }

  return result;

  }

}
```

###### 5.删除链表的倒数第N个节点

给你一个链表，删除链表的倒数第 `n` 个结点，并且返回链表的头结点。

在对链表进行操作时，一种常用的技巧是添加一个哑节点（dummy node），它的 next 指针指向链表的头节点。这样一来，我们就不需要对头节点进行特殊的判断了

解法一：将链表入栈，再出栈，此时第n个出栈的就是要删除的结点

解法二：快慢指针，指针first先遍历到n，second指针再开始遍历，当first指针到达链表的结尾时，second到达所要删除的结点所在。

- 解法一：

  ```java
  class Solution {
  
    public ListNode removeNthFromEnd(ListNode head, int n) {
  
    ListNode dummy=new ListNode(0,head);
  
    Deque<ListNode> stack=new LinkedList<ListNode>();
  
    ListNode cur=dummy;//cur存储对dummy的引用
  
    while(cur != null)
  
    {
  
      stack.push(cur);
  
      cur=cur.next;
  
    }
  
    for(int i=0;i<n;i++)
  
    { 
      stack.pop();
    }
  
    ListNode mubiao=stack.peek();
  
    mubiao.next=mubiao.next.next;
  
    ListNode ans=dummy.next;
  
    return ans;
  
  }
  
  }
  ```

  

- 解法二：

```java
/**

 \* Definition for singly-linked list.

 \* public class ListNode {

 \*   int val;

 \*   ListNode next;

 \*   ListNode() {}

 \*   ListNode(int val) { this.val = val; }

 \*   ListNode(int val, ListNode next) { this.val = val; this.next = next; }

 \* }

 */

class Solution {

  public ListNode removeNthFromEnd(ListNode head, int n) {

  ListNode dummy=new ListNode(0,head);

  ListNode first=head;

  ListNode second=dummy;//因为dummy是head的前一个结点

  //因此head到链表结尾时，dummy在要删除结点的前一个结点

  for(int i=0;i<n;i++)

  {

   first=first.next;

  }

  while(first != null)

  {

  second=second.next;

  first=first.next;

  }

   second.next=second.next.next;//second结点位于所要删除结点的上一个结点

  ListNode ans=dummy.next;

  return ans;



}

}
```



###### 6.螺旋数组II

给你一个正整数 `n` ，生成一个包含 `1` 到 `n2` 所有元素，且元素按顺时针顺序螺旋排列的 `n x n` 正方形矩阵 `matrix` 

```java
class Solution {

  public int[][] generateMatrix(int n) {

   int[][] res=new int[n][n];

   int left=0;

   int top=0;

   int right=n-1;

   int bottom=n-1;

   int index=1;

while(index <= n*n)

{

  for(int j=left;j<=right;j++)

  {

   res[top][j]=index++;//因为元素从1--n*n，所以可以用index++代表数据

  }

  top++;

  for(int j=top;j<=bottom;j++)

  {

   res[j][right]=index++;  

  }

  right--;

  for(int j=right;j>=left;j--)

  {

   res[bottom][j]=index++;  

  }

  bottom--;

  for(int j=bottom;j>=top;j--)

  {

   res[j][left]=index++;  

  }

  left++;



}

  return res;

  }

}
```

