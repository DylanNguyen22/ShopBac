<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    private $products;

    public function __construct()
    {
        $this->products = new Products();
    }

    public function index()
    {
        $data = [
            $this->products->getAllCategories(),
            $this->products->getAllProductTypes(),
            $this->products->getNewProduct(),
            $this->products->getAllProduct(),
            $this->products->getMostSoldProduct()
        ];
        return view('client/home', compact('data'));
    }

    public function getProductByCategory(Request $request)
    {
        if(isset($_GET['id'])){
            $product = $this->products->getProductByCategory($_GET['id']);
            session()->put('productByCategory', $product);
        }else{
            $product = session()->get('productByCategory');
        }
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $currentPageItems = array_slice($product, ($currentPage - 1) * $perPage, $perPage);
        $product = new LengthAwarePaginator($currentPageItems, count($product), $perPage);
        $product->setPath($request->url());

        $data = [
            $this->products->getAllCategories(),
            $this->products->getAllProductTypes(),
            "",
            $this->products->getAllProduct(),
        ];

        return view('client.productByCategory', compact('product', 'data'));
    }

    public function getProductByType(Request $request   )
    {
        if(isset($_GET['id'])){
            $product = $this->products->getProductByType($_GET['id']);
            session()->put('productByType', $product);
        }else{
            $product = session()->get('productByType');
        }
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $currentPageItems = array_slice($product, ($currentPage - 1) * $perPage, $perPage);
        $product = new LengthAwarePaginator($currentPageItems, count($product), $perPage);
        $product->setPath($request->url());

        $data = [
            $this->products->getAllCategories(),
            $this->products->getAllProductTypes(),
            "",
            $this->products->getAllProduct(),
        ];
        return view('client.productByType', compact('data', 'product'));
    }

    public function createSearchKey(Request $request)
    {
        session()->put('tukhoa', $request->all()['key-word']);
        return redirect('/timkiem');
    }

    public function search(Request $request)
    {
        $product = $this->products->search(session()->get('tukhoa'));
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $currentPageItems = array_slice($product, ($currentPage - 1) * $perPage, $perPage);
        $product = new LengthAwarePaginator($currentPageItems, count($product), $perPage);
        $product->setPath($request->url());

        $data = [
            $this->products->getAllCategories(),
            $this->products->getAllProductTypes(),
            "",
            $this->products->getAllProduct(),
        ];
        return view('client.searchResult', compact('product', 'data'));
    }

    public function product_details()
    {
        $idProduct = $_GET['id'];
        $productInfo = $this->products->productDetail();
        $data = [
            $this->products->getAllCategories(),
            $this->products->getAllProductTypes(),
            $productInfo[0],
            $this->products->getAllProduct(),
            $productInfo[1],
            $productInfo[2],
            $productInfo[3],
            $productInfo[4]
        ]; 
        return view('client/product_detail', compact('data'));
        
    }
}