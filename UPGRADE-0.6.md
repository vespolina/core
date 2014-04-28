Upgrade from 0.5 to 0.6
=======================

Option
------

 * Option upchanges have been removed. Any price variations should be set using variations. The `value` property and 
   corresponding methods have been changed to `index`

   Before:

   ```
   public function setValue($value);
   public function getValue();
   ```
   
   After:
   
   ```
   public function setIndex($index);
   public function getIndex();
   ```
