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

###### 7.不同的子序列（*）

给定一个字符串 s 和一个字符串 t ，计算在 s 的子序列中 t 出现的个数。

字符串的一个 子序列 是指，通过删除一些（也可以不删除）字符且不干扰剩余字符相对位置所组成的新字符串。（例如，"ACE" 是 "ABCDE" 的一个子序列，而 "AEC" 不是）

题目数据保证答案符合 32 位带符号整数范围。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/distinct-subsequences
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

```java
class Solution {
    public int numDistinct(String s, String t) {
        int m = s.length(), n = t.length();
        if (m < n) {
            return 0;//如果s字符串小于t，则t不可能为s的子串
        }
        int[][] dp = new int[m + 1][n + 1];//dp代表t[n:]是s[m:]子串的情况总和数
        for (int i = 0; i <= m; i++) {
            dp[i][n] = 1;//当j为n时，t串为空串，空串是任意串的子串
        }
        for (int i = m - 1; i >= 0; i--) {
            char sChar = s.charAt(i);
            for (int j = n - 1; j >= 0; j--) {
                char tChar = t.charAt(j);//若两个字符相等：1.用这个字符（用完之后，s和t中的字符消失） 2.跳过这个字符（s中的这个字符消失）
                if (sChar == tChar) {
                    dp[i][j] = dp[i + 1][j + 1] + dp[i + 1][j];//用这个字符+跳过这个字符=情况总和数
                } else {
                    dp[i][j] = dp[i + 1][j];//不相等，则只能跳过这个字符
                }
            }
        }
        return dp[0][0];//返回所有情况总和数
    }
}
```

