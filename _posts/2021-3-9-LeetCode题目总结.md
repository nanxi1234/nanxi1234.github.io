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

在一个长度为 n 的数组 nums 里的所有数字都在 0-n-1 的范围内。数组中某些数字是重复的，但不知道有几个数字重复了，也不知道每个数字重复了几次。请找出数组中任意一个重复的数字。

因为长度为n的数组nums中所有的数字都在0-n-1之间，因此若没有重复数字，则它们排序后应该是01234…；PPT演示如下：

<div id="cincopa_84f53d">...</div><script type="text/javascript">
var cpo = []; cpo["_object"] ="cincopa_84f53d"; cpo["_fid"] = "AMMAoxu8dKXm";
var _cpmp = _cpmp || []; _cpmp.push(cpo);
(function() { var cp = document.createElement("script"); cp.type = "text/javascript";
cp.async = true; cp.src = "https://rtcdn.cincopa.com/libasync.js";
var c = document.getElementsByTagName("script")[0];
c.parentNode.insertBefore(cp, c); })(); </script>

- 遍历数组a[i],若a[i] != i则a[i]与a[a[i]]互换
- 若a[i]=a[a[i]],则说明数字重复，return a[i]即可

```java
class Solution {//一个萝卜一个坑算法

  public int findRepeatNumber(int[] nums) {

    int temp;

    for(int i=0;i<nums.length;i++){

      while (nums[i]!=i){

        if(nums[i]==nums[nums[i]]){

         return nums[i];

        }

        temp=nums[i];

        nums[i]=nums[temp];

        nums[temp]=temp;

      }

    }

    return -1;

  }

}
```

###### 9.132模式

<div id="cincopa_c81005">...</div><script type="text/javascript">
var cpo = []; cpo["_object"] ="cincopa_c81005"; cpo["_fid"] = "AQAAsze7imsi";
var _cpmp = _cpmp || []; _cpmp.push(cpo);
(function() { var cp = document.createElement("script"); cp.type = "text/javascript";
cp.async = true; cp.src = "https://rtcdn.cincopa.com/libasync.js";
var c = document.getElementsByTagName("script")[0];
c.parentNode.insertBefore(cp, c); })(); </script>

从a[n-1]开始入栈，维护这个栈为单调递减栈，若入栈的a[i]>stack.peek(),则不断弹出栈顶，直到a[i]<stack.peek(),a[i]入栈，若a[i]<k则有132模式，栈里面保证有一个数大于k=stack.pop()不然它也不会被弹出去

```java
class Solution {    
    public boolean find132pattern(int[] nums) {
        int len = nums.length;        
        Stack<Integer> deque = new Stack<>();        
        deque.push(nums[len-1]);        
        int k = Integer.MIN_VALUE;        
        for(int i = len-2; i >=0;i--){
            if(nums[i] < k){                
                return true;
            }            
            while (!deque.isEmpty() &&  nums[i] > deque.peek())
            {
                k = deque.pop();            
            }            
            deque.push(nums[i]);        
            }       
        return false;    
             } 
             }
```

###### 10. 最长重复子串（滑动窗口）

  一个重复字符串是由两个相同的字符串首尾拼接而成，例如abcabc便是长度为6的一个重复字符串，而abcba则不存在重复字符串。 

  给定一个字符串，请编写一个函数，返回其最长的重复字符子串。 

  若不存在任何重复字符子串，则返回0。

如：输入：ababc

​        输出：4







##### 11.拼硬币（动态规划）

```java
package Dynamicprogramming;
public class CoinDemo {
    public static int CoinChange(int[] A, int target) {
        int[] dp = new int[target + 1];
        int n = A.length;
        dp[0] = 0;//初始化
        for (int i = 1; i < target + 1; i++) {
            dp[i] = Integer.MAX_VALUE;//先给他一个最大的值，如果后面有更好的值，再取更好的值
            for (int j = 0; j < n; j++) {
                if (i >= A[j] && dp[i - A[j]] != Integer.MAX_VALUE) {//要拼的目标值大于最后一个面额的钱，且拼的出来
                    dp[i] = Math.min(dp[i - A[j]] + 1, dp[i]);
                }
            }
        }
        if (dp[target] == Integer.MAX_VALUE) {
            return -1;//到死没拼出来
        }
        return dp[target];
    }
}
class TestDemo{
    public static void main(String[] args) {
        int[] nums={1,2,5};
        int target=11;
       System.out.println(CoinDemo.CoinChange(nums,target));
    }
}
```

