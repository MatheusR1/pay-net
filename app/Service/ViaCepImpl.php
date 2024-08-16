<?php

namespace App\Service;

interface ViaCepImpl
{
    function getAdressInfo(String $cep) : array;
}
