<?php

function normalParantez($re_parantezler, $parantezler)
{

    $return = false;
    if (array_key_exists("(", $re_parantezler) || array_key_exists(")", $re_parantezler)) {
        for ($i = 0; $i < count($parantezler); $i ++) {
            if ($parantezler[$i] === "(" && $parantezler[$i + 1] === ")") {
                $return = true;
            }
        }
    } else {
        $return = true;
    }
    return $return;
}

function koseliParantez($re_parantezler, $parantezler)
{
    $return = false;
    if (array_key_exists("[", $re_parantezler) || array_key_exists("]", $re_parantezler)) {
        for ($i = 0; $i < count($parantezler); $i ++) {
            if ($parantezler[$i] == "[" && $parantezler[$i + 1] == "]") {
                $return = true;
            }
        }
    } else {
        $return = true;
    }
    return $return;
}

function susluParantez($re_parantezler)
{
    $return = false;
    $susluAc = $susluKapa = null;
    if (array_key_exists("{", $re_parantezler)) {
        $susluAc = $re_parantezler["{"];
    }

    if (array_key_exists("}", $re_parantezler)) {
        $susluKapa = $re_parantezler["}"];
    }


    if ($susluAc === $susluKapa) {
        $return = true;
    }
    return $return;
}

function metinSorgula($re_parantezler)
{
    if (array_key_exists('(', $re_parantezler))
        unset($re_parantezler['(']);
    if (array_key_exists('[', $re_parantezler))
        unset($re_parantezler['[']);
    if (array_key_exists('{', $re_parantezler))
        unset($re_parantezler['{']);
    if (array_key_exists(')', $re_parantezler))
        unset($re_parantezler[')']);
    if (array_key_exists(']', $re_parantezler))
        unset($re_parantezler[']']);
    if (array_key_exists('{', $re_parantezler))
        unset($re_parantezler['{']);

    if (count($re_parantezler) > 0)
        return false;
    else
        return true;
}

if (isset($_POST['formSend'])) {
    $filter = new filter();
    $filter->murat();
    $susluParantezAc = 0;
    $susluParantezKapa = 0;
    $susluParantez = false;
    $normalParantez = false;
    $koseliParantez = false;

    $parantezler = trim($_POST['parantez']);
    $parantezler = str_split($parantezler);
    $re_parantezler = array_count_values($parantezler);

    if (metinSorgula($re_parantezler)) {
        echo "Hatalı Parametre";
    } else {
        if ($parantezler[0] === "}" || $parantezler[0] === ")" || $parantezler[0] === "]") {
            echo "Başarısız";
        } else {
            $normalParantez = normalParantez($re_parantezler, $parantezler);
            $koseliParantez = koseliParantez($re_parantezler, $parantezler);
            $susluParantez = susluParantez($re_parantezler);

            if (!$susluParantez || !$koseliParantez || !$normalParantez) {
                echo "Başarısız";
            } else {
                echo "Başarılı";
            }
        }
    }


}

?>