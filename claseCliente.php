<?php
class Cliente {
    private $nombre;
    private $documento;
  
    public function __construct($nombre, $documento) {
      $this->nombre = $nombre;
      $this->documento = $documento;
    }
  
    public function getNombre(): string {
      return $this->nombre;
    }
  
    public function getDocumento(): string {
      return $this->documento;
    }
  }