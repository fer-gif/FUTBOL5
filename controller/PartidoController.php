<?php
require_once 'model/EquipoModel.php';
require_once 'model/PartidoModel.php';
require_once 'view/TorneoView.php';
class PartidoController
{
    private $equipoModel;
    private $partidoModel;
    private $torneoView;

    public function __construct()
    {
        $this->equipoModel = new EquipoModel();
        $this->partidoModel = new PartidoModel();
        $this->torneoView = new TorneoView();
    }

    public function mostrarHome()
    {
        $arreglo = [
            [
                "nombre" => "River",
                "pj" => 3,
                "pg" => 2,
                "pe" => 1,
                "pp" => 0,
                "gf" => 10,
                "gc" => 3,
                "puntos" => 7
            ],
            [
                "nombre" => "Boca",
                "pj" => 3,
                "pg" => 1,
                "pe" => 1,
                "pp" => 1,
                "gf" => 7,
                "gc" => 9,
                "puntos" => 4
            ]
        ];
        $this->torneoView->cargarHome($arreglo);
    }
}
