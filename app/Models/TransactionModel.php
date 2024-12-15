<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'epurchasing_transaction';
    protected $primaryKey = 'id';

    public function getTransaction($where){
        $db = \Config\Database::connect();
        $builder = $db->table('epurchasing_transaction a');
        $builder->select('a.pengelola,
                a.instansi_pembeli,
                a.satuan_kerja,
                a.jenis_katalog,
                a.etalase,
                a.tanggal_paket,
                a.nomor_paket,
                a.nama_paket,
                a.rup_id,nama_manufaktur,
                a.kategori_lv1,
                a.kategori_lv2,
                a.nama_produk,
                a.jenis_produk,
                a.nama_penyedia,
                a.status_umkm,
                a.nama_pelaksana_pekerjaan,
                a.status_paket,
                a.kuantitas_produk,
                a.harga_satuan_produk,
                a.harga_ongkos_kirim,
                a.total_harga_produk,
                b.tkdn,b.bmp,b.tkdn_bmp');
        // $builder->from('epurchasing_transaction a');
        $builder->join('product b', 'a.nama_produk=b.product_name AND a.nama_penyedia=b.supplier_name', 'LEFT');
        $builder->where($where);
        $builder->orderBy('a.tanggal_paket', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getNamaPaket($nomorPaket){
        $db = \Config\Database::connect();
        $query = "SELECT distinct nomor_paket from epurchasing_transaction 
                where nomor_paket like ? order by nomor_paket asc";
        $result = $db->query($query, ['%' . $nomorPaket . '%'])->getResultArray();
        return $result;
    }

    public function getSatkerName($satker){
        $db = \Config\Database::connect();
        $query = "SELECT distinct satuan_kerja from epurchasing_transaction 
                where satuan_kerja like ? order by satuan_kerja asc";
        $result = $db->query($query, ['%' . $satker . '%'])->getResultArray();
        return $result;
    }

    public function getDashboardOverview($period){
        $db = \Config\Database::connect();
        $results = [];
        $satuanKerjaGroups = ['TNI AD', 'TNI AU', 'TNI AL'];

        if ($period === 'last_week') {
            // Generate the last 7 days
            $labels = [];
            $counts = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $labels[] = $date;
                $counts[] = $date;
            }

            $results["label"] = $labels;

            foreach ($satuanKerjaGroups as $satuanKerja) {
                $groupCounts = [];

                foreach ($counts as $date) {
                    // Query for each day
                    $query = "
                        SELECT COUNT(*) AS total
                        FROM `epurchasing_transaction`
                        WHERE DATE(`tanggal_paket`) = ?
                          AND `satuan_kerja` LIKE ?
                    ";
                    $result = $db->query($query, [$date, '%' . $satuanKerja . '%'])->getRowArray();

                    $groupCounts[] = (int)$result['total'];
                }

                $key = strtolower(str_replace(' ', '_', $satuanKerja));
                $results[$key] = $groupCounts;
            }
        } elseif ($period === 'last_month') {
            // Generate the last 30 days
            $labels = [];
            $counts = [];
            for ($i = 29; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $labels[] = $date;
                $counts[] = $date;
            }

            $results["label"] = $labels;

            foreach ($satuanKerjaGroups as $satuanKerja) {
                $groupCounts = [];

                foreach ($counts as $date) {
                    // Query for each day
                    $query = "
                        SELECT COUNT(*) AS total
                        FROM `epurchasing_transaction`
                        WHERE DATE(`tanggal_paket`) = ?
                          AND `satuan_kerja` LIKE ?
                    ";
                    $result = $db->query($query, [$date, '%' . $satuanKerja . '%'])->getRowArray();

                    $groupCounts[] = (int)$result['total'];
                }

                $key = strtolower(str_replace(' ', '_', $satuanKerja));
                $results[$key] = $groupCounts;
            }
        } elseif ($period === 'last_year') {
            // Generate the last 12 months
            $labels = [];
            $counts = [];
            $currentMonth = date('Y-m-01'); // Start of the current month
            for ($i = 0; $i < 12; $i++) {
                $monthStart = date('Y-m-01', strtotime("-$i months", strtotime($currentMonth)));
                $monthLabel = date('M Y', strtotime($monthStart)); // e.g., "Dec 2024"
                $labels[] = $monthLabel;
                $counts[] = $monthStart;
            }
            $labels = array_reverse($labels); // Reverse to start from the earliest month
            $counts = array_reverse($counts);

            $results["label"] = $labels;

            foreach ($satuanKerjaGroups as $satuanKerja) {
                // Initialize counts array with 0 for each month
                $groupCounts = array_fill(0, count($labels), 0);

                foreach ($counts as $index => $monthStart) {
                    $monthEnd = date('Y-m-t', strtotime($monthStart)); // Get last day of the month

                    // Query for data in the month
                    $query = "
                        SELECT COUNT(*) AS total
                        FROM `epurchasing_transaction`
                        WHERE `tanggal_paket` BETWEEN ? AND ?
                          AND `satuan_kerja` LIKE ?
                    ";
                    $result = $db->query($query, [$monthStart, $monthEnd, '%' . $satuanKerja . '%'])->getRowArray();

                    $groupCounts[$index] = (int)$result['total'];
                }

                $key = strtolower(str_replace(' ', '_', $satuanKerja));
                $results[$key] = $groupCounts;
            }
        }
        return $results;
    }

}

