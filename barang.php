<?php
class Barang {
    public $id;
    public $nama;
    public $harga;
    public $stok;

    public function __construct($id, $nama, $harga, $stok) {
        $this->id = $id;
        $this->nama = $nama;
        $this->harga = $harga;
        $this->stok = $stok;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'stok' => $this->stok,
        ];
    }
}
