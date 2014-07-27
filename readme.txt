To use this script:
- edit the config.php to connect with your database
edit the following in closest-search.php


$dissimilarity=40; // % of dissimilarity allowed to include in search results
$max_search_length=100; // assumption of maximum search term length
$search_columns=array("userid","first_name","last_name","school_name"); // database column names which are to be searched
$other_columns=array("SNo","profile_photo","nickname","school_class","likes","profile_headline","profile_caption","profile_subtitle"); // other column names which are to be included in the sortedarray($sortedData)

- finally the search results are stored in $sortedData