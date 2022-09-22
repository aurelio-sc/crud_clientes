<?php
function limpar_texto($str)
{
  return preg_replace("/[^0-9]/", "", $str);
}