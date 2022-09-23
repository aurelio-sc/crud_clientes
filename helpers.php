<?php
function limpar_texto($str)
{
  return preg_replace("/[^0-9]/", "", $str);
}

function formatar_data($data)
{
  return implode('/', array_reverse(explode('-', $data)));
}

function formatar_telefone($telefone)
{
  if (!empty($telefone)) {
    $ddd = substr($telefone, 0, 2);
    $tel_1 = substr($telefone, 2, 5);
    $tel_2 = substr($telefone, 7, 4);
    return "($ddd) $tel_1-$tel_2";
  }
}