##### 12.找出第N个丑数

```java
package Dynamicprogramming;
//找出第N个的丑数
class UglyNumber {
    public static int FindUglyNumber(int n){
        int[] dp = new int[n + 1];
        dp[1] = 1;
        int p2 = 1, p3 = 1, p5 = 1;
        for (int i = 2; i <= n; i++) {
            int num2 = dp[p2] * 2, num3 = dp[p3] * 3, num5 = dp[p5] * 5;
            dp[i] = Math.min(Math.min(num2, num3), num5);//转移方程
            if (dp[i] == num2) {
                p2++;
            }
            if (dp[i] == num3) {
                p3++;
            }
            if (dp[i] == num5) {
                p5++;
            }
        }
        return dp[n];
    }

}
class TestDemo1{
    public static void main(String[] args) {
        int N=11;
        System.out.println(MUglyNumber.FindUglyNumber(N));
    }
}
```

##### 13.存在重复元素III

给你一个整数数组 nums 和两个整数 k 和 t 。请你判断是否存在 两个不同下标 i 和 j，使得 abs(nums[i] - nums[j]) <= t ，同时又满足 abs(i - j) <= k 。

如果存在则返回 true，不存在返回 false。

```java
class Solution {

  public boolean containsNearbyAlmostDuplicate(int[] nums, int k, int t) {

  int N=nums.length;

    if(N==0 || N==1) 

    {return false;}

    else if(N-1<=k)

    {

    for(int i=0;i<N-1;i++)

    {

     for(int j=i+1;j<N;j++)

     {

      if(absdemo(nums[i],nums[j])<=t)

     {

       return true;

    }

     } 

      }

   }

    else if(N-1>k)

  {

    for(int i=0;i<N-k;i++)

    {

      for(int j=i+1;j<i+k+1;j++)

      {

        if(absdemo(nums[i],nums[j])<=t)

     {

       return true;

     }

      }

    } 
    for(int a=N-k;a<N-1;a++)

    {

      for(int b=a+1;b<N;b++)

      {
       if(absdemo(nums[a],nums[b])<=t)

       {

       return true;

       }

      }

    }

    }

       return false;

}

public long absdemo(int x,int y)

{ 

  long a=x,b=y;

  long res=a-b;

  if(res<0)

  {
  return b-a;
   }

  return a-b;
     }

 }
```

以上代码超出时间限制，时间复杂度为NK，空间复杂度为1.

- 因此我们希望能够找到一个数据结构维护滑动窗口内的元素，该数据结构需要满足以下操作：

- 支持添加和删除指定元素的操作，否则我们无法维护滑动窗口；

内部元素有序，支持二分查找的操作，这样我们可以快速判断滑动窗口中是否存在元素满足条件，具体而言，对于元素 xx，当我们希望判断滑动窗口中是否存在某个数 yy 落在区间 [x - t, x + t][x−t,x+t] 中，只需要判断滑动窗口中所有大于等于 x - t 的元素中的最小元素是否小于等于 x + t 即可。

用有序集合来支持这些操作：

什么是TreeSet？

#####  1486.数组异或操作

给你两个整数，n 和 start 。

数组 nums 定义为：nums[i] = start + 2*i（下标从 0 开始）且 n == nums.length 。

请返回 nums 中所有元素按位异或（XOR）后得到的结果。

##### 474. 一和零

给你一个二进制字符串数组 strs 和两个整数 m 和 n 。

请你找出并返回 strs 的最大子集的大小，该子集中 最多 有 m 个 0 和 n 个 1 。

如果 x 的所有元素也是 y 的元素，集合 x 是集合 y 的 子集 。

三维dp数组：一维是strs中的元素个数，另外两维是0和1的个数

```java
class Solution {
  public int findMaxForm(String[] strs, int m, int n) {
      int l=strs.length;
      int[] cur=new int[2];
      int zero=0,one=0;
     int[][][] dp=new int[l+1][m+1][n+1];
     //对于strs中的每一个元素只有选与不选的决策，选与不选与否主要看选了能否能构成最优解：满足条件的最优子集
      for(int L=1;L<l+1;L++)
      {
        cur=zeroone(strs[L-1]);
       zero=cur[0];one=cur[1];
        for(int M=0;M<m+1;M++)
        {
          for(int N=0;N<n+1;N++)
          {
            dp[L][M][N]=dp[L-1][M][N];
            //对于dp[L][M][N],对于第L个元素,选了与没选一比，看谁大决定选不选
            if(M-zero>=0 && N-one>=0)//能选的情况
            {
            dp[L][M][N]=Math.max(dp[L-1][M-zero][N-one]+1,dp[L][M][N]);
            }
          }
        }
      }
      return dp[l][m][n];
    }
    public int[] zeroone(String a){
      int N=a.length();
      int[] zeroandone=new int[2];
      for(int i=0;i<N;i++)
      {
          zeroandone[a.charAt(i)-'0']++; 
        }
        return zeroandone;
      } 
    }
```

