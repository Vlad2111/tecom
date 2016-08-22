<?php
include_once 'LdapOperationsTest.php';

$LDAP = new LdapOperationsTest();
$LDAP->connect();

$names = array(
		
);
$Q=0;
foreach ($names as $key=>$array){
	if ($names[$key]!=$names[$key-1]){
		$Q=$Q+1;
		echo $Q.$names[$key]."\n";
		$result = $LDAP->getLDAPAccountNamesByFullName($array);
		print_r($result);
		if ($result == null){
			$error[$key] = $array;
		}
	}
}
echo "/*/ERRORS/*/\n";
print_r($error);
?>