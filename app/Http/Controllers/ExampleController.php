<?php

namespace App\Http\Controllers;

/**
 * Controller representasi untuk entitas Example/Barang sesuai spesifikasi UTS PBO.
 * Mengimplementasikan seluruh fungsionalitas CRUD berbasis Session.
 */
class ExampleController extends BarangController
{
    // Mewarisi semua logika CRUD berbasis session dari BarangController
    // Termasuk: index(), create(), store(), show($kode), edit($kode), update($kode), destroy($kode)
}
