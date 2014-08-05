<?php
namespace roma/city;

$PGT = $_GET['PGT'];
$YearBuilt = $_GET['YearBuilt'];
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];
$Homes = $_GET['Homes'];
$Plot = $_GET['Plot']; 
//Все функции которые будут указаны здесь после отрозятся в окне браузера.
    $PGTRent = new PGTRent($PGT, $YearBuilt, $latitude, $longitude, $Homes, $Plot);
    echo 'Площадь ПГТ: ' . $PGTRent->PGTPlot().'<br>';
    echo 'Численность населения: ' . $PGTRent->Peoples().'<br>';
    echo 'Суммарный налог за землю: ' . $PGTRent->Mzda().'<br>';
    echo 'Размер сбора с каждого дома: ' . $PGTRent->Nalog().'<br>';
   	
	class PGTRent {
	public $PGT;
	public $YearBuilt;
	public $latitude;
	public $longitude;
	public $Homes;
	public $Plot;
	
   /* const apartment = 4; На каждом этоже 4 квартиры */
    //const PlotHome = 1; //площадь одного участка 1 гт.;
    const PayPlot= 120; //120 грн. - оплата за 1 гтр. земли;
    const PlotShop = 0.2; //0.2 гт. - площадь одного магазина ;
    const PlotKlub = 1.2; /*1,2 гт.- площадь клуба */
	const People = 4; /*4 - среднее количество людей живущих в одном доме. */
	const Garbage = 5; /*5 грн. - налог с одного человека за вывоз мусора*/
// - рассчитывает бюджет населенного пункта в зависимости от размера налога на землю, 
//полученного со всех домов;
//- рассчитывает количество населения, проживающего в населенном пункте;
// - выводит информацию о населенном пункте.
	/* ',' - Sапятые нельзя использовать в именах переменных. */
    
	public function __construct($PGT, $YearBuilt, $latitude, $longitude, $Homes, $Plot){
	        $this->PGT = $PGT;
	        $this->YearBuilt = $YearBuilt;
	        $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->Homes = $Homes;
			$this->Plot = $Plot;
            echo "Данные района: Название поселка - $PGT," .'<br>';
            echo         		    "Год основания - $YearBuilt год.".'<br>';     
			echo 	 "Координаты:   Широта - $latitude*,    Долгота - $longitude*." .'<br>';  
            echo                   "Домов - $Homes шт.".'<br>'; 
            echo                    "Площадь участков - $Plot гт.".'<br>';   
        }        
       /* function apartments() { *Расчет количества квартир в доме *
		 $apartments = $this->floors * $this->tranc * self::apartment;
            return $apartments;   
        } */  
        function PGTPlot(){  /*Расчет площади ПГТ */
            $PGTPlot=$this->Homes*$this->Plot + self::PlotShop + self::PlotKlub;
            return $PGTPlot;
        } 
        function Peoples(){  /*Расчет населения ПГТ */
            $Peoples=$this->Homes*self::People;
            return $Peoples;
        } 
        function Mzda(){  /*Расчет суммарного налога */
            $Mzda=$this->PGTPlot() * self::PayPlot;
            return $Mzda;
        } 
		
		function Nalog(){  //Размер оплаты с каждого дома
		$Nalog=$this->Mzda()/$this->Homes;
            return  $Nalog;
        } 
    }
?>