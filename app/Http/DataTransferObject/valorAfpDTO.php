<?php


namespace App\Http\DataTransferObject;


class valorAfpDTO
{
    private $nombre;
    private $fecha;
    private $valoresFondos;

    /**
     * valorAfpDTO constructor.
     * @param $nombre
     * @param $fecha
     * @param $valoresFondos
     */
    public function __construct($nombre, $fecha, $valoresFondos)
    {
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->valoresFondos = $valoresFondos;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getValoresFondos()
    {
        return $this->valoresFondos;
    }

    /**
     * @param mixed $valoresFondos
     */
    public function setValoresFondos($valoresFondos): void
    {
        $this->valoresFondos = $valoresFondos;
    }


    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }


}
