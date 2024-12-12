<?php
namespace App\Models;

use CodeIgniter\Model;

class SirupModel extends Model
{
    protected $DBGroup = 'default';
    protected $primaryKey = 'id';

    public function getReportData($tahun, $report){
        if($report == 'rekap'){
            return $this->getSirupRekap($tahun);
        } else if($report == 'penyedia'){
            return $this->getSirupPenyedia($tahun);
        } else if($report == 'swakelola'){
            return $this->getSirupSwakelola($tahun);
        }
    }

    private function getSirupRekap($tahun){
        $db = \Config\Database::connect();
        $query = "SELECT a.satker_code, a.satker_name, a.penyedia_paket, a.penyedia_pagu, a.swakelola_paket, a.swakelola_pagu, 
                a.penyedia_dalam_swakelola_paket, a.penyedia_dalam_swakelola_pagu, a.total_paket, a.total_pagu
                from sirup_rekap a
                where a.tahun = $tahun
                order by a.satker_name asc";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

    private function getSirupPenyedia($tahun){
        $db = \Config\Database::connect();
        $query = "SELECT a.satker_id, b.satker_name, a.paket_id, a.paket_name, a.pagu, a.metode_pemilihan, a.sumber_dana, 
                a.produk_dalam_negeri, a.usaha_kecil_koperasi, a.mak, a.jenis_pengadaan
                from sirup_penyedia a
                join sirup_rekap b on b.satker_id = a.satker_id
                where a.tahun = $tahun
                order by b.satker_name asc";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

    private function getSirupSwakelola($tahun){
        $db = \Config\Database::connect();
        $query = "SELECT a.satker_id, b.satker_name, a.paket_id, a.paket_name, a.kegiatan, a.pagu, a.tipe_swakelola, a.mak
                from sirup_swakelola a
                join sirup_rekap b on b.satker_id = a.satker_id
                where a.tahun = $tahun
                order by b.satker_name asc";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

}