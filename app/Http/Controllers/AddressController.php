<?php

namespace App\Http\Controllers;

use App\Service\ViaCepService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected ViaCepService $viaCepService;

    public function __construct(ViaCepService $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }

    public function show(string $cep)
    {
        return response()->json($this->viaCepService->getAdressInfo($cep));
    }
}
