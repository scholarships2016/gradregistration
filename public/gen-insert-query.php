<?PHP 

for($i=5 ;$i <= 234 ;$i++){
	
	for($j=1 ; $j<=6 ;$j++){
		echo "insert into user_permission(user_id, permission_id) values({$i}, {$j});<br>";		
	}
	
}





?>