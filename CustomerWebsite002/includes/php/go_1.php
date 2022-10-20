<?
// Category go subpage

$content = "<h1>Pizza & reštaurácia</h1>";

$content .= "<h2>Na stiahnutie</h2>";
$content .= "<p><a target='_blank' href='downloads/AriJedalnyListokWeb.pdf'><img alt='' border='0' src='images/pdf.gif'>Jedálny lístok</a>";
//$content .= "<p><a target='_blank' href='downloads/AriJedalnyListokWeb.pdf'><img alt='' border='0' src='images/pdf.gif'>Jedálny lístok</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target='_blank' href='downloads/rl_2014.pdf'><img alt='' border='0' src='images/pdf.gif'>Rozvozový lístok</a>";
$content .= "<h2>Fotogaléria</h2>";

$imglist='';

  //$img_folder is the variable that holds the path to the banner images. Mine is images/tutorials/
// see that you don't forget about the "/" at the end 
 $img_folder = "images/go_1_pix/";
 $thumb_folder = "images/go_1_thumbs/";

//  mt_srand((double)microtime()*1000);

  //use the directory class
 $imgs = dir($img_folder);

  //read all files from the  directory, checks if are images and ads them to a list (see below how to display flash banners)
 while ($file = $imgs->read()) {
   if (eregi("gif", $file) || eregi("jpg", $file) || eregi("png", $file))
     $imglist .= "$file ";

 } closedir($imgs->handle);

  //put all images into an array
 $imglist = explode(" ", $imglist);
 //$imglist = uasort($imglist);

$num = count($imglist)-1;
//display image
$content .= '<table BORDER=0 CELLPADDING=5 CELLSPACING=0><tr>';
$y = 0; 
for ($i = 0; $i < $num; $i++) { 
$content .=  '<td><a rel="lightbox[roadtrip]" href="'.$img_folder.$imglist[$i].'"><img alt="" width="130" src="'.$thumb_folder.$imglist[$i].'" border="0"></a></td>';
  $y++;
  if ($y == 3 AND $i < ($num-1)){
  $content .=  '</tr><tr>';
  $y = 0;
  }
}
$content .=  '</tr></table>';
?>
