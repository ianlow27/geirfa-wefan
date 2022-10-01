<?php
/* ==============================================
TO DO:
======
- details
-------------------------------------------------
DONE:
=====
# Changelog
## 1.0.0 - yyyy-mm-dd
### Changed
- details
### Fixed
- details
### Added
- details
================================================= */
namespace Ianl28\GeirfaWefan;
class GeirfaWefan{
//-----------------------------------------------
public function maintLlyther($pGair){
$maintLlyther=100;
  if(strlen($pGair) < 20){       $maintLlyther=100;
  }else if(strlen($pGair) < 22){ $maintLlyther=76;
  }else if(strlen($pGair) < 23){ $maintLlyther=75;
  }else if(strlen($pGair) < 24){ $maintLlyther=74;
  }else if(strlen($pGair) < 25){ $maintLlyther=73;
  }else if(strlen($pGair) < 26){ $maintLlyther=72;
  }else if(strlen($pGair) < 28){ $maintLlyther=71;
  }else if(strlen($pGair) < 30){ $maintLlyther=70;
  }else if(strlen($pGair) < 35){ $maintLlyther=65;
  }else if(strlen($pGair) < 40){ $maintLlyther=60;
  }else if(strlen($pGair) < 45){ $maintLlyther=50;
  }else {                        $maintLlyther=45;
  }
  return $maintLlyther."%";
}//dfunc
/* -----------------------------------------------
FUNCTION: recursive_read
INPUTS: 1) y plygell dechreuedig, 2) dewisol, y dulliad sydd eisoes yn cynhwys y allbynniad o'r ffwythiant wedi'u galw o'r blaen. 
DESCRIPTION: Mae'r ffwythiant hwn yn dolenni trwy'r yr isblygellau dan y plygell dechreudig, ac yn dychwelyd y dulliad gyda'r rhestr o lwybrau cyffelybiedig.
-------------------------------------------------- */
public function recursive_read($directory, $entries_array = array()) {
  if(is_dir($directory)) {
    $handle = opendir($directory);
    while(FALSE !== ($entry = readdir($handle))) {
//echo "<li>1__". $entry;
      if(substr($entry, 0,1) != "_") continue;
      if($entry == '.' || $entry == '..') {
         continue;
       }
       $Entry = $directory . "/" . $entry;
       if(is_dir($Entry))  {
         $entries_array = GeirfaWefan::recursive_read($Entry, $entries_array);
       } else {
         if( ( preg_match("/.*\.png$/", $entry)) && ($directory != "./")  ){

           $entries_array[] = $Entry;
           break;
         }//endif
      }//endif
    }//endwhile
    closedir($handle);
  }
  return $entries_array;
}//dfunc
//-----------------------------------------------------------
public function __construct(){
    //echo "This is called from GeirfaWefan->__construct()\n";
}//dfunc
//-----------------------------------------------------------
public function testrun(){
echo '
<!DOCTYPE html><html><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
a {text-decoration:none;}
</style>
<script>
//======================================
let lprevid=0;
function highlight(pid){
var odvf=document.getElementById("dvf");
odvf.style.display="block";
var odvfimg=document.getElementById("dvfimg");
var odvftd1=document.getElementById("dvftd1");
var odvftd2=document.getElementById("dvftd2");
var odv=document.getElementById("dv"+pid);
var oimg=document.getElementById("img"+pid);
var otd1=document.getElementById("td1"+pid);
var otd2=document.getElementById("td2"+pid);
//--------
var otd2prev=document.getElementById("td2"+lprevid);
if((typeof otd2prev != "undefined")&&(otd2prev != null)){
  otd2prev.style.background="white";
}
otd2.style.backgroundColor="#fc5";
//--------
odvfimg.src=oimg.src;

odvftd1.style.fontSize="110%";
odvftd1.style.fontWeight="bold";
//odvftd1.style.wordWrap="break-all";
//odvftd1.style.overflowWrap="break-word";
setTimeout(function(){
odvftd1.innerHTML="Lluneirfa - "+ otd1.innerHTML.replace(/ /, " ").toUpperCase();
},200);

odvftd2.innerHTML=otd2.innerHTML;
odvftd2.style.wordWrap="break-all";
odvftd2.style.overflowWrap="break-word";
odvftd2.style.display="inline-block";
odvftd2.style.width="400px";
odvftd2.style.fontSize="250%";
odvftd2.style.fontWeight="normal";

lprevid=pid;

}
</script>
</head>
<body style="font-family:Noto Serif">


<table border=0 width="100%">
<tr>


<td id="tdChwith" width="0%" style="text-align:center;" >
<center>

<div style="text-align:center;background-color:white;display:none;position:fixed;top:5px;left:5px;xxwidth:50%;" id="dvf">

<table border=0 cellspacing=0 cellpadding=0 style="background-color:white; xxdisplay:inline;margin:0px;padding:0px;table-layout:fixed;" w_idth="50%" >
<tr><td style="xxborder-top:1px solid #aaa; background-color:white; text-align:center;margin:20px;padding:0px;word-wrap:break-word;overflow-wrap:break-word;" id="dvftd1" ></td></tr>
<tr><td style="margin:0px;padding:0px;xxwidth:100%;margin:0px;padding:0px;"><img src="" style="border-radius:30px;width:350px; margin:0px;padding:0px;" id="dvfimg"  /></td></tr>
<tr><td style="margin:0px;padding:0px;background-color:white;xxmax-height:1px;text-align:center;xxfont-size:400%;font-weight:bold;"><div style="word-wrap:break-word;display:inline-block;xxwhite-space:normal;" id="dvftd2" ></div></td></tr>
</table>

</div>
</center>


</td>
<td>
';
//    echo "This is called from GeirfaWefan->testrun()\n";
$ll1a = "";
$count1=0;
// prawfholi ai ydy yr amrywolyn URL plygell yn bodoli?




//-----------------------------------------------------
//-----------------------------------------------------
//-----------------------------------------------------
//-----------------------------------------------------
//-----------------------------------------------------
if(!empty($_GET["data"])){
  echo "
<div style='text-align:center;'><a href='./index.php'>Hafan</a>&emsp;&ensp;<span id='sptot'></span><!-- &emsp;&ensp;<a href=''>Ystreigliad Argraffu</a><input type='button' id='tx1' style='border:0px none white;width:2px;'></input -->
<button style='background-color:white; color:white; border:none; ' onclick='dechreu(this);'> &emsp; </button>

</div>
";
//echo $_GET["data"];
$entries_array=explode("\n", file_get_contents("./_data/".$_GET["data"]));
$dDeitl=explode("_", substr(preg_replace("/\.txt$/","",$_GET["data"]),1) );
//echo $_GET["data"]. "<br/>";
$lhanfodrhenc1=  $dDeitl[count($dDeitl)-2];
$lhanfodrhenc0=  $dDeitl[count($dDeitl)-1];
$count1=0;
$lurl="";
foreach($entries_array as $lentry){
    $count1++;
    if($count1<=1){
      $lurl=trim($lentry)."/";
      continue;
    }
//echo $lentry."<br/>";
    if(!preg_match("/\.png$/", $lentry)) continue;
    $llcyfmsr1=basename($lentry,".png");
    if(substr($llcyfmsr1,0,2) == "xx") continue;
    if(substr($llcyfmsr1,0,2) == "zz") continue;
    if(preg_match("/\^\^/", $llcyfmsr1)){
      $dcyfmsr1a = explode("^^", $llcyfmsr1);
      $llcyfmsr1=$dcyfmsr1a[1];
    }
    if($llRhstr != "") $llRhstr.="|";
    $llRhstr .=  $llcyfmsr1."!!!". $lentry;
}//dforeach
$entries_array = explode("|", $llRhstr);
//echo $llRhstr."<br/>";
//echo $lurl."<br/>";
$count1=0;
//==============================================
  sort($entries_array);
  // os ydy angen i arddangos y lluniau
  //$entries_array = array_reverse($entries_array);

$llGeirfa="";
$llIsdeitlau="";

  foreach($entries_array as $lentry){
    $dcyfmsr1a=explode("!!!", $lentry);
    $llcyfmsr1=$dcyfmsr1a[0];
    $lentry = $dcyfmsr1a[1];

    $count1++;
    echo '<div style="xxborder:2px solid blue;xxbackground-color:white;display:inline;" xxonmouseover="highlight('.$count1.');" id="xxdv'.$count1.'" >
<!-- ['.$lentry.']  -->
<table id="dv'.$count1.'" border=0 cellspacing=0 cellpadding=0 style="xxborder:2px solid blue;xxbackground-color:white; display:inline;margin:0px;padding:0px;" >
<tr><td style="xxfont-style:italic;font-size:75%;border-top:1px dashed #aaa; xxbackground-color:white; text-align:center;margin:20px;padding:0px;" id="td1'.$count1.'" >'.substr($lhanfodrhenc1,0) .'<br/>'.substr($lhanfodrhenc0,0) .'</td></tr>
<tr><td style="margin:0px;padding:0px;width:100px;margin:0px;padding:0px;"><img id="img'.$count1.'" src="'. $lurl. $lentry. '" style="border-radius:10px;width:100px; margin:0px;padding:0px;" /></td></tr>
<tr><td style="font-weight:bold;margin:0px;padding:0px;xxbackground-color:white;max-height:1px;text-align:center;font-size:'. GeirfaWefan::maintLlyther($llcyfmsr1)   .';" id="td2'.$count1.'">'. $llcyfmsr1 .'</td></tr>
</table>
</div> ';
    $d2a = explode("^^", basename($dcyfmsr1a[1]) );
    $llFath1=$llFath;
    if($llFath == "_enwau"){
      $llFath1="nm";
      if(preg_match("/e([a-z]{1,1})$/", $llcyfmsr1)){
        $llFath1="nf";
      }
    }else if($llFath == "adferfau"){
    }else if($llFath == "berfau"){
    }else if($llFath == "ansoddeiriau"){
    }//dif

    //$cy1a = 3 + ($count1 * 5); //ehebocbryfed & clugiaid
    //$cy1a = -1 + ($count1 * 5); //corff
    //$cy1a = 1 + ($count1 * 5); //ffrwythau
    $cy1a = 3 + ($count1 * 5); 
    $cy1b = 4 + $cy1a;
    $llOriau    = 0;
    $llFunudau  = 0;
    $llEiliadau = 0;
    $llOriau1   = 0;
    $llFunudau1 = 0;
    $llEiliadau1= 0;

    $llEiliadau = $cy1a % 60;
    if($cy1a >= 60)
      $llFunudau  = floor($cy1a / 60);
    if($cy1a >= 60)
      $llOriau    = floor($llFunudau / 60);
    $llEiliadau1 = $cy1b % 60;
    if($cy1b >= 60)
      $llFunudau1  = floor($cy1b / 60);
    if($cy1b >= 60)
      $llOriau1    = floor($llFunudau1 / 60);
   
    $d2a[0] = preg_replace("/_/", "", $d2a[0]);

    $llIsdeitlau .= 
         $count1 ."\n".
         sprintf("%02d",$llOriau) .":". sprintf("%02d",$llFunudau) .":". sprintf("%02d", $llEiliadau) .",000 --> ".
         sprintf("%02d",$llOriau1) .":". sprintf("%02d",$llFunudau1) .":". sprintf("%02d", $llEiliadau1) .",990\n".
         "". $d2a[0]."\n\n"
         ;
    $llGeirfa .= $llcyfmsr1 . "\t". $llFath1 ."\t". $d2a[0]."\t``".$llDyddiad. "\t". $lhanfodrhenc0."\n";
    //$llGeirfa .= $lhanfodrhenc0. "___". basename($dcyfmsr1a[1]). "\n";
  }//endforeach
  if(!file_exists("./isdeitlau")) mkdir("./isdeitlau", 0755);
  file_put_contents("./isdeitlau/newydd-eirfa_".$lhanfodrhenc0 ."_isdeitl_EN.srt.txt", $llIsdeitlau);
  if(!file_exists("./geirfa")) mkdir("./geirfa", 0755);
  file_put_contents("./geirfa/newydd-eirfa_".$lhanfodrhenc0 .".txt", $llGeirfa);

/*
  echo '
<button style="background-color:white; color:white; border:none; " onclick="dechreu(this);"> &emsp; </button>
  ';
*/
//-----------------------------------------------
}else if(!empty($_GET["plygell"])){
  echo "
<div style='text-align:center;'><a href='./index.php'>Hafan</a>&emsp;&ensp;<span id='sptot'></span><!-- &emsp;&ensp;<a href=''>Ystreigliad Argraffu</a><input type='button' id='tx1' style='border:0px none white;width:2px;'></input -->
<button style='background-color:white; color:white; border:none; ' onclick='dechreu(this);'> &emsp; </button>

</div>
";

  $entries_array = array();
  // os ydy angen i gyrchu y lluniau yn y plygell
  $directory = $_GET["plygell"];
  $d01z=explode("/", preg_replace("/\.\/\//", "", $directory ) );
  $llFath = $d01z[0];
  $llDyddiad = date("ymd");

  $atmp1a=explode("/", strrev($directory) );
  $lhanfodrhenc0 = strrev($atmp1a[0]);
  $lhanfodrhenc1 = strrev($atmp1a[1]);


  if(is_dir($directory)) {
    $handle = opendir($directory);
    while(FALSE !== ($entry = readdir($handle))) {
      if($entry == '.' || $entry == '..') {
         continue;
       }
       $Entry = $directory . "/" . $entry;
       if(is_dir($Entry)) {
       }else {
         if(preg_match("/.*\.png$/", $entry)){
           $entries_array[] = $Entry;
         }
      }
    }//endwhile
    closedir($handle);
  }
  echo "<br/>";
  $llRhstr="";
//==============================================
foreach($entries_array as $lentry){
//echo $lentry."<br/>";
    $llcyfmsr1=basename($lentry,".png");
    if(substr($llcyfmsr1,0,2) == "xx") continue;
    if(substr($llcyfmsr1,0,2) == "zz") continue;
    if(preg_match("/\^\^/", $llcyfmsr1)){
      $dcyfmsr1a = explode("^^", $llcyfmsr1);
      $llcyfmsr1=$dcyfmsr1a[1];
    }
    if($llRhstr != "") $llRhstr.="|";
    $llRhstr .=  $llcyfmsr1."!!!". $lentry;
}//dforeach
$entries_array = explode("|", $llRhstr);
//==============================================
  sort($entries_array);
  // os ydy angen i arddangos y lluniau
  //$entries_array = array_reverse($entries_array);

$llGeirfa="";
$llIsdeitlau="";

  foreach($entries_array as $lentry){
    $dcyfmsr1a=explode("!!!", $lentry);
    $llcyfmsr1=$dcyfmsr1a[0];
    $lentry = $dcyfmsr1a[1];

    $count1++;
    echo '<div style="xxborder:2px solid blue;xxbackground-color:white;display:inline;" xxonmouseover="highlight('.$count1.');" id="xxdv'.$count1.'" >
<!-- ['.$lentry.']  -->
<table id="dv'.$count1.'" border=0 cellspacing=0 cellpadding=0 style="xxborder:2px solid blue;xxbackground-color:white; display:inline;margin:0px;padding:0px;" >
<tr><td style="xxfont-style:italic;font-size:75%;border-top:1px dashed #aaa; xxbackground-color:white; text-align:center;margin:20px;padding:0px;" id="td1'.$count1.'" >'.substr($lhanfodrhenc1,1) .'<br/>'.substr($lhanfodrhenc0,1) .'</td></tr>
<tr><td style="margin:0px;padding:0px;width:100px;margin:0px;padding:0px;"><img id="img'.$count1.'" src="'. $lentry. '" style="border-radius:10px;width:100px; margin:0px;padding:0px;" /></td></tr>
<tr><td style="font-weight:bold;margin:0px;padding:0px;xxbackground-color:white;max-height:1px;text-align:center;font-size:'. GeirfaWefan::maintLlyther($llcyfmsr1)   .';" id="td2'.$count1.'">'. $llcyfmsr1 .'</td></tr>
</table>
</div> ';
    $d2a = explode("^^", basename($dcyfmsr1a[1]) );
    $llFath1=$llFath;
    if($llFath == "_enwau"){
      $llFath1="nm";
      if(preg_match("/e([a-z]{1,1})$/", $llcyfmsr1)){
        $llFath1="nf";
      }
    }else if($llFath == "adferfau"){
    }else if($llFath == "berfau"){
    }else if($llFath == "ansoddeiriau"){
    }//dif

    //$cy1a = 3 + ($count1 * 5); //ehebocbryfed & clugiaid
    //$cy1a = -1 + ($count1 * 5); //corff
    //$cy1a = 1 + ($count1 * 5); //ffrwythau
    $cy1a = 3 + ($count1 * 5); 
    $cy1b = 4 + $cy1a;
    $llOriau    = 0;
    $llFunudau  = 0;
    $llEiliadau = 0;
    $llOriau1   = 0;
    $llFunudau1 = 0;
    $llEiliadau1= 0;

    $llEiliadau = $cy1a % 60;
    if($cy1a >= 60)
      $llFunudau  = floor($cy1a / 60);
    if($cy1a >= 60)
      $llOriau    = floor($llFunudau / 60);
    $llEiliadau1 = $cy1b % 60;
    if($cy1b >= 60)
      $llFunudau1  = floor($cy1b / 60);
    if($cy1b >= 60)
      $llOriau1    = floor($llFunudau1 / 60);
   
    $d2a[0] = preg_replace("/_/", "", $d2a[0]);

    $llIsdeitlau .= 
         $count1 ."\n".
         sprintf("%02d",$llOriau) .":". sprintf("%02d",$llFunudau) .":". sprintf("%02d", $llEiliadau) .",000 --> ".
         sprintf("%02d",$llOriau1) .":". sprintf("%02d",$llFunudau1) .":". sprintf("%02d", $llEiliadau1) .",990\n".
         "". $d2a[0]."\n\n"
         ;
    $llGeirfa .= $llcyfmsr1 . "\t". $llFath1 ."\t". $d2a[0]."\t``".$llDyddiad. "\t". $lhanfodrhenc0."\n";
    //$llGeirfa .= $lhanfodrhenc0. "___". basename($dcyfmsr1a[1]). "\n";
  }//endforeach
  if(!file_exists("./isdeitlau")) mkdir("./isdeitlau", 0755);
  file_put_contents("./isdeitlau/newydd-eirfa_".$lhanfodrhenc0 ."_isdeitl_EN.srt.txt", $llIsdeitlau);
  if(!file_exists("./geirfa")) mkdir("./geirfa", 0755);
  file_put_contents("./geirfa/newydd-eirfa_".$lhanfodrhenc0 .".txt", $llGeirfa);

/*
  echo '
<button style="background-color:white; color:white; border:none; " onclick="dechreu(this);"> &emsp; </button>
  ';
*/

}else {
//=================================================
//=================================================
//=================================================
//=================================================
//=================================================
//=================================================
  echo "
<div style='text-align:center;'><b>GEIRFAWEFAN</b><br/>";
  echo "<span style='font-size:80%;'>". date("Ymd H:i:s"). "</span></div>";

  //---------------------------------------------------
$entries_array = array();
$directory = "./_data";
if(file_exists($directory)){
  if(is_dir($directory)) {
    $handle = opendir($directory);
    while(FALSE !== ($entry = readdir($handle))) {
//echo "<li>1__". $entry;
      if(substr($entry, 0,1) != "_") continue;
      if($entry == '.' || $entry == '..') {
         continue;
       }
       $Entry = $directory . "/" . $entry;
       if(!is_dir($Entry))  {
         if( ( preg_match("/.*\.txt$/", $entry)) && ($directory != "./")  ){
           //array_push($entries_array, $Entry);
           $entries_array[] = $Entry;
         }//endif
      }//endif
    }//endwhile
    closedir($handle);
  }
}//dif
  $dData = $entries_array;
  foreach($dData as $ldir){
    $file = basename($ldir);
    //------------------
    $lines=array();
    $fp = fopen("./_data/". $file, "r");
    while(!feof($fp)){
      $line = fgets($fp, 4096);
      $lines[] = $line;
      if(count($lines) > 5) break;
    }//dwhile
    $limgsrc = trim($lines[0]). "/". $lines[1];
//echo $limgsrc;
    //------------------
    $file1 = preg_replace("/\.txt$/", "", $file);
    $d1a = explode("_", substr($file1,1));
//echo $ldir."<br/>";
    echo '<div onclick="window.location=\'./index.php?data='.$file.'\';" style="background-color:white;display:inline;width:100px;">
<table border=0 cellspacing=0 cellpadding=0 style="background-color:white; display:inline;margin:0px;padding:0px;">
<tr><td style="border-top:1px dashed #aaa; background-color:white; text-align:center;margin:20px;padding-top:20px;">'.$d1a[0] .'<br/>'. $d1a[1].'</td></tr>
<tr><td style="margin:0px;padding:0px;width:100px;margin:0px;padding:0px;"><img src="'. $limgsrc. '" style="width:100px; margin:0px;padding:0px;border-radius:10px;" /></td></tr>
<tr><td style="margin:0px;padding:0px;background-color:white;max-height:1px;text-align:center;font-size:'.GeirfaWefan::maintLlyther($d1a[2]. $d1a[2]).';">'. $d1a[2].'</td></tr>
<tr><td style="margin:0px;padding-bottom:20px;background-color:white;max-height:1px;text-align:center;font-size:'.GeirfaWefan::maintLlyther($d1a[3]. $d1a[3]).';">'. $d1a[3] .'</td></tr>
</table>
</div> ';
  }
//die();
  //---------------------------------------------------
  $adirs = GeirfaWefan::recursive_read("./");
  $ll1a = $adirs[0];

  foreach($adirs as $ldir){
    $file=basename($ldir);
    $lparentdir = dirname($ldir);
    $limgsrc=$lparentdir."/".$file;
    //echo "<li><a href='./index.php?plygell=".$lparentdir."'>".$lparentdir ."</a></li>";
    $atmp1a = explode("/", strrev($lparentdir));
    if($atmp1a[3] == "") $atmp1a[3]=";psne&_";
    if($atmp1a[2] == "") $atmp1a[2]=";psne&_";
    echo '<div onclick="window.location=\'./index.php?plygell='.$lparentdir.'\';" style="background-color:white;display:inline;width:100px;">
<table border=0 cellspacing=0 cellpadding=0 style="background-color:white; display:inline;margin:0px;padding:0px;">
<tr><td style="border-top:1px dashed #aaa; background-color:white; text-align:center;margin:20px;padding-top:20px;">'.substr(strrev($atmp1a[3]), 1) .'<br/>'. substr(strrev($atmp1a[2]), 1).'</td></tr>
<tr><td style="margin:0px;padding:0px;width:100px;margin:0px;padding:0px;"><img src="'. $limgsrc. '" style="width:100px; margin:0px;padding:0px;border-radius:10px;" /></td></tr>
<tr><td style="margin:0px;padding:0px;background-color:white;max-height:1px;text-align:center;font-size:'.GeirfaWefan::maintLlyther($atmp1a[1]. $atmp1a[1]).';">'. substr(strrev($atmp1a[1]),1) .'</td></tr>
<tr><td style="margin:0px;padding-bottom:20px;background-color:white;max-height:1px;text-align:center;font-size:'.GeirfaWefan::maintLlyther($atmp1a[0]. $atmp1a[0]).';">'. substr(strrev($atmp1a[0]), 1) .'</td></tr>
</table>
</div> ';
  }//endforeach
}//dif
//------------------------------------------------------

echo '
<script>
document.getElementById("sptot").innerHTML=" (Cyfanswm '.$count1.')";
function dechreu(pobj){
let dt = new Date();
let llCyfrnr =  ""
   + String(dt.getYear() - 100)
   + ("0" + String(dt.getMonth()+1)).substr(-2)
   + dt.getDate()
   ;
//alert(llCyfrnr);
//return;

let llAteb = prompt("Atolwg mewnbynnwch gair dechreuedig:");

if(llAteb == "mkdata"){
alert("'.$ll1a.'");
  window.location="./index.php?mkdata='.$limgsrc.'";
  return;
}else {
  let lcount = '.$count1. ';
  let cfDechreu=0;
  for(let i=1; i<=lcount; i++){
  //alert(document.getElementById("td2"+i).innerHTML);
    if(document.getElementById("td2"+i).innerHTML== llAteb){
      //alert(document.getElementById("td2"+i).innerHTML);
      cfDechreu=(i - 1);
      break;
    }
  }//dfor
}

document.getElementById("tdChwith").width="40%";
pobj.style.display="none";
document.getElementById("sptot").scrollIntoView();
let gcurrid=cfDechreu;

setTimeout(function(){
  highlight(gcurrid + 1);
},500);
setTimeout(function(){
  setInterval(function(){
     gcurrid++;
     if(gcurrid <= '.$count1.'){
        const odv1= document.getElementById("dv"+gcurrid);
        if((typeof odv1 != "undefined") && (odv1 != null)){
          odv1.scrollIntoView();
          highlight(gcurrid);
        }else{
        }
     }//endif
  },5000);
},5000);
}//dfunc
</script>
';

echo '
<td>
<tr>
</table>

</body></html>
';

}//dfunc
//-----------------------------------------------------------

}//endclass 
?>
