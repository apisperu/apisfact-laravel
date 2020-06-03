<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Client;
use App\Product;
use App\SaleDetail;
use App\Legend;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $companyRuc = $request->input('companyRuc');
        $saleDataList = array();

        if ($companyRuc) {
            $saleDataList = Sale::where('companyRuc', '=', $companyRuc)->get();
        } else {
            $saleDataList = Sale::all();
        }

        $sales = array();
        foreach($saleDataList as $item) {
            $sales[] = self::prepareSaleResponse($item);
        }
        return $sales;
    }
 
    public function show($id)
    {
        $data = Sale::find($id);
        $data = self::prepareSaleResponse($data);
        return $data;
    }

    public function store(Request $request)
    {
        $clientRequest = $request['client'];
        // Get Client Id
        $clientData = Client::whereRaw('tipoDoc = ? and numDoc = ? and companyRuc = ?', array($clientRequest['tipoDoc'],$clientRequest['numDoc'],$request['company']['ruc']))->firstOrFail();
        $saleData = $request->all();
        $saleData['clientId'] = $clientData['id'];

        // Get Company RUC
        $saleData['companyRuc'] = $request['company']['ruc'];
        $saleData['companyRazonSocial'] = $request['company']['razonSocial'];
        $saleData['companyDireccion'] = $request['company']['address']['direccion'];
        $saleData['sunatResponse'] = $request['sunatResponse']['cdrResponse']['description'];

        unset($saleData['client']);
        unset($saleData['company']);
        unset($saleData['details']);
        unset($saleData['legends']);
        $data = Sale::create($saleData);

        // Save Detail
        $saleDetailDataList = $request['details'];

        foreach($saleDetailDataList as $item) {
            $detailData = $item;
            $detailData['saleId'] = $data['id'];

            // Get Product Id
            $productData = Product::whereRaw('codProducto = ? and companyRuc = ?', array($item['codProducto'],$request['company']['ruc']))->firstOrFail();
            $detailData['productId'] = $productData['id'];
            unset($detailData['codProducto']);
            unset($detailData['unidad']);
            unset($detailData['descripcion']);
            unset($detailData['mtoValorUnitario']);
            SaleDetail::create($detailData);
        }

        // Save Legend
        $legendDataList = $request['legends'];
        foreach($legendDataList as $item) {
            $legendData = $item;
            $legendData['saleId'] = $data['id'];
            Legend::create($legendData);
        }

        return $data->id;
    }

    private function prepareDetailResponse ($item, $productData) {
        $detail = $item;
        $detail['codProducto'] = $productData['codProducto'];
        $detail['unidad'] = $productData['unidad'];
        $detail['descripcion'] = $productData['descripcion'];
        $detail['mtoValorUnitario'] = $productData['mtoValorUnitario'];
        unset($detail['id']);
        unset($detail['saleId']);
        unset($detail['productId']);
        unset($detail['updated_at']);
        unset($detail['created_at']);
        return $detail;
    }

    private function prepareLegendResponse ($item) {
        $legend = (object) array('code' => $item['code'], 'value' => $item['value']);
        return $legend;
    }

    private function prepareSaleResponse($data) {
        $clientData = Client::find($data['clientId']);
        $data['client'] = $clientData;
        $data['client']['address'] = (object) array('direccion' => $data['client']['direccion']);

        // Company
        $data['company'] = (object) array('ruc' => $data['companyRuc'], 'razonSocial' => $data['companyRazonSocial'], 'address' => (object)array('direccion' => $data['companyDireccion']));

        // Details
        $detailDataList = SaleDetail::where('saleId', '=', $data['id'])->get();
        $details = array();
        foreach($detailDataList as $item) {
            $productData = Product::find($item['productId']);
            $details[] = self::prepareDetailResponse($item, $productData);
        }
        $data['details'] = $details;
        
        // Legends
        $legendDataList = Legend::where('saleId', '=', $data['id'])->get();
        $legends = array();
        
        foreach($legendDataList as $item) {
            $legends[] = self::prepareLegendResponse($item);
        }
        $data['legends'] = $legends;

        unset($data['client']['id']);
        unset($data['client']['direccion']);
        unset($data['client']['companyRuc']);
        unset($data['client']['updated_at']);
        unset($data['client']['created_at']);

        return $data;
    }
}
