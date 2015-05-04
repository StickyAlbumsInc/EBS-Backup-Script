<?php

$date = date("Y-m-d");

$volumes = `aws ec2 describe-volumes --output json`;

$volumes = json_decode($volumes);

$backup_list = array();

foreach($volumes->Volumes as $vol) {
  if(isset($vol->Tags)) {
    foreach($vol->Tags as $tag) {
      if ($tag->Key == "BackupDaily") {
        $backup_list[] = $vol->VolumeId;
      }
    }
  }
}

foreach($backup_list as $id) {
  `aws ec2 create-snapshot --volume-id $id --description "Automated backup for $date."`;
}
