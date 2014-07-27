<?php
function LCS_Length($s1, $s2) 
{ 
  $m = strlen($s1); 
  $n = strlen($s2); 
  $LCS_Length_Table = array(array(128),array(128)); 
  for($i=1; $i < $m; $i++) $LCS_Length_Table[$i][0]=0; 
  for($j=0; $j < $n; $j++) $LCS_Length_Table[0][$j]=0; 
  for ($i=1; $i <= $m; $i++) { 
    for ($j=1; $j <= $n; $j++) { 
      if ($s1[$i-1]==$s2[$j-1]) 
        $LCS_Length_Table[$i][$j] = $LCS_Length_Table[$i-1][$j-1] + 1; 
      else if ($LCS_Length_Table[$i-1][$j] >= $LCS_Length_Table[$i][$j-1]) 
        $LCS_Length_Table[$i][$j] = $LCS_Length_Table[$i-1][$j]; 
      else 
        $LCS_Length_Table[$i][$j] = $LCS_Length_Table[$i][$j-1]; 
    } 
  } 
  return $LCS_Length_Table[$m][$n]; 
}
function get_lcs($s1, $s2) 
{ 
  $s1 = strtolower($s1); 
  $s2 = strtolower($s2); 
  $lcs = LCS_Length($s1,$s2);
  $ms = (strlen($s1) + strlen($s2)) / 2; 
  return (($lcs*100)/$ms); 
}
?>