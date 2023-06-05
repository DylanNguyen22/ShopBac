<?php

namespace App\Http\Controllers;

use App\Models\admin\admin;
use App\Models\admin\admin_discount;
use App\Models\admin\admin_product;
use App\Models\admin\admin_category_productType;
use App\Models\admin\admin_order;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->admin = new admin();
        $this->admin_product = new admin_product();
        $this->admin_category_productType = new admin_category_productType();
        $this->admin_discount = new admin_discount();
        $this->admin_order = new admin_order;
    }

    public function index(Request $request)
    {
        if (isset($request->all()['year'])) {
            $year = $request->all()['year'];
        } else {
            $year = date("Y");
        }
        $result = $this->admin_order->sumOrder($year);
        $data = $result[0];
        $daySum = $result[1];
        $yearSum = $result[2];
        $accountSum = $result[3];
        $orderSum = $result[4];
        return view("admin/main_page", compact('year', 'data', 'daySum', 'yearSum', 'accountSum', 'orderSum'));
    }
    // =================Sản phẩm============================
    public function product(Request $request)
    {
        $data = $this->admin_product->getAllProduct();
        $search = $data;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6;
        $currentPageItems = array_slice($data, ($currentPage - 1) * $perPage, $perPage);
        $data = new LengthAwarePaginator($currentPageItems, count($data), $perPage);
        $data->setPath($request->url());
        return view("admin/product", compact('data', 'search'));
    }

    public function addProduct()
    {
        $sizeArr = [];
        $a = array("0", "Không có");
        $b = array("1", "Kích thước nam");
        $c = array("2", "Kích thước nữ");
        $d = array("3", "Kích thước đôi");
        array_push($sizeArr, $a, $b, $c, $d);
        $data = [
            '',
            $this->admin_product->getAllProductTypes(),
            '',
            $this->admin_product->getAllMaterial(),
            $sizeArr
        ];
        return view('admin.add_product', compact('data'));
    }

    public function editProduct()
    {
        $sizeArr = [];
        $a = array("0", "Không có");
        $b = array("1", "Kích thước nam");
        $c = array("2", "Kích thước nữ");
        $d = array("3", "Kích thước đôi");
        array_push($sizeArr, $a, $b, $c, $d);
        $data = [
            $this->admin_product->editProduct($_GET['id']),
            $this->admin_product->getAllProductTypes(),
            $this->admin_product->getAllProductImage($_GET['id']),
            $this->admin_product->getAllMaterial(),
            $sizeArr
        ];
        return view('admin.edit_product', compact('data'));
    }

    public function handleEditProduct(Request $request)
    {
        $this->admin_product->handleEditProduct($request);
        session()->flash("msg", "Thay đổi thành công !");
        return redirect()->back();
    }

    public function handleAddProduct(Request $request)
    {
        $this->admin_product->handleAddProduct($request);
        session()->flash("msg", "Lưu sản phẩm thành công !");
        return redirect()->back();
    }

    public function changeProductStatus()
    {
        $this->admin_product->changeProductStatus($_GET['id']);
        session()->flash("msg", "Lưu sản phẩm thành công !");
        return redirect()->back();
    }

    public function deleteProduct()
    {
        $this->admin_product->deleteProduct($_GET['id']);
        session()->flash("msg", "Xóa sản phẩm thành công !");
        return redirect()->back();
    }

    // =================Danh mục và loại sản phẩm=======================

    public function getAllCategoryAndType(Request $request)
    {
        $category = $this->admin_category_productType->getAllCategory();
        $data = $this->admin_category_productType->getAllCategoryAndType();
        $result = $data;
        // dd($data);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 3;
        $currentPageItems = array_slice($data, ($currentPage - 1) * $perPage, $perPage);
        $data = new LengthAwarePaginator($currentPageItems, count($data), $perPage);
        $data->setPath($request->url());
        return view('admin.category_type', compact('data', 'category', 'result'));
    }

    public function changeCategoryStatus()
    {
        $this->admin_category_productType->changeCategoryStatus($_GET['id']);
        return redirect()->back();
    }

    public function changeCategoryName(Request $request)
    {
        $this->admin_category_productType->changeCategoryName($request->all());
        session()->flash("msg", "Lưu thay đổi thành công !");
        return redirect()->back();
    }

    public function addCategory(Request $request)
    {
        $this->admin_category_productType->addCategory($request->all());
        session()->flash("msg", "Lưu danh mục thành công !");
        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
        $this->admin_category_productType->deleteCategory($request->all());
        session()->flash("msg", "Xóa danh mục thành công !");
        return redirect()->back();
    }

    public function addProductType(Request $request)
    {
        $this->admin_category_productType->addProductType($request->all());
        session()->flash("msg", "Lưu loại sản phẩm thành công !");
        return redirect()->back();
    }

    public function changeProductTypeStatus()
    {
        $this->admin_category_productType->changeProductTypeStatus($_GET['id']);
        return redirect()->back();
    }

    public function editProductType(Request $request)
    {
        $this->admin_category_productType->editProductType($request->all());
        session()->flash("msg", "Lưu thay đổi thành công !");
        return redirect()->back();
    }

    public function deleteProductType(Request $request)
    {
        $this->admin_category_productType->deleteProductType($request->all()['maloai']);
        session()->flash("msg", "Lưu thay đổi thành công !");
        return redirect()->back();
    }

    // =====================Khuyến mãi=========================

    public function getAllDiscount()
    {
        $data = $this->admin_discount->getAllDiscount();
        return view('admin.discount', compact('data'));
    }

    public function addDiscount(Request $request)
    {
        $this->admin_discount->addDiscount($request->all());
        session()->flash("msg", "Thêm khuyễn mãi thành công !");
        return redirect()->back();
    }

    public function changeDiscountStatus()
    {
        $this->admin_discount->changeDiscountStatus($_GET['id']);
        session()->flash("msg", "Thay đổi thành công !");
        return redirect()->back();
    }

    public function addProductToDiscount()
    {
        $data = $this->admin_discount->getAllProduct($_GET['id']);
        $MaKM = $_GET['id'];
        return view('admin.add_product_to_discount', compact('data', 'MaKM'));
    }

    public function handleAddProductToDiscount(Request $request)
    {
        $this->admin_discount->handleAddProductToDiscount($request->all());
        session()->flash("msg", "Thay đổi thành công !");
        return redirect()->back();
    }

    public function deleteDiscount()
    {
        $this->admin_discount->deleteDiscount($_GET['id']);
        session()->flash("msg", "Xóa khuyến mãi thành công !");
        return redirect()->back();
    }

    // ====================Đơn hàng=========================

    public function getAllOrder(Request $request)
    {
        if (!isset($_GET['TrangThai']) || $_GET['TrangThai'] < 1 || $_GET['TrangThai'] > 6) {
            $data = $this->admin_order->getAllOrder(0);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 8;
            $currentPageItems = array_slice($data[0], ($currentPage - 1) * $perPage, $perPage);
            $data[0] = new LengthAwarePaginator($currentPageItems, count($data[0]), $perPage);
            $data[0]->setPath($request->url());
            $paged = "";
            return view('admin.order', compact('data', 'paged'));
        } else {
            $data = $this->admin_order->getAllOrder($_GET['TrangThai']);
            return view('admin.order', compact('data'));
        }
    }

    public function orderDetail()
    {
        $data = $this->admin_order->orderDetail($_GET['id']);
        $orderInfo = $data[0];
        $products = $data[1];
        return view('admin.orderDetail', compact('orderInfo', 'products'));
    }

    public function changeOrderStatus(Request $request)
    {
        $this->admin_order->changeOrderStatus($request->all());
        session()->flash("msg", "Thay đổi trạng thái đơn hàng thành công thành công !");
        return redirect()->back();
    }

    public function editOrder(Request $request)
    {
        $this->admin_order->editOrder($request->all());
        return redirect()->back();
    }

    // =================Đơn hàng================

    public function getAllUser(Request $request)
    {
        $users = $this->admin->getAllUser();
        $usersSearch = $users;
        $result = $users;
        // dd($data);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentPageItems = array_slice($users, ($currentPage - 1) * $perPage, $perPage);
        $users = new LengthAwarePaginator($currentPageItems, count($users), $perPage);
        $users->setPath($request->url());
        return view('admin.user', compact('users', 'usersSearch'));
    }

    public function changeAccountStatus()
    {
        $this->admin->changeAccountStatus($_GET['id']);
        return redirect()->back();
    }

    public function deleteUser()
    {
        $this->admin->deleteUser($_GET['id']);
        return redirect()->back();
    }












    public function index1()
    {
        return view("admin/insert");
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        $this->admin->handle_insert($request);
    }

    public function khuyenmai()
    {
        $data = $this->admin->getAllProduct();
        return view('/admin/khuyenmai', compact('data'));
    }

    public function themkhuyenmai(Request $request)
    {
        // dd($request->all());
        $this->admin->themKhuyenMai($request);
    }


}