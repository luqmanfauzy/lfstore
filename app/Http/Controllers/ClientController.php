<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public static function home()
    {
        $produkUnggulan = Product::whereIn('name', [
            'kacamata photocromic ptc-02', 
            'kacamata hitam gelap',
            'kacamata bening anti radiasi leopard model bulat',
            'kaos kaki panjang oldskull sebetis' 
        ])->get();

        $allCategories = Category::all();

        $description = 'Temukan berbagai aksesoris kacamata dan kaos kaki terbaik di LF Store — dari kacamata hitam, bening anti radiasi, hingga photocromic. Juga tersedia berbagai macam kaos kaki!';
        $keywords = 'kacamata, kacamata hitam, kacamata bening, kacamata photocromic, kaos kaki panjang, aksesoris kacamata';
        $ogTitle = 'LF Store | Aksesoris Kacamata dan Kaos Kaki';

        return view('newHome', compact('produkUnggulan', 'allCategories', 'description', 'keywords', 'ogTitle'));
    }

    public function catalog(Request $request)
    {
        $query = $request->input('query'); 

        $allProduct = Product::with('category')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', '%' . $query . '%');
            })
            ->paginate(12);
        
        $categories = Category::with('products')->get();

        $title = 'Katalog Produk | LF Store';
        $description = 'Jelajahi koleksi kacamata dari LF Store — tersedia kacamata hitam, bening anti radiasi, dan photocromic stylish untuk gaya sehari-hari.';
        $keywords = 'kacamata, kacamata pria, kacamata wanita, kacamata anti radiasi, kacamata photocromic';

        return view('catalog', compact('allProduct', 'categories', 'description', 'keywords', 'title'));
    }


    public function detailProduct($slug)
    {
        // Cari produk berdasarkan slug
        $data = Product::with(['images', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Produk rekomendasi (kecuali produk sekarang)
        $suggestedProduct = Product::where('slug', '!=', $slug)
            ->where(function ($query) use ($data) {
                $query->where('category_id', $data->category_id)
                    ->orWhere('name', 'like', '%' . $data->name . '%');
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Ambil semua kategori
        $categories = Category::with('products')->get();

        // SEO
        $title = $data->name . ' | LF Store';
        $description = 'Jelajahi koleksi kacamata dari LF Store — tersedia kacamata hitam, bening anti radiasi, dan photocromic stylish untuk gaya sehari-hari.';
        $keywords = $data->category->category_name . ', ' . $data->name . ', aksesoris kacamata dan kaos kaki';

        return view('detail-product', compact('data', 'suggestedProduct', 'categories', 'title', 'keywords', 'description'));
    }


    public function categoryProduct(Request $request, $slug)
    {
        $query = $request->input('query'); 

        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            abort(404, 'Kategori tidak ditemukan');
        }

        // Ambil produk berdasarkan category_id
        $allProductbyCategory = Product::where('category_id', $category->id)
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->paginate(12);

        $categories = Category::with('products')->get();

        $categoryName = Category::where('category_name', $category->category_name)->value('category_name') ?? 'Kategori Tidak Ditemukan';

        return view('category-product', compact('allProductbyCategory', 'categoryName', 'query', 'categories'));
    }
}
