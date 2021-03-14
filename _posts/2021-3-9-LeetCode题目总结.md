---
date: 2020-11-02 16:10:40
layout: post
title: LeetCode题目总结
author: 张朝晖
---



###### 1.下一个更大的元素

描述：

  给你两个 没有重复元素 的数组 nums1 和 nums2 ，其中nums1 是 nums2 的子集。

请你找出 nums1 中每个元素在 nums2 中的下一个比其大的值。

nums1 中数字 x 的下一个更大元素是指 x 在 nums2 中对应位置的右边的第一个比 x 大的元素。如果不存在，对应位置输出 -1 。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/next-greater-element-iclass Solution {

  

<div align=center><img src="https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210313225718.png" alt="image-20210313225004520" style="zoom:50%;" />

######  2.两数相加

给你两个 非空 的链表，表示两个非负的整数。它们每位数字都是按照 逆序 的方式存储的，并且每个节点只能存储 一位 数字。

请你将两个数相加，并以相同形式返回一个表示和的链表。

你可以假设除了数字 0 之外，这两个数都不会以 0 开头。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/add-two-numbers
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

<div align=center><img src="https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210313225706.png" alt="image-20210313225706230" style="zoom:50%;" />


思路：将倒序的链表1和2的数顺序取出，求和(注意进位)后添加到新链表的尾端



<div align=center><img src="https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210313225737.png" alt="image-20210313215454214" style="zoom:50%;"  />

