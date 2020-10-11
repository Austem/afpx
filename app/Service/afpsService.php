<?php

namespace App\Service;

use App\Http\DataTransferObject\valorAfpDTO;
use Goutte\Client;

use Illuminate\Support\Facades\Cache;

class afpsService
{

    private $client;

    /**
     * afpsService constructor.
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function obtenerDatosAfp(string $nombreAfp)
    {
        if (Cache::has('datosPagina')) {
            $datosPagina = Cache::get('datosPagina');
        } else {
            $datosPagina = $this->traerDatosDeLaPagina();
            Cache::put('datosPagina', $datosPagina, now()->addMinutes(5));
        }

        $informacionFondos = $this->filtrarInformacionDeFondos($datosPagina, $nombreAfp);

        return $informacionFondos;
    }

    public function traerDatosDeLaPagina()
    {
        $letraFondo = ['A', 'B', 'C', 'D', 'E'];

        for ($i = 0; $i <= 4; $i++) {

            $paginaFondos[] = $this->client->request(
                'GET',
                'https://www.spensiones.cl/apps/valoresCuotaFondo/vcfAFP.php?tf=' . $letraFondo[$i] . '');

            $textoPaginasFondos[] = $paginaFondos[$i]->filter('tr')->each(function ($item) {
                return $item->text();
            });
        }

        return $textoPaginasFondos;
    }

    public function filtrarInformacionDeFondos($textoPaginasFondos, $nombreAfp)
    {
        $auxFecha = explode(' ', $textoPaginasFondos[0][6]);
        $fecha = $auxFecha[0];

        for ($i = 8; $i <= 14; $i++) {

            $valorCuota = [];
            foreach ($textoPaginasFondos as $textoFondo) {

                $datosAfp = explode(" ", $textoFondo[$i]);
                $nombre = $datosAfp[0];
                $valorCuota[] = trim(html_entity_decode($datosAfp[1]), " \t\n\r\0\x0B\xC2\xA0");

            }

            if ($nombreAfp === $nombre) {
                return new valorAfpDTO($nombre, $fecha, $valorCuota);
            }
        }

        return null;
    }
}
