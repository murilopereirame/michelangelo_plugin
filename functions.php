<?php

function formatPhone($phone)
{
  if (strlen($phone) > 12)
    preg_replace('~.*(\d{2})[^\d]{0,7}(\d{1})[^\d]{0,7}(\d{4})[^\d]{0,7}(\d{4}).*~', '($1) $2 $3-$4', $phone);
  else if (strlen($phone) > 8)
    preg_replace('~.*(\d{2})[^\d]{0,7}(\d{4})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone);
  else
    preg_replace('~.*(\d{4})[^\d]{0,7}(\d{4}).*~', '$1-$2', $phone);
}

function extractYoutubeId($url)
{
  if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $url, $match)) {
    return $match[1];
  }
}