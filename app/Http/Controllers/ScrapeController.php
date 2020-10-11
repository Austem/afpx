<?php

namespace App\Http\Controllers;

use App\Http\DataTransferObject\valorAfpDTO;
use App\Service\afpsService;
use Goutte\Client;
use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\str;

class ScrapeController extends Controller
{
    private $afpService;

    /**
     * ScrapeController constructor.
     * @param $afpService
     */
    public function __construct(afpsService $afpService)
    {
        $this->afpService = $afpService;
    }

    public function __invoke(Request $request)
    {
        $nombreAfp = $request->all();

        if (empty($nombreAfp)) {
            $nombreAfp = 'PROVIDA';
        } else {
            $nombreAfp = strtoupper($nombreAfp['afps']);
        }

        $afpDTO = $this->afpService->obtenerDatosAfp($nombreAfp);

        return view('afpx', compact('afpDTO'));
    }
}
