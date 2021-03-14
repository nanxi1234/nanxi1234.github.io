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

