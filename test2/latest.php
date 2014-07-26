<?PHP
//
// Copyright 2011 benlo.com
// Free for non-commercial purposes
// Contact the author via www.benlo.com for commercial applications
//

putenv("TZ=EST"); // set the time zone the camera is using

$DirPath=date("Y-m-d/");  // Eye-Fi folder option

$names = array();
if (($handle=opendir($DirPath)))
  {
  while ($node = readdir($handle))
    {
    if(!is_dir($DirPath.$node))
        {
        if(strrpos($node,".jpg"))
            {
            if (filesize($DirPath.$node) > 5000)  // skip black images
              {
              $names[] = $node;
              }
           }
        }
    }
  }  
rsort($names);
$node = $names[0];  // last photo added to folder

if ( !$node )
   {
   $DirPath = '';
   $node = 'default.jpg';
   }
$exif_data = exif_read_data ( "$DirPath$node" );
$caption = $exif_data['DateTimeOriginal'];

$html .= "<p align=center>$caption</p>";
$html .= "<center><img src=\"$DirPath$node \"></center>";
echo $html;

?>
