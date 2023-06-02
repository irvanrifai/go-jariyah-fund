<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routing for start session user or admin
Route::get('/', [Controllers\anggota\DashboardController::class, 'loginUser'])->middleware('guest')->name('/');
Route::get('/admin', [Controllers\admin\AdminController::class, 'index'])->middleware('guest')->name('admin');

// attempt login
Route::post('/user-login', [Controllers\Auth\LoginController::class, 'loginUser'])->middleware('guest')->name('user-login');
Route::post('/admin-login', [Controllers\Auth\LoginController::class, 'loginAdmin'])->middleware('guest')->name('admin-login');

// end session
Route::post('/user-logout', [Controllers\Auth\LoginController::class, 'logoutUser'])->name('user-logout');
Route::post('/admin-logout', [Controllers\Auth\LoginController::class, 'logoutAdmin'])->name('admin-logout');

Route::group([
    'prefix' => 'admin',
    'as'    => 'admin.',
    'middleware' => ['auth:admin']
], function () {
    Route::get('dashboard', [Controllers\admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('detail-request-pinjam/{id}', [Controllers\admin\AdminController::class, 'detailRequestPinjam'])->name('detail-request-pinjam');

    //DUTA
    Route::get('/duta-wakaf-list', [Controllers\admin\AdminController::class, 'dutaWakafList'])->name('duta-wakaf-list');
    Route::get('/data-dutawakaf', [Controllers\admin\AdminController::class, 'getDutaWakaf'])->name('data-dutawakaf');
    Route::get('totalduta', [Controllers\admin\AdminController::class, 'totalduta'])->name('totalduta');
    Route::get('select2-duta', [Controllers\admin\AdminController::class, 'select2dutaname'])->name('select2-duta');
    Route::get('select2-village', [Controllers\admin\AdminController::class, 'select2village'])->name('select2-village');
    Route::get('select2-kec', [Controllers\admin\AdminController::class, 'select2kec'])->name('select2-kec');
    Route::get('select2-project', [Controllers\admin\AdminController::class, 'select2project'])->name('select2-project');
    Route::get('select2-group', [Controllers\admin\AdminController::class, 'select2group'])->name('select2-group');

    // APPROVAL PENDAMPING
    Route::get('/approval-pendamping/request-pinjam', [Controllers\admin\PendampingController::class, 'index'])->name('approval-pendamping.request-pinjam');
    Route::get('/approval-pendamping/data-approve', [Controllers\admin\PendampingController::class, 'dataApprove'])->name('approval-pendamping.data-approve');
    Route::get('/approval-pendamping/detail-request-pinjam-anggota/{id}', [Controllers\admin\PendampingController::class, 'detailRequestPinjamAnggota'])->name('approval-pendamping.detail-request-pinjam-anggota');
    Route::get('/approval-pendamping/select2-pendamping', [Controllers\admin\PendampingController::class, 'select2Pendamping'])->name('approval-pendamping.select2-pendamping');
    Route::get('/approval-pendamping/edit-approval-pinjam/{id}', [Controllers\admin\PendampingController::class, 'editApprovalPinjam'])->name('approval-pendamping.edit-approval-pinjam');
    Route::post('/approval-pendamping/create-update-approval-pinjam', [Controllers\admin\PendampingController::class, 'createUpdateApprovalPinjam'])->name('approval-pendamping.create-update-approval-pinjam');
    Route::post('/approval-pendamping/remove-approval-pinjam', [Controllers\admin\PendampingController::class, 'removeApprovalPinjam'])->name('approval-pendamping.remove-approval-pinjam');

    // APPROVAL NAZHIR
    Route::get('/approval-nazhir/request-pinjam', [Controllers\admin\NazhirController::class, 'index'])->name('approval-nazhir.request-pinjam');
    Route::get('/approval-nazhir/data-approve', [Controllers\admin\NazhirController::class, 'dataApprove'])->name('approval-nazhir.data-approve');
    Route::get('/approval-nazhir/detail-request-pinjam-anggota/{id}', [Controllers\admin\NazhirController::class, 'detailRequestPinjamAnggota'])->name('approval-nazhir.detail-request-pinjam-anggota');
    Route::get('/approval-nazhir/select2-nazhir', [Controllers\admin\NazhirController::class, 'select2Nazhir'])->name('approval-nazhir.select2-nazhir');
    Route::get('/approval-nazhir/edit-approval-pinjam/{id}', [Controllers\admin\NazhirController::class, 'editApprovalPinjam'])->name('approval-nazhir.edit-approval-pinjam');
    Route::post('/approval-nazhir/create-update-approval-pinjam', [Controllers\admin\NazhirController::class, 'createUpdateApprovalPinjam'])->name('approval-nazhir.create-update-approval-pinjam');
    Route::post('/approval-nazhir/remove-approval-pinjam', [Controllers\admin\NazhirController::class, 'removeApprovalPinjam'])->name('approval-nazhir.remove-approval-pinjam');

    // APPROVAL ADMIN
    Route::post('/update-approval-pinjam', [Controllers\admin\AdminController::class, 'UpdateApprovalPinjam'])->name('update-approval-pinjam');


    //PENGAJUAN PINJAM
    Route::get('/approval-admin/request-pinjam', [Controllers\admin\AdminController::class, 'requestPinjam'])->name('approval-admin.request-pinjam');
    Route::get('/pengajuanpinjam/pengajuanpinjam', [Controllers\admin\AdminController::class, 'pengajuanpinjam'])->name('pengajuanpinjam.pengajuanpinjam');
    Route::get('/lihatlistapproval/{id}', [Controllers\admin\AdminController::class, 'lihatlistaproval'])->name('lihatlistapproval');

    //CICILAN
    Route::get('/approval-admin/request-cicilan', [Controllers\admin\AdminController::class, 'requestCicilan'])->name('approval-admin.request-cicilan');
    Route::get('/data-cicilan', [Controllers\admin\AdminController::class, 'dataCicilan'])->name('data-cicilan');
    Route::get('/detail-cicilan/{id}', [Controllers\admin\AdminController::class, 'detailCicilan'])->name('detail-cicilan');

    // TRACKING
    Route::get('get-tracking-pinjaman/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'getTrackingPinjaman'])->name('get-tracking-pinjaman');
    Route::get('check-is-step-one-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepOneComplete'])->name('check-is-step-one-complete');
    Route::get('check-is-step-two-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepTwoComplete'])->name('check-is-step-two-complete');
    Route::get('check-is-step-three-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepThreeComplete'])->name('check-is-step-three-complete');
    Route::get('check-is-step-four-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepFourComplete'])->name('check-is-step-four-complete');
    Route::get('check-is-step-five-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepFiveComplete'])->name('check-is-step-five-complete');
    Route::get('check-is-step-six-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepSixComplete'])->name('check-is-step-six-complete');

    //DANA MASUK
    Route::get('/fund/incoming', [Controllers\admin\AdminController::class, 'fundIncoming'])->name('fund.incoming');
    Route::get('/data-dana-masuk', [Controllers\admin\AdminController::class, 'dataDanaMasuk'])->name('data-dana-masuk');

    //DANA TERPAKAI
    Route::get('/fund/used', [Controllers\admin\AdminController::class, 'fundUsed'])->name('fund-used');

    //LIST ANGGOTA
    Route::get('tampilanlistanggota', [Controllers\admin\AdminController::class, 'listAnggota'])->name('tampilanlistanggota');
    Route::get('data-list-anggota', [Controllers\admin\AdminController::class, 'dataListAnggota'])->name('data-list-anggota');
    Route::get('add-list-anggota', [Controllers\admin\AdminController::class, 'addListAnggota'])->name('add-list-anggota');

    //GROUP
    Route::get('/group', [Controllers\admin\AdminController::class, 'group'])->name('group');
    Route::get('/data-group', [Controllers\admin\AdminController::class, 'dataGroup'])->name('data-group');
    Route::get('/add-group', [Controllers\admin\AdminController::class, 'addGroup'])->name('add-group');
    Route::post('/create-group', [Controllers\admin\AdminController::class, 'createGroup'])->name('create-group');
    Route::get('/hapus-group/{id}', [Controllers\admin\AdminController::class, 'deleteGroup'])->name('hapus-group');
    Route::get('/detail-group/{id}', [Controllers\admin\AdminController::class, 'detailGroup'])->name('detail-group');
    Route::get('/edit-group/{id}', [Controllers\admin\AdminController::class, 'editGroup'])->name('edit-group');
    Route::post('/update-group', [Controllers\admin\AdminController::class, 'updateGroup'])->name('update-group');
    Route::get('/data-anggota-in-group/{id}', [Controllers\admin\AdminController::class, 'dataAnggotaInGroup'])->name('data-anggota-in-group');
    Route::post('/add-anggota-to-group', [Controllers\admin\AdminController::class, 'addAnggotaToGroup'])->name('add-anggota-to-group');
    Route::get('/edit-anggota-in-group/{id}', [Controllers\admin\AdminController::class, 'editAnggotaInGroup'])->name('edit-anggota-in-group');
    Route::post('/update-anggota-in-group', [Controllers\admin\AdminController::class, 'updateAnggotaInGroup'])->name('update-anggota-in-group');
    Route::post('/remove-anggota-from-group/{id}', [Controllers\admin\AdminController::class, 'removeAnggotaFromGroup'])->name('remove-anggota-from-group');

    //NAZHIR
    Route::get('/nazhir-list', [Controllers\admin\AdminController::class, 'nazhirList'])->name('nazhir-list');
    Route::get('data-nazhir', [Controllers\admin\AdminController::class, 'getNazhir'])->name('data-nazhir');

    //PROJEK
    Route::get('project-list', [Controllers\admin\AdminController::class, 'projectList'])->name('project-list');
    Route::get('data-project', [Controllers\admin\AdminController::class, 'getProject'])->name('data-project');

    // MENU PENDAMPING
    Route::get('/pendamping-list', [Controllers\admin\AdminController::class, 'getPendamping'])->name('pendamping-list');
    Route::get('/data-pendamping', [Controllers\admin\AdminController::class, 'dataPendamping'])->name('data-pendamping');
    Route::post('/create-update-pendamping', [Controllers\admin\AdminController::class, 'createUpdatePendamping'])->name('create-update-pendamping');
    Route::get('/edit-pendamping/{id}', [Controllers\admin\AdminController::class, 'editPendamping'])->name('edit-pendamping');
    Route::get('/hapus-pendamping/{id}', [Controllers\admin\AdminController::class, 'deletePendamping'])->name('hapus-pendamping');

    //SETTING
    Route::get('/setting', [Controllers\admin\AdminController::class, 'getSetting'])->name('setting');
    Route::get('/data-setting', [Controllers\admin\AdminController::class, 'dataSetting'])->name('data-setting');
    Route::post('/create-update-setting', [Controllers\admin\AdminController::class, 'createUpdateSetting'])->name('create-update-setting');
    Route::get('/edit-setting/{id}', [Controllers\admin\AdminController::class, 'editSetting'])->name('edit-setting');
    Route::get('/hapus-setting/{id}', [Controllers\admin\AdminController::class, 'deleteSetting'])->name('hapus-setting');

    //SHOW DETAIL
    Route::get('/detail-duta/{id}', [Controllers\admin\AdminController::class, 'detailDuta'])->name('detail-duta');
    Route::get('/detail-nazhir/{id}', [Controllers\admin\AdminController::class, 'detailNazhir'])->name('detail-nazhir');
    Route::get('/detail-project/{id}', [Controllers\admin\AdminController::class, 'detailProject'])->name('detail-project');

    Route::get('/detail-list-anggota/{id}', [Controllers\admin\AdminController::class, 'detailListAnggota'])->name('detail-list-anggota');
    Route::get('/edit-list-anggota/{id}', [Controllers\admin\AdminController::class, 'editListAnggota'])->name('edit-list-anggota');
    Route::get('update-list-anggota', [Controllers\admin\AdminController::class, 'updateListAnggota'])->name('update-list-anggota');
    Route::get('/hapus-list-anggota/{id}', [Controllers\admin\AdminController::class, 'deleteListAnggota'])->name('hapus-list-anggota');
    Route::get('/detail-request-pinjam-anggota/{id}', [Controllers\admin\AdminController::class, 'detailRequestPinjamAnggota'])->name('detail-request-pinjam-anggota');

    Route::get('/detailpengajuanpinjam/{id}', [Controllers\admin\AdminController::class, 'detailpengajuanpinjam'])->name('detailpengajuanpinjam');
    Route::get('/edit-pengajuanpinjam/{id}', [Controllers\admin\AdminController::class, 'editpengajuanpinjam'])->name('edit-pengajuanpinjam');
    Route::get('/update-pengajuanpinjam', [Controllers\admin\AdminController::class, 'update'])->name('update-pengajuanpinjam');
    Route::get('/hapuspengajuanpinjam/{id}', [Controllers\admin\AdminController::class, 'deletepengajuanpinjam'])->name('hapuspengajuanpinjam');

    Route::get('/detailcicilan/{id}', [Controllers\admin\AdminController::class, 'detailcicilan'])->name('detailcicilan');
    Route::get('/editcicilan/{id}', [Controllers\admin\AdminController::class, 'editcicilan'])->name('editcicilan');
    Route::get('/hapuscicil/{id}', [Controllers\admin\AdminController::class, 'hapuscicil'])->name('hapuscicil');
    Route::post('/updatecicilan', [Controllers\admin\AdminController::class, 'updatecicil'])->name('updatecicilan');

    // DETAIL ALL APPROVAL ON PINJAM
    Route::get('/list-detail-approval-anggota/{id}', [Controllers\admin\AdminController::class, 'listDetailApprovalAnggota'])->name('list-detail-approval-anggota');
    Route::get('/list-detail-approval-pendamping/{id}', [Controllers\admin\AdminController::class, 'listDetailApprovalPendamping'])->name('list-detail-approval-pendamping');
    Route::get('/list-detail-approval-nazhir/{id}', [Controllers\admin\AdminController::class, 'listDetailApprovalNazhir'])->name('list-detail-approval-nazhir');
    Route::get('/list-detail-approval-admin/{id}', [Controllers\admin\AdminController::class, 'listDetailApprovalAdmin'])->name('list-detail-approval-admin');

    Route::get('/data-list-cicilan/{id}', [Controllers\admin\AdminController::class, 'dataListCicilan'])->name('data-list-cicilan');
});

