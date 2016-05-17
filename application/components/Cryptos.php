<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 16/05/2016
 * Time: 9:32 AM
 */
class Component_Cryptos
{
    private $base;
    private $psswrd;
    private $total;

    /**
     * Component_Cryptos constructor.
     */
    public function __construct($pss = "")
    {
        $baseDocument = file_get_contents(APPLICATION_PATH . '\components\charmap\chars.json');
        $this->base = json_decode($baseDocument);
        $this->psswrd = $pss;
        $this->total = count((array) $this->base);

    }

    public function encrypt()
    {
        $psswrd = str_split($this->psswrd);
        foreach ($psswrd as $key => $val) {
            $num =  bindec($this->base->$val);
            $cnum = ($num + intval($this->privateKey(3, 3))) % ($this->total - 1);
            $crypt[] = pack('H*', base_convert(decbin($cnum), 2, 16));
        }
        $out = implode('', $crypt);
        return $out;
    }

    public function unencrypt()
    {
        $psswrd = str_split($this->psswrd);
        foreach ($psswrd as $key => $val) {
            $value = unpack('H*', $val);
            $num =  bindec(base_convert($value[1], 16, 2));
            $unum = ($num + (($this->total - 1) - intval($this->privateKey(3, 3))));
            $uncrypt[] = pack('H*', base_convert(decbin($unum), 2, 16));
        }
        $out = implode('', $uncrypt);
        return $out;
    }

    private function privateKey($n, $i)
    {
        $p = 1;
        if ($i != 0) {
            if ($i < 0){
                $p = pow($n, $i+1);
            } else if ($i > 0) {
                $p = pow($n, $i-1);
            }
        } else {
            return $p;
        }
        if ($i < 0) {
            return $p / $n;
        } else if ($i>0) {
            return $p * $n;
        }
    }
    
    /*$value = unpack('H*', "!");
    echo base_convert($value[1], 16, 2);*/
}