##### 1239.串联字符串的最大长度

给定一个字符串数组 arr，字符串 s 是将 arr 某一子序列字符串连接所得的字符串，如果 s 中的**每一个字符都只出现过一次，那么它就是一个可行解**。

请返回所有可行解 s 中最长长度

- 计算可行解的长度：构成可行解的每一个字符串可以视为一个字符集合，且集合不含重复元素。
- 用二进制表示该字符串的字符集合，二进制的第i位为1表示字符集合中含有第i个小写字母。为0表示字符集合中不含有第i个小写字母。

- 遍历arr，从中筛选出无重复字母的字符串，将其对应的二进制加入一维数组，记作masks。

回溯法：

- backtrack(pos,mask)表示递归的函数，其中Pos表示递归到了数组masks中第pos个数，mask表示当前连接得到的字符串对应二进制数为mask；
- 对于第pos个数：选或者不选，
- 选：如果连接得到的mask和masks[pos]无公共元素，则可以选这个数，此时调用back(pos+1,mask|masks[pos])进行递归，如果不选则backtrack(pos+1,mask)
- 记masks的长度为n，当pos=n时，计算mask中1的个数，即为可行解的长度。





###### 字节面试题

```java
public  static int findMaxSum(int[] time,int[] nums){
    int N = nums.length;
    if(N == 0) return 0;
    int pos =0;
    long max = nums[0];
    long res = 0;//初始化
    //对nums数组求一个前缀和
    for(int i = 1;i<N;i++) {
        nums[i] += nums[i - 1];
    }
    for(int i = 1;i<N;i++){
        if(time[i]-time[i-1] > 3) {//左边没有比它大的数
            res = nums[i]-nums[i-1];
            max = Math.max(res,max);
        }
        if(time[i]-time[0]<=3){//左边全比它小
           // res = nums[i];
            res = findMaxArray(nums,0,i);
            res = Math.max(res,nums[i]);
            max = Math.max(res,max);
        }
          //在0~i-1查找，找到一个值，res = nums[i] - nums[mid - 1]
        else {//要找的数在左边的某个位置，由于time是有序的，用二分查找即可
            int lo = 0, hi = i-1;
            while (hi > lo) {
                int mid = lo + 1+((hi - lo) >> 1);
                if (time[i] - time[mid] > 3) {
                    lo = mid;
                }
                if (time[i] - time[mid] <= 3) {
                    hi = mid-1;
                }
            }
            res = findMaxArray(nums,lo,i);
            max = Math.max(res, max);
        }
    }
    return (int)max;
}
 public static int findMaxArray(int[] nums,int a,int b)
 {
     int max = Integer.MIN_VALUE;
     for(int i = b-1;i>=a;i--){
         max =  Math.max(nums[b]-nums[i],max);

     }
     return max;
 }
```

###### 105.从前序与中序遍历序列构造二叉树

- 变形：从前序与中序遍历序列输出后序遍历

```java
public class Testnums {
    static Map<Integer,Integer> map = new HashMap<>();
    static int[] res;static int count = 0;
    private static int N;
    public static int[] Testmyquest(int[] pre, int[] in){
        N = pre.length;
        res = new int[N];
        for(int i = 0;i<N;i++){
            map.put(in[i],i);
        }
        dfs(0,0,N-1,pre);
        return res;
    }
    public static void dfs(int root,int start,int end,int[] pre){
        if(start>end) return;
        int index = map.get(pre[root]);
        dfs(root+1,start,index-1,pre);
        dfs(root+1 + index - start,index+1,end,pre);
        res[count++] = pre[root];
    }
    public static void main(String[] args) {
        int pre[] = {1, 2, 3, 4, 5, 6};
        int in[] = {3, 2, 4, 1, 6, 5};
        Testmyquest(pre,in);
        for(int i = 0;i<N;i++){
            System.out.println(res[i]);
        }
        }
    }
```
