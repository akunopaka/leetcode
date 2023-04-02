### 142. Linked List Cycle II

Medium

https://leetcode.com/problems/linked-list-cycle-ii/

### My Solution

##### JavaScript

```js
var detectCycle = function (head) {
    let s = head; // slow pointer
    let f = head; // fast pointer
    while (f && f.next && f.next.next) {
        s = s.next;
        f = f.next.next;
        if (s === f) {
            while (s !== head) {
                head = head.next;
                s = s.next;
            }
            return s;
        }
    }
    return null;
};
```

##### PHP

```php
function detectCycle1($head) {
    $fast = $head; // fast pointer
    $slow = $head; // slow pointer
    while ($fast && $fast->next)
    {
        $slow = $slow->next;
        $fast = $fast->next->next;
        if($fast === $slow){
            while ($head!==$slow){
                $head = $head->next;
                $slow = $slow->next;
            }
            return $slow;
        }
    }
    return null;
}
```
