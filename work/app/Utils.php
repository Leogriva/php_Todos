<?php
namespace MyApp;

// サニタイジング
class Utils
{
public static function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
}