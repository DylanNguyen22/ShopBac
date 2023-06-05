<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\authController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Models\products;    


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

Route::prefix('/')->group(function (){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/chitietsanpham', [HomeController::class, 'product_details']);  
    Route::get('/danhmuc', [HomeController::class, 'getProductByCategory']);
    Route::get('/theloai', [HomeController::class, 'getProductByType']);
    Route::get('/dangxuat', [authController::class, 'sign_out']);
    Route::get('/timkiem', [HomeController::class, 'search']);
    Route::post('/chuanbitukhoa', [HomeController::class, 'createSearchKey']);
});

// Route::middleware('admin.check')->prefix('admin')->group(function(){
    Route::middleware('auth.admin')->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/', [AdminController::class, 'index']);
    // Sản phẩm
    Route::get('/sanpham', [AdminController::class, 'product']);
    Route::get('/themsanpham', [AdminController::class, 'addProduct']);
    Route::post('/themsanpham-luu', [AdminController::class, 'handleAddProduct']);
    Route::get('/chinhsuasanpham', [AdminController::class, 'editProduct']);
    Route::get('thaydoitrangthaisanpham', [AdminController::class, 'changeProductStatus']);
    Route::get('xoasanpham', [AdminController::class, 'deleteProduct']);
    Route::post('/chinhsuasanpham-luu', [AdminController::class, 'handleEditProduct']);
    // Danh mục
    Route::get('/danhmucvaloaisanpham', [AdminController::class, 'getAllCategoryAndType']);
    Route::get('thaydoitrangthaidanhmuc', [AdminController::class, 'changeCategoryStatus']);
    Route::post('/doitendanhmuc', [AdminController::class, 'changeCategoryName']);
    Route::post('/themdanhmuc', [AdminController::class, 'addCategory']);
    Route::post('/xoadanhmuc', [AdminController::class, 'deleteCategory']);
    // Loại sản phẩm
    Route::post('/themloai', [AdminController::class, 'addProductType']); 
    Route::get('/thaydoitrangthailoai', [AdminController::class, 'changeProductTypeStatus']);
    Route::post('/chinhsualoai', [AdminController::class, 'editProductType']);
    Route::post('/xoaloaisanpham', [AdminController::class, 'deleteProductType']);
    // Khuyến mãi
    Route::post('/themkhuyenmai', [AdminController::class, 'addDiscount']);
    Route::get('/thaydoitrangthaikhuyenmai', [AdminController::class, 'changeDiscountStatus']);
    Route::get('/themsanphamchokhuyenmai', [AdminController::class, 'addProductToDiscount']);
    Route::post('/themsanphamchokhuyenmai-luu', [AdminController::class, 'handleAddProductToDiscount']);
    Route::get('/khuyenmai', [AdminController::class, 'getAllDiscount']);
    Route::get('/xoakhuyenmai', [AdminController::class, 'deleteDiscount']);
    // Đon hàng
    Route::get('/donhang', [AdminController::class, 'getAllOrder']);
    Route::get('/chitietdonhang', [AdminController::class, 'orderDetail']);
    Route::post('thaydoitrangthaidonhang', [AdminController::class, 'changeOrderStatus']);
    Route::post('/chinhsuathongtindonhang', [AdminController::class, 'editOrder']);

    Route::get('/taikhoan', [AdminController::class, 'getAllUser']);
    Route::get('/thaydoitrangthaitaikhoan', [AdminController::class, 'changeAccountStatus']);
    Route::get('/xoataikhoan', [AdminController::class, 'deleteUser']);

    // Route::get('/them', [AdminController::class, 'index1']);
    // Route::post('/insert', [AdminController::class, 'insert']);
    // Route::get('/khuyenmai', [AdminController::class, 'khuyenmai']);
    // Route::post('/themkhuyenmai', [AdminController::class, 'themkhuyenmai']);
});

Route::prefix('giohang')->group(function(){
    Route::get('/', [CartController::class , 'index']);
    Route::post('themvaogiohang', [CartController::class, 'addToCart']);
    Route::post('/xoakhoigiohang',  [CartController::class, 'deleteFromCart']);
    Route::get('tangsoluong', [CartController::class, 'update_cart_item_quantity']);
});

Route::prefix('donhang')->group(function(){
    Route::post('muangay', [OrderController::class, 'buyNow']);
    Route::post('taodonhang', [OrderController::class, 'createBuyNowOrder']);
    Route::get('chitietdonhang', [OrderController::class, 'orderDetail']);
    Route::get('thanhtoantructuyen', [OrderController::class, 'vn_pay']);
    Route::get('ketquathanhtoan', [OrderController::class, 'vnPay_return']);
    Route::get('luuthanhtoan-muangay', [OrderController::class, 'saveBuyNowOrder']);
    Route::get('thanhtoangiohang', [OrderController::class, 'createByAllFromCart']);
    Route::get('thaydoisoluong', [OrderController::class, 'changeQuantity']);
    Route::post('taodonhangthanhtoantatca', [OrderController::class, 'createBuyAllOrder']);
    Route::get('luuthanhtoan-tatca', [OrderController::class, 'saveBuyAllOrder']);
    Route::get('danhsachdonhang', [OrderController::class, 'orderList']);

    Route::get('xuatfilepdf', [OrderController::class, 'exportPDF']);
});

Route::post('themdiachi', [OrderController::class, 'addAddress']);
Route::get('xoadiachi', [OrderController::class, 'deleteAddress']);
Route::post('them-dia-chi', [OrderController::class, 'add_Address']);
Route::get('xoa-dia-chi', [OrderController::class, 'delete_Address']);


Route::get('/dangky', [authController::class, 'sign_up']);
Route::post('/dangky', [authController::class, 'handle_sign_up']);

Route::get('/dangnhap', [authController::class, 'sign_in']);
Route::post('/dangnhap', [authController::class, 'handle_sign_in']);

Route::get('/test', function(){
    return view('client.test');
});


Route::get('/xempdf', function(){
    return view('client.exportPDF');
});

Route::get('/xuatpdf', [OrderController::class, 'exportPDF']);