<?php

namespace M2M\WeatherFromApi\Block;

use \Magento\Framework\View\Element\Template\Context;
use M2M\WeatherFromApi\Model\Weather;

class Header extends \Magento\Framework\View\Element\Template
{

    /**
     * @var Weather
     */
    protected $weather;

    public function __construct(
        Weather $weather,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->weather = $weather;
    }

    public function getWeather()
    {
        return $this->weather->getWeatherByCity("Warsaw");
        // echo("Test");
    }

}
?>