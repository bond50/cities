<?php

class WorldCityModel
{
    public function __construct(
        public int    $id,
        public string $city,
        public string $adminName,
        public string $cityAscii,
        public float  $lat,
        public float  $lng,
        public string $country,
        public string $iso2,
        public string $iso3,
        public int    $population
    )
    {

    }

    public function getCityWithCountry(): string
    {
        return $this->city . ' (' . $this->getFlag() . ' ' . $this->country . ')';
    }

    public function getFlag(): string
    {
        return get_flag_for_country($this->iso2);

    }
}