Route::prefix('anggota')->group(function () {
    Auth::routes(['register' => true]);
});

Route::group([
    'prefix'     => 'anggota',
    'as'         => 'anggota.',
    'middleware' => ['auth:user']
], function () {
    // for login
    Route::get('/', [Controllers\anggota\DashboardController::class, 'loginUser']);

    // route for auth/no-auth anggota only
    Route::get('/dashboard', [Controllers\anggota\DashboardController::class, 'index'])->name('dashboard');

    // DATA CHART
    Route::get('chart-pinjaman-aktif-anda', [Controllers\anggota\DashboardController::class, 'chartPinjamanAktifAnda'])->name('chart-pinjaman-aktif-anda');
    Route::get('chart-akumulasi-anda', [Controllers\anggota\DashboardController::class, 'chartAkumulasiAnda'])->name('chart-akumulasi-anda');
    Route::get('chart-pengumpulan-dana-wakaf-all', [Controllers\anggota\DashboardController::class, 'chartPengumpulanDanaWakafAll'])->name('chart-pengumpulan-dana-wakaf-all');
    Route::get('chart-peminjaman-dana-wakaf-all', [Controllers\anggota\DashboardController::class, 'chartPeminjamanDanaWakafAll'])->name('chart-peminjaman-dana-wakaf-all');
    Route::get('chart-pinjaman-aktif-all', [Controllers\anggota\DashboardController::class, 'chartPinjamanAktifAll'])->name('chart-pinjaman-aktif-all');
    Route::get('chart-akumulasi-all', [Controllers\anggota\DashboardController::class, 'chartAkumulasiAll'])->name('chart-akumulasi-all');

    Route::get('/indexdetail/{id}', [Controllers\anggota\CicilanController::class, 'index'])->name('indexdetail');
    Route::get('/editcicil/{id}', [Controllers\anggota\CicilanController::class, 'edit'])->name('editcicil');
    Route::post('/updatecicil/{id}', [Controllers\anggota\CicilanController::class, 'update'])->name('updatecicil');
    Route::get('/detailcicil/{id}', [Controllers\anggota\CicilanController::class, 'detail'])->name('detailcicil');

    //ADD CICIL
    Route::get('/data-list-cicilan/{id}', [Controllers\anggota\CicilanController::class, 'dataListCicilan'])->name('data-list-cicilan');
    Route::get('/add-cicil', [Controllers\anggota\CicilanController::class, 'addCicil'])->name('add-cicil');
    Route::post('/create-cicilan', [Controllers\anggota\CicilanController::class, 'createCicilan'])->name('create-cicilan');
    Route::get('/detail-cicilan/{id}', [Controllers\anggota\CicilanController::class, 'detailCicilan'])->name('detail-cicilan');

    //PENGAJUAN PINJAMAN
    Route::get('/pinjam/my', [Controllers\anggota\PengajuanPinjamController::class, 'myPinjam'])->name('pinjam.my');
    Route::get('/pinjam/request', [Controllers\anggota\PengajuanPinjamController::class, 'requestPinjam'])->name('pinjam.request');
    Route::post('/tambahpinjam', [Controllers\anggota\PengajuanPinjamController::class, 'store'])->name('tambahpinjam');
    Route::get('/datapengajuanpinjam/ajuan', [Controllers\anggota\PengajuanPinjamController::class, 'dataajuan'])->name('datapengajuanpinjam.ajuan');
    Route::get('/hapusajuanpinjam/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'delete'])->name('hapusajuanpinjam');
    Route::get('/edit-pinjaman/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'edit'])->name('edit-pinjaman');
    Route::post('/update-pinjaman', [Controllers\anggota\PengajuanPinjamController::class, 'update'])->name('update-pinjaman');
    Route::get('/detail-request-pinjam-extend/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'detailRequestPinjamExtend'])->name('detail-request-pinjam-extend');
    Route::get('/totalajuanpribadi', [Controllers\anggota\PengajuanPinjamController::class, 'totalajuanpribadi'])->name('totalajuanpribadi');

    //ANGGOTA LAIN
    Route::get('/pinjam/other', [Controllers\anggota\PengajuanPinjamController::class, 'requestOther'])->name('pinjam.other');
    Route::get('/data-ajuan-anggota-lain', [Controllers\anggota\PengajuanPinjamController::class, 'dataAjuanAnggotaLain'])->name('data-ajuan-anggota-lain');

    // DETAIL ALL APPROVAL ON PINJAM
    Route::get('/list-detail-approval-anggota/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'listDetailApprovalAnggota'])->name('list-detail-approval-anggota');
    Route::get('/list-detail-approval-pendamping/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'listDetailApprovalPendamping'])->name('list-detail-approval-pendamping');
    Route::get('/list-detail-approval-nazhir/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'listDetailApprovalNazhir'])->name('list-detail-approval-nazhir');
    Route::get('/list-detail-approval-admin/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'listDetailApprovalAdmin'])->name('list-detail-approval-admin');

    //APPROVE
    Route::get('/detailaprove/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'detailaprove'])->name('detailaprove');
    Route::get('detail-request-pinjam/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'detailRequestPinjam'])->name('detail-request-pinjam');
    Route::get('data-pinjam-approval-by-other-anggota/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'dataPinjamApprovalByOtherAnggota'])->name('data-pinjam-approval-by-other-anggota'); 
    Route::get('/updateaprove/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'updateaprove'])->name('updateaprove');
    Route::post('/create-update-approval-pinjam', [Controllers\anggota\PengajuanPinjamController::class, 'createUpdateApprovalPinjam'])->name('create-update-approval-pinjam');
    Route::post('/delete-approval-pinjam/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'deleteApprovalPinjam'])->name('delete-approval-pinjam');
    Route::get('getaprove-aprove/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'getaproveaprove'])->name('getaprove-aprove');
    Route::get('editaprove-aprove/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'editaproveaprove'])->name('editaprove-aprove');
    Route::post('updateaprove-aprove/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'updateaproveaprove'])->name('updateaprove-aprove');
    Route::get('detailaprove-aprove/{id}', [Controllers\anggota\PengajuanPinjamController::class, 'detailaproveaprove'])->name('detailaprove-aprove');

    // TRACKING
    Route::get('get-tracking-pinjaman/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'getTrackingPinjaman'])->name('get-tracking-pinjaman');
    Route::get('check-is-step-one-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepOneComplete'])->name('check-is-step-one-complete');
    Route::get('check-is-step-two-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepTwoComplete'])->name('check-is-step-two-complete');
    Route::get('check-is-step-three-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepThreeComplete'])->name('check-is-step-three-complete');
    Route::get('check-is-step-four-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepFourComplete'])->name('check-is-step-four-complete');
    Route::get('check-is-step-five-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepFiveComplete'])->name('check-is-step-five-complete');
    Route::get('check-is-step-six-complete/{id}', [Controllers\TrackingPinjamanAnggotaController::class, 'checkIsStepSixComplete'])->name('check-is-step-six-complete');

    // UNDER DEVELOPMENT
    Route::get('/simulation', [Controllers\anggota\SimulasiPinjamController::class, 'index'])->name('simulasipinjam');
    Route::get('/statistik', [Controllers\anggota\StatistikController::class, 'index'])->name('statistik');
    Route::get('/peruntukan', [Controllers\anggota\PeruntukanController::class, 'index'])->name('peruntukan');
});


Route::get('/backoffice', function(){
    return response("Whooopsss!", 404);
});

Route::get('/backoffice/*', function(){
    return response("Whooopsss!", 404);
});

Route::get('/account/password/reset', function(){
    return response("Whooopsss!", 404);
});

Route::get('/account/password/email', function(){
    return response("Whooopsss!", 404);
});
