<?php
include 'config.php';
include 'lcs.php';
include 'multisort.php';
if(isset($_GET['s']))
$search=$_GET['s'];
else
$search="viv";
$dissimilarity=40;
$max_search_length=100;
$search=strtolower($search);
$search_columns=array("userid","first_name","last_name","school_name");
$other_columns=array("SNo","profile_photo","nickname","school_class","likes","profile_headline","profile_caption","profile_subtitle");
$column_count=count($search_columns);
$query=mysql_query("SELECT * FROM `users`");
$allusers=array();
$i=0;
while($row=mysql_fetch_array($query))
{
foreach($other_columns as $col)
{
$allusers[$i][$col]=$row[$col];
}
foreach($search_columns as $col)
{
$allusers[$i][$col]=$row[$col];
$allusers[$i][$col."_comp"]= strpos(strtolower($allusers[$i][$col]),$search)===false?$max_search_length:strpos(strtolower($allusers[$i][$col]),$search);
$allusers[$i][$col."_leven"]=$max_search_length-get_lcs(strtolower($allusers[$i][$col]),$search,$percent);
}
$i++;
}
$sortCriteria =array();
for($i=0;$i<$column_count;$i++)
$sortCriteria[$search_columns[$i]."_comp"]=array(SORT_ASC, SORT_NUMERIC);
for($i=0;$i<$column_count;$i++)
$sortCriteria[$search_columns[$i]."_leven"]=array(SORT_ASC, SORT_NUMERIC);
$sortedData = MultiSort($allusers, $sortCriteria, true);
$m=0;
foreach($sortedData as $val)
{
	$cnt=0;
	$userdata="";
	for($i=0;$i<$column_count;$i++)
	{
		$userdata=$userdata.", ".$val[$search_columns[$i]];
		if($val[$search_columns[$i]."_comp"]!=$max_search_length || $val[$search_columns[$i]."_leven"]<$dissimilarity)
			$cnt++;
	}
	if($cnt==0)
	unset($sortedData[$m]);
	$m++;
}
$sortedData = array_values($sortedData);
echo count($sortedData);
?>