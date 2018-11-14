<?php

/*
      spreadsheet.php:
      Source csv file has all genres in one column. 
      We need to split them out over 5 columns. 
      Since commas are used inside the column content, 
      convert csv to pipe delimited, then explode 
      each row into an array of columns. 
      Takes first Theme column and writes up to 5 
      column values. Quotes all the content and 
      writes back to a CSV file.
      DT: 11/13/18
*/



if ($fh = fopen('all_videographies_piped.csv', 'r')) {
   $newFile = fopen("quotes.csv", "w") or die("Unable to open file");
 while (!feof($fh)) {
   $line = fgets($fh);
   $pieces = explode("|", $line);
   $themes = explode(",", $pieces[4]);
   
   $pieces[4] = $themes[0];
   $pieces[5] = $themes[1];
   $pieces[6] = $themes[2];
   $pieces[7] = $themes[3];
   $pieces[8] = $themes[4];

   // write updated line to new file
   $txt = "";
   foreach ($pieces as $piece) {
    $quotedPiece = "";
    if ($piece[0] == '"') {
     $txt .= trim($piece);
    } else {
     $txt .= '"' . trim($piece) . '"';
    }
    // add comma at end of each loop to create csv elements
    $txt .= ",";
  }
   // get rid of last comma added in foreach loop
   $trimmedTxt = rtrim($txt,",");
   $trimmedTxt .= "\n";
   fwrite($newFile, $trimmedTxt);
 }
}

 fclose($newFile);
 fclose($fh);

?>
