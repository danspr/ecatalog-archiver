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
        } else if ($report == 'rekap_updated'){
            return $this->getSirupRekapUpdated($tahun);
        } else if($report == 'penyedia'){
            return $this->getSirupPenyedia($tahun);
        } else if($report == 'swakelola'){
            return $this->getSirupSwakelola($tahun);
        } else if($report == 'penyedia_dalam_swakelola'){
            return $this->getSirupPenyediaDalamSwakelola($tahun);
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

    private function getSirupRekapUpdated($tahun){
        $db = \Config\Database::connect();
        $query = "SELECT a.satker_code as satker_code, a.satker_name as satker_name, 
                        IFNULL(b.total_paket, 0) as 'sirup_penyedia_paket', IFNULL(b.total_pagu, 0) as 'sirup_penyedia_pagu', 
                        IFNULL(c.total_paket, 0) as 'sirup_swakelola_paket', IFNULL(c.total_pagu, 0) as 'sirup_swakelola_pagu', 
                        IFNULL(d.total_paket, 0) as 'sirup_penyedia_dalam_swakelola_paket', IFNULL(d.total_pagu, 0) as 'sirup_penyedia_dalam_swakelola_pagu', 
                        (IFNULL(b.total_paket, 0) + IFNULL(c.total_paket, 0) + IFNULL(d.total_paket, 0)) as 'sirup_total_paket',
                        (IFNULL(b.total_pagu, 0) + IFNULL(c.total_pagu, 0) + IFNULL(d.total_pagu, 0)) as 'sirup_total_pagu'
                from sirup_rekap a
                left join (select satker_id, count(id) as total_paket, sum(pagu) as total_pagu from sirup_penyedia where tahun = $tahun group by satker_id) 
                    as b on b.satker_id = a.satker_id 
                left join (select satker_id, count(id) as total_paket, sum(pagu) as total_pagu from sirup_swakelola where tahun = $tahun group by satker_id) 
                    as c on c.satker_id = a.satker_id 
                left join (select satker_id, count(id) as total_paket, sum(pagu) as total_pagu from sirup_penyedia_dalam_swakelola where tahun = $tahun group by satker_id) as d on d.satker_id = a.satker_id 
                where a.tahun = $tahun order by a.satker_name";
         $result = $db->query($query)->getResultArray();
         return $result;
    }

    private function getSirupPenyedia($tahun){
        $db = \Config\Database::connect();
        $query = "SELECT b.satker_code, b.satker_name, a.paket_id, a.paket_name, a.pagu, a.metode_pemilihan, a.sumber_dana, 
                a.produk_dalam_negeri, a.usaha_kecil_koperasi, a.mak, a.jenis_pengadaan
                from sirup_penyedia a
                join sirup_rekap b on b.satker_id = a.satker_id and b.tahun = $tahun
                where a.tahun = $tahun
                order by b.satker_name asc";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

    private function getSirupSwakelola($tahun){
        $db = \Config\Database::connect();
        $query = "SELECT b.satker_code, b.satker_name, a.paket_id, a.paket_name, a.kegiatan, a.pagu, a.tipe_swakelola, a.mak
                from sirup_swakelola a
                join sirup_rekap b on b.satker_id = a.satker_id and b.tahun = $tahun
                where a.tahun = $tahun
                order by b.satker_name asc";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

    private function getSirupPenyediaDalamSwakelola($tahun){
        $db = \Config\Database::connect();
        $query = "SELECT a.satker_id, b.satker_name, a.paket_id, a.paket_name, a.pagu, a.metode_pemilihan, a.sumber_dana, a.mak
                from sirup_penyedia_dalam_swakelola a
                join sirup_rekap b on b.satker_id = a.satker_id and b.tahun = $tahun
                where a.tahun = $tahun
                order by b.satker_name asc";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

    public function getSirupPenyediaCount($tahun){
        $db = \Config\Database::connect();
        $builder = $db->table('sirup_penyedia');
        return $builder->where('tahun',$tahun)->countAllResults();
    }

    public function getSirupSwakelolaCount($tahun){
        $db = \Config\Database::connect();
        $builder = $db->table('sirup_swakelola');
        return $builder->where('tahun',$tahun)->countAllResults();
    }

}