<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);

    Route::resource('roles', 'Admin\RolesController')->except('show','data','destroy','detail');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::get('roles/list', 'Admin\RolesController@data')->name('roles.data');
    Route::get('roles/delete/{id}','Admin\RolesController@destroy');
    Route::get('roles/{id}/detail','Admin\RolesController@detail')->name('roles.detail');


    Route::resource('users', 'Admin\UsersController')->except('show','data','destroy','detail');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::get('users/list', 'Admin\UsersController@data')->name('users.data');
    Route::get('users/delete/{id}','Admin\UsersController@destroy');
    Route::get('users/findGudang',array('as'=>'users.findGudang','uses'=>'Admin\UsersController@findGudang'));
    Route::get('users/findDep',array('as'=>'users.findDep','uses'=>'Admin\UsersController@findDep'));



});

Route::group(['middleware' => ['auth']], function () {

    //Route::get('charts', 'ChartsController@getIndex');
    Route::get('admin/home/charts/api', 'HomeController@getApi');

    Route::resource('uoms','UomController')->except('data','show','destroy');
	Route::get('uoms/list','UomController@data')->name('uoms.list');
    Route::post('uoms_mass_destroy', ['uses' => 'UomController@massDestroy', 'as' => 'uoms.mass_destroy']);
    Route::get('uoms/delete/{id}','UomController@destroy');

    Route::resource('categorys','CategoryController')->except('data','show','destroy');
    Route::post('categorys_mass_destroy', ['uses' => 'CategoryController@massDestroy', 'as' => 'categorys.mass_destroy']);
    Route::get('categorys/list','CategoryController@data')->name('categorys.list');
    Route::get('categorys/delete/{id}','CategoryController@destroy');


    Route::resource('products','ProductController')->except('index','data','show','destroy','dataLov');
    Route::get('products','ProductController@index')->name('products.index');
    //Route::get('products/create','ProductController@create')->name('products.create');
    //Route::post('products/create','ProductController@store')->name('products.store');
    //Route::get('products/edit','ProductController@edit')->name('products.edit');
    //Route::post('products/edit','ProductController@update')->name('products.update');
    Route::get('products/list','ProductController@data')->name('products.list');
    Route::get('products/lov','ProductController@dataLov')->name('products.lov');
    Route::post('products_mass_destroy', ['uses' => 'ProductController@massDestroy', 'as' => 'products.mass_destroy']);
    Route::get('products/delete/{id}','ProductController@destroy')->name('products.delete');
    Route::get('products/modal','ProductController@modal')->name('products.modal');
    Route::get('pembelian/products/lov','ProductController@dataLov')->name('products.lov');
    Route::get('/products/excel',
            [
              'as' => 'products.excel',
              'uses' => 'ProductController@excel'
            ]);
    Route::get('products/ajax', 'ProductController@testajax')->name('products.ajax');
    Route::get('products/tampil','ProductController@tampil')->name('products.tampil');
    Route::get('products_modal','ProductController@products_modal')->name('products.products_modal');
    Route::get('process_products_selections',array('as'=>'process_products_selections','uses'=>'ProductController@process_products_selections'));

    Route::get('products/findProduk',array('as'=>'products.findProduk','uses'=>'ProductController@findProduk'));



    //process_products_selections


    Route::get('products/produkuoms/{id}','ProdukUomController@index')->name('products.produkuoms');
    Route::get('products/produkuoms/list/{id}','ProdukUomController@data')->name('products.produkuoms.list');
    Route::get('products/produkuoms/edit/{id}','ProdukUomController@edit')->name('products.produkuoms.edit');
    Route::post('products/produkuoms/edit/{id}','ProdukUomController@update')->name('products.produkuoms.update');
    Route::get('products/produkuoms/create/{id}','ProdukUomController@create')->name('products.produkuoms.create');
    Route::post('products/produkuoms/create/{id}','ProdukUomController@store')->name('products.produkuoms.store');
    Route::get('products/produkuoms/delete/{id}','ProdukUomController@destroy');








    Route::resource('gudang','GudangController')->except('data','show','destroy');
    Route::get('gudang/list','GudangController@data')->name('gudang.list');
    Route::post('gudang_mass_destroy', ['uses' => 'GudangController@massDestroy', 'as' => 'gudang.mass_destroy']);
    Route::get('gudang/delete/{id}','GudangController@destroy');
    Route::get('gudang/findGudang',array('as'=>'gudang.findGudang','uses'=>'GudangController@findGudang'));
    Route::get('/gudang/excel',
            [
              'as' => 'gudang.excel',
              'uses' => 'GudangController@excel'
            ]);

    Route::resource('info/toko','InfoTokoController')->except('data','show','destroy');
    Route::post('info/toko','InfoTokoController@store')->name('toko.store');
    Route::get('info/toko/list','InfoTokoController@data')->name('toko.list');
    //Route::post('info/toko', ['uses' => 'InfoTokoController@massDestroy', 'as' => 'toko.mass_destroy']);
    Route::get('info/toko/delete/{id}','InfoTokoController@destroy');
    //Route::get('info/toko/findGudang',array('as'=>'toko.findGudang','uses'=>'InfoTokoController@findGudang'));
    Route::get('/info/toko/excel',
            [
              'as' => 'toko.excel',
              'uses' => 'infoTokoController@excel'
            ]);


    Route::resource('departements','DepartementController')->except('data','show','destroy');
    Route::get('departements/list','DepartementController@data')->name('departements.list');
    Route::post('departements_mass_destroy', ['uses' => 'DepartementController@massDestroy', 'as' => 'departements.mass_destroy']);
    Route::get('departements/delete/{id}','DepartementController@destroy');
    Route::get('/departements/excel',
            [
              'as' => 'departements.excel',
              'uses' => 'DepartementController@excel'
            ]);



    Route::resource('klasifikasi','KlasifikasiController')->except('data','show','destroy');
    Route::post('klasifikasi_mass_destroy', ['uses' => 'KlasifikasiController@massDestroy', 'as' => 'klasifikasi.mass_destroy']);
    Route::get('klasifikasi/delete/{id}','KlasifikasiController@destroy');


    Route::resource('subklasifikasi','SubKlasifikasiController')->except('data','show','destroy');
    Route::post('subklasifikasi_mass_destroy', ['uses' => 'SubKlasifikasiController@massDestroy', 'as' => 'subklasifikasi.mass_destroy']);
    Route::get('subklasifikasi/delete/{id}','SubKlasifikasiController@destroy');


    Route::resource('akun','AkunController')->except('data','show','destroy');
    Route::post('akun_mass_destroy', ['uses' => 'AkunController@massDestroy', 'as' => 'akun.mass_destroy']);
    Route::get('akun/list','AkunController@data');
    Route::get('akun/delete/{id}','AkunController@destroy');
    Route::get('/akun/excel',
            [
              'as' => 'akun.excel',
              'uses' => 'AkunController@excel'
            ]);


    Route::resource('kontak','KontakController')->except('data','show','tampil','edit','destroy');
    Route::get('kontak/list','KontakController@data')->name('kontak.list');
    Route::get('kontak/tampil','KontakController@tampil');
    Route::get('kontak/edit/{id}','KontakController@edit')->name('kontak.edit');
    Route::post('kontak_mass_destroy', ['uses' => 'KontakController@massDestroy', 'as' => 'kontak.mass_destroy']);
    Route::get('kontak/delete/{id}','KontakController@destroy')->name('kontak.delete');
    Route::get('/kontak/excel',
            [
              'as' => 'kontak.excel',
              'uses' => 'KontakController@excel'
            ]);


    Route::get('kontak/hargajual/{id}','HargaJualController@index')->name('hargajual.index');
    Route::get('kontak/hargajual/create/{id}','HargaJualController@create')->name('hargajual.create');
    Route::post('kontak/hargajual/create/{id}','HargaJualController@store');
    Route::get('kontak/hargajual/edit/{id}','HargaJualController@edit')->name('hargajual.edit');
    Route::post('kontak/hargajual/edit/{id}','HargaJualController@update');
    Route::resource('hargajual','HargaJualController')->except('index','data','show','create','destroy');
    Route::post('hargajual_mass_destroy', ['uses' => 'HargaJualController@massDestroy', 'as' => 'hargajual.mass_destroy']);
    Route::get('kontak/hargajual/list/{id}','HargaJualController@data');
    //Route::get('kontak/hargajual/delete/{id}','HargaJualController@destroy');

    /*
    Route::get('kontak/hargajuals','HargaController@index')->name('hargajuals.index');
    Route::get('kontak/hargajuals/list','HargaController@data')->name('hargajuals.list');
    Route::get('kontak/hargajuals/create','HargaController@create')->name('hargajuals.create');
    Route::post('kontak/hargajuals/create','HargaController@store')->name('hargajuals.store');
    Route::get('kontak/hargajuals/edit/{id}','HargaController@edit')->name('hargajuals.edit');
    Route::post('kontak/hargajuals/edit/{id}','HargaController@update')->name('hargajuals.update');
    Route::get('kontak/hargajuals/findProduk',array('as'=>'hargajuals.findProduk','uses'=>'HargaController@findProduk'));
    Route::get('kontak/hargajuals/findKontak',array('as'=>'hargajuals.findKontak','uses'=>'HargaController@findKontak'));
    Route::get('kontak/hargajuals/findSatuan',array('as'=>'hargajuals.findSatuan','uses'=>'HargaController@findSatuan'));
    Route::get('kontak/hargajuals/delete/{id}','HargaController@destroy')->name('hargajuals.delete');
    Route::get('/kontak/hargajuals/excel',
            [
              'as' => 'hargajuals.excel',
              'uses' => 'HargaController@excel'
            ]);
    */

    Route::resource('hargajuals','HargaController')->except('data','show','destroy','create');
    //Route::get('hargajuals','HargaController@index')->name('hargajuals.index');
    Route::get('hargajuals/list','HargaController@data')->name('hargajuals.list');
    Route::get('hargajuals/create','HargaController@create')->name('hargajuals.create');
    Route::post('hargajuals/create','HargaController@store')->name('hargajuals.store');
    //Route::get('hargajuals/edit/{id}','HargaController@edit')->name('hargajuals.edit');
    //Route::post('hargajuals/edit/{id}','HargaController@update')->name('hargajuals.update');
    /*
    Route::match(array('PUT', 'PATCH'), "hargajuals/edit/{id}", array(
              'uses' => 'HargaController@update',
              'as' => 'hargajuals.update'
            ));
            */
    Route::get('hargajuals/findProduk',array('as'=>'hargajuals.findProduk','uses'=>'HargaController@findProduk'));
    Route::get('hargajuals/findKontak',array('as'=>'hargajuals.findKontak','uses'=>'HargaController@findKontak'));
    Route::get('hargajuals/findSatuan',array('as'=>'hargajuals.findSatuan','uses'=>'HargaController@findSatuan'));
    Route::get('hargajuals/delete/{id}','HargaController@destroy')->name('hargajuals.delete');
    Route::get('hargajuals/excel',
            [
              'as' => 'hargajuals.excel',
              'uses' => 'HargaController@excel'
            ]);


    Route::resource('hargabeli','HargaBeliController')->except('data','show','destroy','create','list');
    Route::get('hargabeli','HargaBeliController@index')->name('hargabeli.index');
    Route::get('hargabeli/list','HargaBeliController@data')->name('hargabeli.list');
    Route::get('hargabeli/create','HargaBeliController@create')->name('hargabeli.create');
    Route::post('hargabeli/create','HargaBeliController@store')->name('hargabeli.store');
    //Route::get('hargabeli/edit/{id}','HargaBeliController@edit')->name('hargabeli.edit');
    //Route::post('hargabeli/edit/{id}','HargaBeliController@update')->name('hargabeli.update');
    /*
    Route::get('hargabeli/update/{id}',
            [
              'as' => 'hargabeli.update',
              'uses' => 'HargaBeliController@update'
            ]);

    Route::post('hargabeli/edit/{id}',function(Request $request,$id){
            $product = App\HargaBeliDetail::find($id);
            $product->uom_id = $request->uom_id;
            $product->harga_beli_khusus = $request->harga_beli_khusus;
            $product->save();
            return response()->json($product);
            });

    Route::match(array('PUT', 'PATCH'), "hargabeli/edit/{id}", array(
              'uses' => 'HargaBeliController@update',
              'as' => 'hargabeli.update'
            ));
            */
    Route::get('hargabeli/findProduk',array('as'=>'hargabeli.findProduk','uses'=>'HargaBeliController@findProduk'));
    Route::get('hargabeli/findKontak',array('as'=>'hargabeli.findKontak','uses'=>'HargaBeliController@findKontak'));
    Route::get('hargabeli/findSatuan',array('as'=>'hargabeli.findSatuan','uses'=>'HargaBeliController@findSatuan'));
    Route::get('hargabeli/delete/{id}','HargaBeliController@destroy')->name('hargabeli.delete');
    Route::get('hargabeli/excel',
            [
              'as' => 'hargabeli.excel',
              'uses' => 'HargaBeliController@excel'
            ]);


    Route::resource('kontakdetail','KontakDetailController')->except('data','show','destroy','edit');
    Route::post('kontakdetail_mass_destroy', ['uses' => 'KontakDetailController@massDestroy', 'as' => 'kontakdetail.mass_destroy']);
    Route::get('kontakdetail/delete/{id}','KontakDetailController@destroy');
    Route::get('kontakdetail/edit/{id}','KontakDetailController@edit')->name('kontakdetail.edit');


    /*
     * Cart / Trasanction Draft Routes
     */
    Route::get('drafts', 'CartController@index')->name('cart.index');
    Route::get('drafts/{draftKey}', 'CartController@show')->name('cart.show');
    Route::post('drafts/{draftKey}', 'CartController@store')->name('cart.store');
    Route::post('cart/add-draft', 'CartController@add')->name('cart.add');
    Route::post('cart/add-draft-item/{draftKey}/{product}', 'CartController@addDraftItem')->name('cart.add-draft-item');
    Route::patch('cart/update-draft-item/{draftKey}', 'CartController@updateDraftItem')->name('cart.update-draft-item');
    Route::patch('cart/{draftKey}/proccess', 'CartController@proccess')->name('cart.draft-proccess');
    Route::delete('cart/remove-draft-item/{draftKey}', 'CartController@removeDraftItem')->name('cart.remove-draft-item');
    Route::delete('cart/empty/{draftKey}', 'CartController@empty')->name('cart.empty');
    Route::delete('cart/remove', 'CartController@remove')->name('cart.remove');
    Route::delete('cart/destroy', 'CartController@destroy')->name('cart.destroy');

    /*
     * Products Routes

    Route::get('products/price-list', ['as' => 'products.price-list', 'uses' => 'ProductsController@priceList']);
    Route::resource('products', 'ProductsController', ['except' => ['create', 'show', 'edit']]);
     */
    /*
     * Transactions Routes
     */
    Route::get('transactions', ['as' => 'transactions.index', 'uses' => 'TransactionsController@index']);
    Route::get('transactions/{transaction}', ['as' => 'transactions.show', 'uses' => 'TransactionsController@show']);
    Route::get('transactions/{transaction}/pdf', ['as' => 'transactions.pdf', 'uses' => 'TransactionsController@pdf']);
    Route::get('transactions/{transaction}/receipt', ['as' => 'transactions.receipt', 'uses' => 'TransactionsController@receipt']);



    //------- Route Module Pembelian
    Route::get('pembelian', ['as' => 'pembelian.index', 'uses' => 'PembelianController@index']);
    Route::get('pembelian/add', ['as' => 'pembelian.create', 'uses' => 'PembelianController@create']);
    Route::get('pembelian/list', ['as' => 'pembelian.list', 'uses' => 'PembelianController@data']);
    Route::get('pembelian/findPrice',array('as'=>'pembelian.findPrice','uses'=>'PembelianController@findPrice'));
    Route::get('pembelian/findSatuan',array('as'=>'pembelian.findSatuan','uses'=>'PembelianController@findSatuan'));
    Route::get('pembelian/findUoms',array('as'=>'pembelian.findUoms','uses'=>'PembelianController@findUoms'));
    Route::get('pembelian/findKodeProduk',array('as'=>'pembelian.findKodeProduk','uses'=>'PembelianController@findKodeProduk'));
    Route::post('pembelian/insert',array('as'=>'pembelian.insert','uses'=>'PembelianController@insert'));
    Route::get('pembelian/delete/{id}','PembelianController@destroy')->name('pembelian.delete');
    Route::get('pembeliandetail/delete/{id}','PembelianDetailController@destroy')->name('pembeliandetail.delete');
    Route::get('api/getregency', 'PembelianController@listsatuan');
    Route::get('/pembelian/excel',
            [
              'as' => 'pembelian.excel',
              'uses' => 'PembelianController@excel'
            ]);

    Route::get('pembelian/detail/{id}','PembelianController@detail')->name('pembelian.detail');
    Route::get('pembelian/edit/{id}','PembelianController@edit')->name('pembelian.edit');
    Route::get('pembelian/update/{id}','PembelianController@update')->name('pembelian.update');

    Route::get('pembelian/getdataHutang','PembelianController@getdataHutang')->name('pembelian.getdataHutang');
    Route::get('pembelian/getdataHutang21','PembelianController@getdataHutang21')->name('pembelian.getdataHutang21');
    Route::get('pembelian/hutang','PembelianController@hutang')->name('pembelian.hutang');
    Route::get('pembelian/hutang/excelHutang',
            [
              'as' => 'pembelian.hutang.excelHutang',
              'uses' => 'PembelianController@excelHutang'
            ]);
    Route::get('pembelian/findProduk',array('as'=>'pembelian.findProduk','uses'=>'PembelianController@findProduk'));
    Route::get('pembelian/findKontak',array('as'=>'pembelian.findKontak','uses'=>'PembelianController@findKontak'));
    Route::get('pembelian/cek','PembelianController@cek')->name('pembelian.cek');
    Route::get('pembelian/satuan/{id}','PembelianController@satuan')->name('pembelian.satuan');
    Route::get('pembelian/satuanx/{id}','PembelianController@satuanx')->name('pembelian.satuanx');



    //------- Route Pembayaran Hutang
    Route::get('pembayaran', ['as' => 'pembayaran.index', 'uses' => 'PembayaranController@index']);
    Route::get('pembayaran/add', ['as' => 'pembayaran.create', 'uses' => 'PembayaranController@create']);
    Route::get('pembayaran/list', ['as' => 'pembayaran.list', 'uses' => 'PembayaranController@data']);
    Route::get('pembayaran/findPrice',array('as'=>'pembayaran.findPrice','uses'=>'PembayaranController@findPrice'));
    Route::get('pembayaran/findTanggal',array('as'=>'pembayaran.findTanggal','uses'=>'PembayaranController@findTanggal'));
    Route::get('pembayaran/findSatuan',array('as'=>'pembayaran.findSatuan','uses'=>'PembayaranController@findSatuan'));
    Route::get('pembayaran/findKodeProduk',array('as'=>'pembayaran.findKodeProduk','uses'=>'PembayaranController@findKodeProduk'));
    Route::post('pembayaran/insert',array('as'=>'pembayaran.insert','uses'=>'PembayaranController@insert'));
    Route::get('pembayaran/delete/{id}','PembayaranController@destroy')->name('pembayaran.delete');
    Route::get('pembayaran/detail/{id}','PembayaranController@detail')->name('pembayaran.detail');


    //------- Route Module Penjualan
    Route::get('penjualan', ['as' => 'penjualan.index', 'uses' => 'PenjualanController@index']);
    Route::get('penjualan/add', ['as' => 'penjualan.create', 'uses' => 'PenjualanController@create']);
    Route::get('penjualan/list', ['as' => 'penjualan.list', 'uses' => 'PenjualanController@data']);
    Route::get('penjualan/findPrice',array('as'=>'penjualan.findPrice','uses'=>'PenjualanController@findPrice'));
    Route::get('penjualan/Price',array('as'=>'penjualan.Price','uses'=>'PenjualanController@Price'));
    Route::get('penjualan/findSatuan',array('as'=>'penjualan.findSatuan','uses'=>'PenjualanController@findSatuan'));
    Route::get('penjualan/findKodeProduk',array('as'=>'penjualan.findKodeProduk','uses'=>'PenjualanController@findKodeProduk'));
    Route::get('penjualan/findProduk',array('as'=>'penjualan.findProduk','uses'=>'PenjualanController@findProduk'));

    Route::post('penjualan/insert',array('as'=>'penjualan.insert','uses'=>'PenjualanController@insert'));
    Route::get('penjualan/delete/{id}','PenjualanController@destroy');
    Route::get('penjualan/detail/{id}','PenjualanController@detail')->name('penjualan.detail');
    Route::get('penjualan/print/{id}','PenjualanController@faktur')->where('id', '[0-9]+')->name('penjualan.print');

    Route::get('penjualan/getdataPiutang','PenjualanController@getdataPiutang')->name('penjualan.getdataPiutang');
    Route::get('penjualan/piutang','PenjualanController@piutang')->name('penjualan.piutang');
    Route::get('penjualan/excel',
            [
              'as' => 'penjualan.excel',
              'uses' => 'PenjualanController@excel'
            ]);
    Route::post('penjualan/struk/{id}', 'PenjualanController@struk')->name('penjualan.struk');
    Route::get('penjualan/invoice/{id}', 'PenjualanController@invoicePdf')->where('id', '[0-9]+')->name('penjualan.invoice');
    Route::get('penjualan/invoice_2/{id}', 'PenjualanController@invoicePdf2')->where('id', '[0-9]+')->name('penjualan.invoice_2');


    //------- Route Module Transfer
    Route::get('transfer', ['as' => 'transfer.index', 'uses' => 'TransferController@index']);
    Route::get('transfer/add', ['as' => 'transfer.create', 'uses' => 'TransferController@create']);
    Route::get('transfer/list', ['as' => 'transfer.list', 'uses' => 'TransferController@data']);
    Route::get('transfer/findPrice',array('as'=>'transfer.findPrice','uses'=>'TransferController@findPrice'));
    Route::get('transfer/findSatuan',array('as'=>'transfer.findSatuan','uses'=>'TransferController@findSatuan'));
    Route::get('transfer/findKodeProduk',array('as'=>'transfer.findKodeProduk','uses'=>'TransferController@findKodeProduk'));
    Route::post('transfer/insert',array('as'=>'transfer.insert','uses'=>'TransferController@insert'));
    Route::get('transfer/delete/{id}','TransferController@destroy');
    Route::get('transfer/detail/{id}','TransferController@detail')->name('transfer.detail');

        //------- Route Pengeluaran Akun
    Route::get('kas/pengeluaran', ['as' => 'kas.pengeluaran.index', 'uses' => 'PengeluaranKasController@index']);
    Route::get('kas/pengeluaran/add', ['as' => 'kas.pengeluaran.create', 'uses' => 'PengeluaranKasController@create']);
    Route::get('kas/pengeluaran/list', ['as' => 'kas.pengeluaran.list', 'uses' => 'PengeluaranKasController@data']);
    Route::get('kas/pengeluaran/findPrice',array('as'=>'kas.pengeluaran.findPrice','uses'=>'PengeluaranKasController@findPrice'));
    Route::get('kas/pengeluaran/findSatuan',array('as'=>'kas.pengeluaran.findSatuan','uses'=>'PengeluaranKasController@findSatuan'));
    Route::get('kas/pengeluaran/findKodeProduk',array('as'=>'kas.pengeluaran.findKodeProduk','uses'=>'PengeluaranKasController@findKodeProduk'));
    Route::post('kas/pengeluaran/insert',array('as'=>'kas.pengeluaran.insert','uses'=>'PengeluaranKasController@insert'));
    Route::get('kas/pengeluaran/delete/{id}','PengeluaranKasController@destroy');
    Route::get('kas/pengeluaran/detail/{id}','PengeluaranKasController@detail')->name('kas.pengeluaran.detail');

    //------- Route penerimaan Akun
    Route::get('kas/penerimaan', ['as' => 'kas.penerimaan.index', 'uses' => 'PenerimaanKasController@index']);
    Route::get('kas/penerimaan/add', ['as' => 'kas.penerimaan.create', 'uses' => 'PenerimaanKasController@create']);
    Route::get('kas/penerimaan/list', ['as' => 'kas.penerimaan.list', 'uses' => 'PenerimaanKasController@data']);
    Route::get('kas/penerimaan/findPrice',array('as'=>'kas.penerimaan.findPrice','uses'=>'PenerimaanKasController@findPrice'));
    Route::get('kas/penerimaan/findSatuan',array('as'=>'kas.penerimaan.findSatuan','uses'=>'PenerimaanKasController@findSatuan'));
    Route::get('kas/penerimaan/findKodeProduk',array('as'=>'kas.penerimaan.findKodeProduk','uses'=>'PenerimaanKasController@findKodeProduk'));
    Route::post('kas/penerimaan/insert',array('as'=>'kas.penerimaan.insert','uses'=>'PenerimaanKasController@insert'));
    Route::get('kas/penerimaan/delete/{id}','PenerimaanKasController@destroy');
    Route::get('kas/penerimaan/detail/{id}','PenerimaanKasController@detail')->name('kas.penerimaan.detail');


    //------- Route transfer Akun
    Route::get('kas/transfer', ['as' => 'kas.transfer.index', 'uses' => 'TransferKasController@index']);
    Route::get('kas/transfer/add', ['as' => 'kas.transfer.create', 'uses' => 'TransferKasController@create']);
    Route::get('kas/transfer/list', ['as' => 'kas.transfer.list', 'uses' => 'TransferKasController@data']);
    Route::get('kas/transfer/findPrice',array('as'=>'kas.transfer.findPrice','uses'=>'TransferKasController@findPrice'));
    Route::get('kas/transfer/findSatuan',array('as'=>'kas.transfer.findSatuan','uses'=>'TransferKasController@findSatuan'));
    Route::get('kas/transfer/findKodeProduk',array('as'=>'kas.transfer.findKodeProduk','uses'=>'TransferKasController@findKodeProduk'));
    Route::get('kas/transfer/findNamaAkun',array('as'=>'kas.transfer.findNamaAkun','uses'=>'TransferKasController@findNamaAkun'));
    Route::post('kas/transfer/insert',array('as'=>'kas.transfer.insert','uses'=>'TransferKasController@insert'));
    Route::get('kas/transfer/delete/{id}','TransferKasController@destroy');
    Route::get('kas/transfer/detail/{id}','TransferKasController@detail')->name('kas.transfer.detail');


    //------- Route Module Penyesuaian
    Route::get('penyesuaian', ['as' => 'penyesuaian.index', 'uses' => 'PenyesuaianController@index']);
    Route::get('penyesuaian/add', ['as' => 'penyesuaian.create', 'uses' => 'PenyesuaianController@create']);
    Route::get('penyesuaian/list', ['as' => 'penyesuaian.list', 'uses' => 'PenyesuaianController@data']);
    Route::get('penyesuaian/findPrice',array('as'=>'penyesuaian.findPrice','uses'=>'PenyesuaianController@findPrice'));
    Route::get('penyesuaian/findSatuan',array('as'=>'penyesuaian.findSatuan','uses'=>'PenyesuaianController@findSatuan'));
    Route::get('penyesuaian/findKodeProduk',array('as'=>'penyesuaian.findKodeProduk','uses'=>'PenyesuaianController@findKodeProduk'));
    Route::post('penyesuaian/insert',array('as'=>'penyesuaian.insert','uses'=>'PenyesuaianController@insert'));
    Route::get('penyesuaian/delete/{id}','PenyesuaianController@destroy');
    Route::get('penyesuaian/detail/{id}','PenyesuaianController@detail')->name('penyesuaian.detail');


    //------- Route piutang Piutang
    Route::get('piutang', ['as' => 'piutang.index', 'uses' => 'PiutangController@index']);
    Route::get('piutang/add', ['as' => 'piutang.create', 'uses' => 'PiutangController@create']);
    Route::get('piutang/list', ['as' => 'piutang.list', 'uses' => 'PiutangController@data']);
    Route::get('piutang/findPrice',array('as'=>'piutang.findPrice','uses'=>'PiutangController@findPrice'));
    Route::get('piutang/findTanggal',array('as'=>'piutang.findTanggal','uses'=>'PiutangController@findTanggal'));
    Route::get('piutang/findSatuan',array('as'=>'piutang.findSatuan','uses'=>'PiutangController@findSatuan'));
    Route::get('piutang/findKodeProduk',array('as'=>'piutang.findKodeProduk','uses'=>'PiutangController@findKodeProduk'));
    Route::post('piutang/insert',array('as'=>'piutang.insert','uses'=>'PiutangController@insert'));
    Route::get('piutang/delete/{id}','PiutangController@destroy')->name('piutang.delete');
    Route::get('piutang/detail/{id}','PiutangController@detail')->name('piutang.detail');


    //--------- Report FPDF --------//
    Route::get('/fpdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {
          $fpdf->AddPage();
          $fpdf->SetFont('Courier', 'B', 18);
          $fpdf->Cell(50, 25, 'Hello World!');
          $fpdf->Output();
    });

});
