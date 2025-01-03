<?php
function dd($value)
{
   echo '<pre class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-xl font-medium min-w-56 bg-black z-40 w-fit shadow-md shadow-white p-4 max-w-full text-wrap">';
   var_dump($value);
   echo '</pre>';
   // die();
}

function checkURL($value)
{
   $path = parse_url($_SERVER['REQUEST_URI'])['path'];
   return $value === $path;
}
