<?php

namespace Tests\Feature;

use Tests\TestCase;

class BarangCrudTest extends TestCase
{
    /**
     * Uji halaman index menampilkan daftar barang dari session.
     */
    public function test_index_displays_barang_list()
    {
        $response = $this->get('/barang');
        $response->assertStatus(200);
        $response->assertSee('Daftar Inventaris Barang');
        $response->assertSee('BRG-001');
        $response->assertSee('Laptop ASUS ROG');
    }

    /**
     * Uji halaman create menampilkan form tambah barang.
     */
    public function test_create_displays_form()
    {
        $response = $this->get('/barang/create');
        $response->assertStatus(200);
        $response->assertSee('Tambah Inventaris Barang');
        $response->assertSee('Kode Barang');
    }

    /**
     * Uji store berhasil menyimpan data ke session dan redirect.
     */
    public function test_store_saves_item_to_session()
    {
        $response = $this->post('/barang', [
            'kode' => 'BRG-099',
            'nama' => 'Drone DJI Mavic 3',
            'kategori' => 'Elektronik',
            'lokasi' => 'Studio Multimedia',
            'jumlah' => 2,
            'kondisi' => 'Baik',
            'deskripsi' => 'Untuk dokumentasi udara.',
        ]);

        $response->assertRedirect('/barang');
        $response->assertSessionHas('success');
        $response->assertSessionHas('data_barang');

        // Pastikan barang yang baru tersimpan di session
        $items = session('data_barang');
        $found = false;
        foreach ($items as $item) {
            if ($item['kode'] === 'BRG-099') {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found);
    }

    /**
     * Uji show menampilkan detail barang berdasarkan kode.
     */
    public function test_show_displays_item_detail()
    {
        $response = $this->get('/barang/BRG-001');
        $response->assertStatus(200);
        $response->assertSee('Detail Informasi Barang');
        $response->assertSee('BRG-001');
        $response->assertSee('Laptop ASUS ROG Zephyrus');
    }

    /**
     * Uji show dengan kode yang tidak ada redirect ke index dengan error message.
     */
    public function test_show_nonexistent_item_redirects()
    {
        $response = $this->get('/barang/KODE-TIDAK-ADA');
        $response->assertRedirect('/barang');
        $response->assertSessionHas('error');
    }

    /**
     * Uji edit menampilkan form edit dengan data awal.
     */
    public function test_edit_displays_form_with_current_data()
    {
        $response = $this->get('/barang/BRG-002/edit');
        $response->assertStatus(200);
        $response->assertSee('Edit Inventaris: BRG-002');
        $response->assertSee('Proyektor Epson EB-X500');
    }

    /**
     * Uji update memperbarui data pada session.
     */
    public function test_update_modifies_item_in_session()
    {
        // Panggil index dulu agar session terisi
        $this->get('/barang');

        $response = $this->put('/barang/BRG-002', [
            'nama' => 'Proyektor Epson EB-X500 Updated',
            'kategori' => 'Elektronik',
            'lokasi' => 'Ruang Teori 302',
            'jumlah' => 5,
            'kondisi' => 'Baik',
            'deskripsi' => 'Lensa baru diganti.',
        ]);

        $response->assertRedirect('/barang');
        $response->assertSessionHas('success');

        $items = session('data_barang');
        $updated = null;
        foreach ($items as $item) {
            if ($item['kode'] === 'BRG-002') {
                $updated = $item;
                break;
            }
        }
        $this->assertNotNull($updated);
        $this->assertEquals('Proyektor Epson EB-X500 Updated', $updated['nama']);
        $this->assertEquals(5, $updated['jumlah']);
    }

    /**
     * Uji destroy menghapus data dari session.
     */
    public function test_destroy_removes_item_from_session()
    {
        $this->get('/barang');

        $response = $this->delete('/barang/BRG-003');
        $response->assertRedirect('/barang');
        $response->assertSessionHas('success');

        $items = session('data_barang');
        $found = false;
        foreach ($items as $item) {
            if ($item['kode'] === 'BRG-003') {
                $found = true;
                break;
            }
        }
        $this->assertFalse($found);
    }

    /**
     * Uji routing example alias bekerja serupa.
     */
    public function test_example_routes_alias_working()
    {
        $response = $this->get('/example');
        $response->assertStatus(200);
        $response->assertSee('Daftar Inventaris Barang');
    }
}
