<?php
function recogerVar($cadena) 
{
     $result = trim($cadena);
     $result = addslashes($cadena);
     $result = htmlspecialchars($cadena);
     return result;      
}
?>
