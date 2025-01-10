<?php
function dd($value)
{
   echo '<pre class="text-xl font-medium min-w-56 bg-black text-white z-40 w-fit mx-auto shadow-md shadow-white p-4 max-w-full text-wrap">';
   var_dump($value);
   echo '</pre>';
   // die();
}

function checkURL($value)
{
   $path = parse_url($_SERVER['REQUEST_URI'])['path'];
   return $value === $path;
}