![image-20210317155703572](https://cdn.jsdelivr.net/gh/nanxi1234/nanxi1234.github.io/image/2021/20210317155703.png)

8.数组中重复的数字

在一个长度为 n 的数组 nums 里的所有数字都在 0～n-1 的范围内。数组中某些数字是重复的，但不知道有几个数字重复了，也不知道每个数字重复了几次。请找出数组中任意一个重复的数字。

因为长度为n的数组nums中所有的数字都在0~n-1之间，因此若没有重复数字，则它们排序后应该是01234…；PPT演示如下：
                   https://streamja.com/dmVQp                          

<div id="aliPlayer149" x5-playsinline="" x-webkit-airplay="" playsinline="" webkit-playsinline="" class="prism-player" style="width: 100%; height: 300px;" data-is-ready="true"><video webkit-playsinline="" playsinline="" x-webkit-airplay="" x5-playsinline="" preload="preload" style="width: 100%; height: 100%;" src="blob:https://leetcode-cn.com/0163083b-8eef-4cac-ba41-996ae19783af"></video><div class="prism-big-play-btn" id="aliPlayer149_component_4678AF39-3F59-4B3B-A647-63BBD8B84025" style="position: absolute; left: 30px; bottom: 80px; display: block;"><div class="outter"></div></div><div class="center prism-hide" id="aliPlayer149_component_3FD01FED-C762-4B7F-A4E1-6F37759BB37F"><div class="circle"></div> <div class="circle1"></div></div><div class="prism-ErrorMessage" id="aliPlayer149_component_C62DA436-95EB-4A8E-BD77-1F5A24BC05E7" style="position: absolute; left: 0px; top: 0px;"><div class="prism-error-content"><p></p></div><div class="prism-error-operation"><a class="prism-button prism-button-refresh">刷新</a><a class="prism-button prism-button-retry" target="_blank">重试</a><a class="prism-button prism-button-orange" target="_blank">诊断</a></div><div class="prism-detect-info prism-center"><p class="errorCode"><span class="info-label">code：</span><span class="info-content"></span></p><p class="vid"><span class="info-label">vid:</span><span class="info-content"></span></p><p class="uuid"><span class="info-label">uuid:</span><span class="info-content"></span></p><p class="requestId"><span class="info-label">requestId:</span><span class="info-content"></span></p><p class="dateTime"><span class="info-label">播放时间：</span><span class="info-content"></span></p></div></div><p class="prism-info-display" id="aliPlayer149_component_9AD79385-B90D-4A16-9BAE-FF56D7B144B2" style="float: left; margin-left: 0px; margin-top: 0px;"></p><p class="prism-tooltip" id="aliPlayer149_component_D8789B86-F904-41CE-9943-5ED771BB31F1" style="position: absolute; left: 329px; bottom: 50px; display: none;">音量</p><div class="prism-thumbnail" id="aliPlayer149_component_BB3B81A0-3AAF-4CFA-970C-4E818F176A8E" style="float: left; margin-left: 0px; margin-top: 0px; display: none;"><img><span></span></div><div class="prism-cc-selector prism-setting-selector" id="aliPlayer149_component_3CC03622-2B46-40A6-8716-11DA8E9E45B7" style="float: right; margin-right: 15px; margin-top: 12px;"><div class="header"><div class="left-array"></div><span>字幕</span></div><ul class="selector-list"></ul></div><div class="prism-speed-selector prism-setting-selector" id="aliPlayer149_component_74F0C6DF-23B4-40E3-99BA-C548D62E3F5A" style="float: right; margin-right: 15px; margin-top: 12px;"><div class="header"><div class="left-array"></div><span>倍速</span></div><ul class="selector-list"></ul></div><div class="prism-quality-selector prism-setting-selector" id="aliPlayer149_component_C330610A-788F-4C6F-9830-05294FA06347" style="float: right; margin-right: 15px; margin-top: 12px;"><div class="header"><div class="left-array"></div><span>清晰度</span></div><ul class="selector-list"></ul></div><div class="prism-audio-selector prism-setting-selector" id="aliPlayer149_component_1B638D0C-0C35-4DF5-81EE-C1520CB7E0B4" style="float: right; margin-right: 15px; margin-top: 12px;"><div class="header"><div class="left-array"></div><span>音轨</span></div><ul class="selector-list"></ul></div><div class="prism-setting-list" id="aliPlayer149_component_071BA18C-4EB7-411B-8D73-CBE407340710" style="float: right; margin-right: 15px; margin-top: 12px; display: none;"><div class="prism-setting-item prism-setting-speed" type="speed"><div class="setting-content"><span class="setting-title">倍速</span><span class="array"></span><span class="current-setting">正常</span></div></div><div class="prism-setting-item prism-setting-cc" type="cc"><div class="setting-content"><span class="setting-title">字幕</span><span class="array"></span><span class="current-setting">Off</span></div></div><div class="prism-setting-item prism-setting-audio" type="audio"><div class="setting-content"><span class="setting-title">音轨</span><span class="array"></span><span class="current-setting"></span></div></div><div class="prism-setting-item prism-setting-quality" type="quality"><div class="setting-content"><span class="setting-title">清晰度</span><span class="array"></span><span class="current-setting"></span></div></div></div><div class="prism-volume-control" id="aliPlayer149_component_206A2323-D6F2-4CC8-A3C6-4B4B6F1E7EF0" style="float: right; margin-right: 5px; margin-top: 10px; display: none;"><div class="volume-range"><div class="volume-value"></div><div class="volume-cursor"></div></div></div><div class="prism-controlbar" id="aliPlayer149_component_9B4B9194-6C7B-418B-BFF3-6718CA75B6E3" style="display: none; position: absolute; left: 0px; bottom: 0px;"><div class="prism-controlbar-bg"></div><div class="prism-progress" id="aliPlayer149_component_C10CA5A3-136F-47E4-B184-0A6F4B10F746" style="position: absolute; left: 0px; bottom: 44px;"><div class="prism-progress-loaded" style="width: 7.91732%;"></div><div class="prism-progress-played"></div><div class="prism-progress-marker"></div><div class="prism-progress-cursor" style="display: none; right: auto; left: 0%;"><img src="https://g.alicdn.com/de/prismplayer/2.8.7/skins/default/img/dragcursor.png"></div><p class="prism-progress-time"></p></div><div class="prism-play-btn" id="aliPlayer149_component_CD6C606E-E858-4441-A295-E71928A6F14D" style="float: left; margin-left: 15px; margin-top: 12px;"></div><div class="prism-time-display" id="aliPlayer149_component_03AD899D-1402-48AA-B9AB-B92D0AECC081" style="float: left; margin-left: 10px; margin-top: 5px;"><span class="current-time">00:00</span> <span class="time-bound" style="display: inline;">/</span> <span class="duration" style="display: inline;">06:44</span></div><div class="prism-fullscreen-btn" id="aliPlayer149_component_97FD6F19-9636-4347-AFC7-4091C353011B" style="float: right; margin-right: 10px; margin-top: 12px;"></div><div class="prism-cc-btn" id="aliPlayer149_component_8EFE7B0C-ECB1-4806-88BB-50F9297201F8" style="float: right; margin-right: 15px; margin-top: 12px;"></div><div class="prism-setting-btn" id="aliPlayer149_component_09DC13E6-E424-42F6-B94D-7FDA33F2A7A3" style="float: right; margin-right: 15px; margin-top: 12px;"></div><div class="prism-volume" id="aliPlayer149_component_F59F18FA-CF8C-4BD9-A428-E3D2DB082448" style="float: right; margin-right: 5px; margin-top: 10px;"><div class="volume-icon"><div class="short-horizontal"></div><div class="long-horizontal volume-hover-animation"></div></div></div></div><div class="prism-cover" id="aliPlayer149_component_2789DABB-7342-4C55-9DBF-D2C4850016F5" style="background-image: url(&quot;https://video.leetcode-cn.com/image/cover/49B428C02FEB413E8D17F1AECDA31A39-6-2.png&quot;); float: left; margin-left: 0px; margin-top: 0px;"></div><div class="prism-animation" id="aliPlayer149_component_2F351989-CFD2-4839-A1F1-3FAA97A9BD56" style="float: left; margin-left: 0px; margin-top: 0px;"></div><div class="prism-auto-stream-selector" id="aliPlayer149_component_06D3170E-077B-479E-AE74-0A8E957A9E82" style="float: left; margin-left: 0px; margin-top: 0px;"><div><p class="tip-text"></p></div><div class="operators"><a class="prism-button prism-button-ok" type="button">确认</a><a class="prism-button prism-button-cancel" target="_blank">取消</a></div></div><div class="prism-marker-text" id="aliPlayer149_component_D879449D-38B6-40FF-8703-A2F2D09F543D" style="float: left; margin-left: 0px; margin-top: 0px;"><p></p></div></div>