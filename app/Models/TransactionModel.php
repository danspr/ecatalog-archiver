<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'epurchasing_transaction';
    protected $primaryKey = 'id';

    public function getTransaction($startDate, $endDate, $satuanKerja){
        $fieldSelected = 'pengelola,instansi_pembeli,satuan_kerja,jenis_katalog,etalase,tanggal_paket,nomor_paket,nama_paket,rup_id,nama_manufaktur,kategori_lv1,kategori_lv2,nama_produk,jenis_produk,nama_penyedia,status_umkm,nama_pelaksana_pekerjaan,status_paket,kuantitas_produk,harga_satuan_produk,harga_ongkos_kirim,total_harga_produk';
        $db = \Config\Database::connect();
        $builder = $db->table('epurchasing_transaction');
        $builder->select($fieldSelected);
        $builder->where([
            'cast(tanggal_paket as date) >= ' => $startDate,
            'cast(tanggal_paket as date) <=' => $endDate,
        ]);
        $builder->like('satuan_kerja', $satuanKerja, 'both');
        $query = $builder->get();
        return $query->getResultArray();
    }

}

