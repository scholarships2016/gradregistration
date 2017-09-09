<?PHP 

function listFolderFiles($dir){
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);
	$path = "";
    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;
	
    echo '<ol>';
    foreach($ffs as $ff){
		$path = 'http://10.9.152.43/'.$dir.'/'.$ff; 
		
		if(strpos($path,"html")){
			echo '<li><a href="'.$path.'" target="_blank">'.$ff.'</a>';
		}else{
			echo '<li>'.$ff.'';
		}
		
        if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
        echo '</li>';
		$path="";
    }
    echo '</ol>';
}

?>
<html>
<head>
<style type="text/css">
li{
	padding-left: 20px;	
}

</style>
</head>
<body>
<?PHP 
echo "<h4>Thai Version</h4>";
listFolderFiles('th');
echo "<hr/><h4>English Version</h4>";
listFolderFiles('en');

?>
</body>
</html>