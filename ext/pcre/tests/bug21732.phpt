--TEST--
Bug #21732 (preg_replace() segfaults with invalid parameters)
--FILE--
<?php
class foo {
	function cb($param) {
		var_dump($param);
		return "yes!";
	}
}

try {
    var_dump(preg_replace('', array(), ''));
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}
var_dump(preg_replace_callback("/(ab)(cd)(e)/", array(new foo(), "cb"), 'abcde'));
?>
--EXPECT--
Parameter mismatch, pattern is a string while replacement is an array
array(4) {
  [0]=>
  string(5) "abcde"
  [1]=>
  string(2) "ab"
  [2]=>
  string(2) "cd"
  [3]=>
  string(1) "e"
}
string(4) "yes!"
