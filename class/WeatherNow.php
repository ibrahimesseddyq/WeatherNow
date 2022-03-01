<?php

    class WeatherNow{
        # Put here your OpenWeather API key
        private string $apikey;
        # Just a property representing the language
        private string $language;
        # Unit : metrics,imperial ,standard...
        private string $unit;
        #the city name and its important to follow the ISO 3166 standard when refering to city
        private string $city;
        # a variable to store errors
        private string $error;
        public array $data;


        public function __construct(string $apikey,string $language = "en", string $unit="metric"){
            $this->apikey = $apikey;
            $this->language = $language;
            $this->unit = $unit;
        }

        public function setCity(string $city){
            $this->city=$city;
        }
        private function doConfig($curl,string $certifLocation = null){
            if(!$certifLocation == null){
                curl_setopt($curl,CURLOPT_CAINFO,__DIR__.DIRECTORY_SEPARATOR.$certifLocation);
            }
            curl_setopt($curl,CURLOPT_RETURNTRANSFER ,true);
            curl_setopt($curl,CURLOPT_TIMEOUT ,1);

        }
        public function getData($certifLocation = null){
            $curl= curl_init("https://api.openweathermap.org/data/2.5/weather?q=$this->city&appid=$this->apikey&units=$this->unit&lang=$this->language");
            if(!$certifLocation == null){
                $this->doConfig($curl,"../".$certifLocation);
            }else{
                $this->doConfig($curl);
            }
            $data=curl_exec($curl);
            if($data === false){
                $this->error=curl_error($curl);
                echo "Error!!". $this->error;
            }else{
                $data=json_decode($data,true);
                $this->data= $data;
            }
        } 
        function windSpeed(){
            return $this->data["wind"]["speed"];
        }
        function temp(){
            return $this->data["main"]["temp"];
        }
        function minTemp(){
            return $this->data["main"]["temp_min"];
        }
        function maxTemp(){
            return $this->data["main"]["temp_max"];
        }
        function pressure(){
            return $this->data["main"]["pressure"];
        }
        function humidity(){
            return $this->data["main"]["humidity"];
        }
        function windDegree(){
            return $this->data["wind"]["deg"];
        }
    }