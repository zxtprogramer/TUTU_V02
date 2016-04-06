<?php
require("../dbase/dbFunction.php");

function uploadMovie($argv){
    global $dataPath;

    $userID=1;
    
    $sql="SELECT PicNum,PicLimitNum FROM UserInfoTable WHERE UserID='$userID'";
    $res=exeSQL($sql);
    $row=mysql_fetch_array($res);
    $picLimitNum=(int)$row['PicLimitNum'];
    $picNum=(int)$row['PicNum'];
    if($picNum >= $picLimitNum){
    	return;
    }
   
    $picAlbumID=$argv[1];
    $tmpfile=$argv[2];
    $filename=basename($tmpfile);

    $path=$dataPath . "User_" . $userID . "/Album_" . $picAlbumID . "/". $filename;
    $wwwPath="/Data/User_" . $userID . "/Album_" . $picAlbumID . "/". $filename;
    rename($tmpfile, $path);

    $snapTmp=$path . "_snapTmp.jpg";
    $cmd="ffmpeg -i $path -ss 00:00:50 -f image2 $snapTmp";
    system($cmd);

    $picSize=getimagesize($snapTmp);

    $snapBigPath=$dataPath . "User_" . $userID . "/AlbumSnapBig_" . $picAlbumID . "/". $filename . ".jpg";
    $snapSmallPath=$dataPath . "User_" . $userID . "/AlbumSnapSmall_" . $picAlbumID . "/". $filename . ".jpg";
    $cmd="convert -resize 1024x1024 " . $snapTmp . " " . $snapBigPath;
    system($cmd);
    $cmd="convert -resize 60x60 " . $snapTmp . " " . $snapSmallPath;
    system($cmd);
    
    $latMax=40.0;
    $latMin=39;
    $lngMax=116.5;
    $lngMin=116.2;

    $shootTime=time();
    $lng=rand($lngMax*1e7, $lngMin*1e7)/1e7;
    $lat=rand($latMax*1e7, $latMin*1e7)/1e7;

    $picDes="";
    
    addPic($userID, $filename,$picSize[0],$picSize[1],$picDes,$path,$shootTime,time(),$lng,$lat,0,$picAlbumID);

    $sql="UPDATE UserInfoTable SET PicNum=PicNum+1 WHERE UserID='$userID'";
    exeSQL($sql);

}

uploadMovie($argv);

?>
