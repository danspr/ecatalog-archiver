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

