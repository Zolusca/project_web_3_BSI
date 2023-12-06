<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/register', 'AccountManagement\UserRegister::registerView');
$routes->get('/login', 'AccountManagement\UserLogin::loginView');
$routes->post('/register', 'AccountManagement\UserRegister::postRegister');
$routes->post('/login', 'AccountManagement\UserLogin::postLogin');


$routes->group('/pengelolaproduk/dashboard',['filter'=>'myauth'],function ($routes){
    // add Product
    $routes->post('tambahproduk','Person\ProductManager\ProdukManagerActivity::insertingProduct');
    $routes->get('tambahproduk','Person\ProductManager\ProductManagerView::addProductView');
    // produk view
    $routes->get('listproduk','Person\ProductManager\ProductManagerView::listProductView');
    $routes->get('detailproduk/(:any)','Person\ProductManager\ProductManagerView::detailProductView/$1');
    // add penyalur
    $routes->get('tambahpenyalur','Person\ProductManager\ProductManagerView::addPenyalurView');
    $routes->post('tambahpenyalur','Person\ProductManager\ProdukManagerActivity::insertingPenyalur');
    // edit data
    $routes->post('editdataproduk','Person\ProductManager\ProductManagerView::editProductDataView');
    $routes->post('produkedit','Person\ProductManager\ProdukManagerActivity::editProductData');
    // delete data
    $routes->post('deleteproduk','Person\ProductManager\ProdukManagerActivity::deleteProductData');
    // list order
    $routes->get('ordertemp','Person\ProductManager\ProductManagerView::listOrderTemporaryView');
    $routes->get('listorder','Person\ProductManager\ProductManagerView::listOrderView');
    //ordering
    $routes->get('requestorder','Person\ProductManager\ProductManagerView::formRequestOrderView');
    $routes->post('requestorder','Person\ProductManager\ProdukManagerActivity::requestOrder');
    $routes->post('cancelorder','Person\ProductManager\ProdukManagerActivity::cancelOrderRequest');
    // other
    $routes->get('','Person\ProductManager\ProductManagerView::mainDashboardView');
    $routes->get('laporanproduk','Laporan\ProductManagerLaporan::laporanDataProduk');
});

$routes->group('/pengelolakeuangan/dashboard',['filter'=>'myauth'],function ($routes){
    // transaksi
    $routes->get('listorder','Person\FinancialManager\FinancialManagerView::listOrderView');
    $routes->get('listtransaksi','Person\FinancialManager\FinancialManagerView::listTransaksiView');
    $routes->get('formtransaksi','Person\FinancialManager\FinancialManagerView::formTransaksiView');
    $routes->post('rejectorder','Person\FinancialManager\FinancialManagerActivity::rejectedOrder');
    $routes->post('acceptedorder','Person\FinancialManager\FinancialManagerActivity::acceptedOrder');
    $routes->post('transaction','Person\FinancialManager\FinancialManagerActivity::transactionProcess');

    // other
    $routes->get('','Person\FinancialManager\FinancialManagerView::mainDashboardView');
    $routes->get('invoice/(:any)','Person\FinancialManager\FinancialManagerView::invoiceView/$1');
    $routes->get('laporantransaksi','Laporan\FinancialManagerLaporan::laporanTransaksi');
});

$routes->group('/pengelolagudang/dashboard',['filter'=>'myauth'],function ($routes){
    // other
    $routes->get('','Person\WarehouseManager\WarehouseManagerView::mainDashboardView');
    $routes->get('laporangudang','Laporan\WarehouseManagerLaporan::laporanWarehouse');
    $routes->get('laporanpenerimaan','Laporan\WarehouseManagerLaporan::laporanPenerimaanProduk');

    // list
    $routes->get('listprodukgudang','Person\WarehouseManager\WarehouseManagerView::listProdukGudangView');
    $routes->get('listordertemporary','Person\WarehouseManager\WarehouseManagerView::listOrderTemporaryView');
    $routes->get('listorderrequest','Person\WarehouseManager\WarehouseManagerView::listOrderRequestView');

    // activity
    $routes->get('mengeluarkanproduk','Person\WarehouseManager\WarehouseManagerView::takeOutProductView');
    $routes->post('mengeluarkanproduk','Person\WarehouseManager\WarehouseManagerActivity::takeOutProduct');
    $routes->post('orderpenambahanproduk','Person\WarehouseManager\WarehouseManagerActivity::orderTemporaryRequest');
    $routes->post('cancelordertemporary','Person\WarehouseManager\WarehouseManagerActivity::cancelOrderTemporary');
    $routes->post('shipmentproduct','Person\WarehouseManager\WarehouseManagerActivity::shipmentProductProcess');
});

$routes->get('download/(:any)','Home::download/$1');
$routes->get('/test','Home::index');
