<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;

use App\Models\Category;
use App\Models\NavLink;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function front()
    {

        // info('Name entered is in fact Tim'); // This does get printed
        $links = NavLink::all();

        $products = Stock::with(["category"])
            ->where([
                "company_id" => 1,
                "branch_id" => 1,
            ])
            ->get();
        $products_chunk = $products->toArray();
        $categories = Category::all();
        $banners = Banner::all();
        if (count($products) > 0) {
            $products_chunk = array_chunk(
                $products_chunk,
                ceil(count($products_chunk) / count($categories))
            );
        } else {
            $products_chunk = $products;
        }
        return view("layouts.front_layout.home")->with(
            compact(["categories", "links", "products", "banners"])
        );
    }

    public function get_all_products(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            foreach ($data as $d) {
                $products = Product::where("status", 1);
                //  if sort selected by user
                if (isset($d) && !empty($d)) {
                    switch ($d) {
                        case "latest_products":
                            $products = $products->orderBy("id", "desc");
                            break;
                        case "price_lowest":
                            $products = $products->orderBy(
                                "product_price",
                                "ASC"
                            );
                            break;
                        case "price_highest":
                            $products = $products->orderBy(
                                "product_price",
                                "desc"
                            );
                            break;
                        case "product_name_a_z":
                            $products = $products->orderBy(
                                "product_name",
                                "asc"
                            );
                            break;
                        case "product_name_z_a":
                            $products = $products->orderBy(
                                "product_name",
                                "desc"
                            );
                            break;
                    }
                }
                $products = $products->paginate(2);
                return view("layouts.front_layout.ajax_products_content")->with(
                    compact(["products", "d"])
                );
            }
        } else {
            $products = Product::where("status", 1);

            $categories = Category::get()->toArray();

            //  if sort selected by user
            if (isset($_GET["sort"]) && !empty($_GET["sort"])) {
                switch ($_GET["sort"]) {
                    case "latest_products":
                        $products = $products->orderBy("id", "desc");
                        break;
                    case "price_lowest":
                        $products = $products->orderBy("product_price", "ASC");
                        break;
                    case "price_highest":
                        $products = $products->orderBy("product_price", "desc");
                        break;
                    case "product_name_a_z":
                        $products = $products->orderBy("product_name", "asc");
                        break;
                    case "product_name_z_a":
                        $products = $products->orderBy("product_name", "desc");
                        break;
                }
            }
            $products = $products->paginate(2);
            return view("layouts.front_layout.products")->with(
                compact(["products", "categories"])
            );
        }
    }
    public function countd(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            foreach ($data as $value) {
                //  $count_products = Product::where('status',1)->where('category_id',$data)->get();
                return $request->json($value);
            }

            //   return $count_products;
        }
    }
}
