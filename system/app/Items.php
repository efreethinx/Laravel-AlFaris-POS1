<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    		private $name;
		private $qty;
		private $priceU;
        private $price;
       // private $diskon;
        private $dollarSign;
        //private $n;

    public function __construct($name = '', $qty = '', $priceU = '', $price = '', $dollarSign = false
           )
    {
        $this -> name = $name;
		$this -> qty = $qty;
		$this -> priceU = $priceU;
        $this -> price = $price;
       // $this -> diskon = $diskon;
        //$this -> n = $n;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
		$rightCols = 12;
        //$rightCols2 = 5;
		$leftCols = 33;
        $x = 0;
        $xx = 6;
        $xxx = 0;
		if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
		$left = str_pad($this -> name, $leftCols) ;
		$left1 = str_pad($this -> qty, $x - 4) ;
        //$right2 = str_pad($this -> priceU, $xx, ' ', STR_PAD_LEFT) ;
        $right2 = str_pad($this -> priceU, $xx) ;
       // $right3 = str_pad($this -> diskon, $xxx) ;
        //$n = str_pad($this -> n, $xxx) ;

        $sign = ($this -> dollarSign ? '' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        //$right = str_pad($this -> price, $rightCols, ' ', STR_PAD_LEFT);

        return "$left$left1$right2$right\n";

    }
}
