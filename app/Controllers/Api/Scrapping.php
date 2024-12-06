<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ReportModel;
use GuzzleHttp\Client;
use Config\Services;

class Scrapping extends \App\Controllers\BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->reportModel = new ReportModel;
        $this->session = session();
    }

    public function pdfScapper(){
        try {
            $client = new Client();
            $url = 'https://catalog.data.gov/dataset/?q=&sort=views_recent+desc&res_format=PDF';

            // Fetch the webpage
            $response = $client->get($url);
            $html = $response->getBody()->getContents();

            // Parse the HTML
            $dom = new \DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);

            // Extract dataset titles and PDF links
            $pdfLinks = [];
            foreach ($xpath->query("//a[contains(@href, '.pdf')]") as $link) {
                $titleNode = $link->parentNode->parentNode->parentNode->getElementsByTagName('h3')->item(0);
                $title = $titleNode ? trim($titleNode->textContent) : 'No Title';
                $pdfLinks[] = [
                    'title' => $title,
                    'url'   => $link->getAttribute('href'),
                ];
            }

            foreach($pdfLinks as $pdf){
                $client = Services::curlrequest();
                $response = $client->get($pdf['url']);
        
                $fileName = basename($pdf['url']);
                $localFilePath = WRITEPATH . 'uploads/'.$fileName;
                if ($response->getStatusCode() === 200) {
                    file_put_contents($localFilePath, $response->getBody());
                    $data = [
                        'file_name' => $fileName,
                        'file_path' => 'uploads/'.$fileName,
                    ];
                    $this->reportModel->insert($data);
                } else {
                    
                }
            }

            $response = [
                'status' => 'success',
                'data' => $pdfLinks
            ];
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


}