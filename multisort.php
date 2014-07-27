<?php
function MultiSort($data, $sortCriteria, $caseInSensitive = true)
{
  if( !is_array($data) || !is_array($sortCriteria))
    return false;       
  $args = array(); 
  $i = 0;
  $j=0;
  foreach($sortCriteria as $sortColumn => $sortAttributes)  
  {
    $colList = array(); 
	//echo $sortColumn."<br/>";
    foreach ($data as $key => $row)
    { 
		//echo $key;
      $convertToLower = $caseInSensitive && (in_array(SORT_STRING, $sortAttributes) || in_array(SORT_REGULAR, $sortAttributes)); 
      $rowData = $convertToLower ? strtolower($row[$sortColumn]) : $row[$sortColumn]; 
      $colList[$sortColumn][$key] = $rowData;
    }
    $args[] = &$colList[$sortColumn];
      
    foreach($sortAttributes as $sortAttribute)
    {      
      $tmp[$i] = $sortAttribute;
      $args[] = &$tmp[$i];
      $i++;      
     }
  }
  $args[] = &$data;
  call_user_func_array('array_multisort', $args);
  return end($args);
} 
?>