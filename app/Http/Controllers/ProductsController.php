<?php

namespace App\Http\Controllers;

use App\Customizer;
use App\ExtraDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Auth::user();
        dd($shop);
        $products = Product::where('store_id', $shop->id)->latest()->paginate(5);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product->extra_details()->count() > 0) {
            $product->extra_details()->delete();
        }

        $extra_detail = new ExtraDetail();
        $extra_detail->description = $request->description;
        $extra_detail->description_details_array = $request->description_details_array;
        $extra_detail->product_id = $request->product_id;
        $extra_detail->save();

        $shop = Auth::user();

        $results = $shop->api()->rest('GET', '/admin/products/' . $request->product_id . '/metafields.json', null, [], true);
        $flag = false;
        if (count($results['body']['container']['metafields']) > 0) {

            foreach ($results['body']['container']['metafields'] as $metafield) {
                if ($metafield['key'] == 'extra_details') {
                    $metafield_array = [
                        "metafield" => [
                            "id" => $metafield['id'],
                            "value" => $extra_detail->description,
                        ]
                    ];
                    $results = $shop->api()->rest('PUT', '/admin/products/' . $request->product_id . '/metafields/' . $metafield['id'] . '.json', $metafield_array, [], true);
                    if (!$results['errors']) {
                        $flag = true;
                    }
                }
            }
        }

        if (!$flag) {
            $product_array_to_be_passed = [
                "product" => [
                    "metafields" => [
                        [
                            "key" => "extra_details",
                            "value" => $extra_detail->description,
                            "value_type" => "string",
                            "namespace" => "global"
                        ]
                    ]
                ]
            ];

            $results = $shop->api()->rest('PUT', '/admin/products/' . $request->product_id . '.json', $product_array_to_be_passed, [], true);
        }


        return redirect()->back()->with('success', 'Extra Details Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product = Product::find($id);
        $settings = Customizer::where('store_id', Auth::user()->id)->first();

        if($settings == null) {
            return redirect()->route('settings.index')->with('error', 'Please First Select Some Icon/Emoji To Proceed');
        }


        return view('products.show')->with('product', $product)->with('settings', $settings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeProducts($next = null)
    {
        $shop = Auth::user();
        $products = $shop->api()->rest('GET', '/admin/products.json', [
            'limit' => 250,
            'page_info' => $next
        ]);


        foreach ($products['body']['container']['products'] as $product) {
            $this->createProduct($product);
        }

        if (isset($products['link']['next'])) {
            $this->storeProducts($products['link']['next']);
        }

        return redirect()->back()->with('success', 'Products Synced Successfully');
    }

    public function createProduct($product)
    {

        if (Product::where('id', $product['id'])->exists()) {
            $p = Product::find($product['id']);
        } else {
            $p = new Product();
        }

        $p->id = $product['id'];
        $p->title = $product['title'];
        $p->image = json_encode($product['image']);
        $p->store_id = Auth::user()->id;
        $p->save();

    }


    public function themes()
    {
        $themes = $this->getShopify()->call(['METHOD' => 'GET', 'URL' => '/admin/themes.json',]);
        return view('admin.theme')->with(['themes' => $themes->themes]);
    }

    public function themeSave(Request $request)
    {
        $path = 'https://rules.shopifyapplications.com/scripts.txt';
        $content = file_get_contents($path);
        if ($request->theme_id) {
            $theme_id = $request->theme_id;
        } else {
            $themes = $this->getShopify()->call(['METHOD' => 'GET', 'URL' => '/admin/themes.json',]);
            foreach ($themes->themes as $theme) {
                if ($theme->role == 'main') {
                    $theme_id = $theme->id;
                }
            }
        }

        $asset_not_find = true;
        $assets = $this->getShopify()->call(['METHOD' => 'GET', 'URL' => '/admin//themes/' . $theme_id . '/assets.json',]);
        $assets = $assets->assets;
        foreach ($assets as $asset) {
            if ($asset->key == 'snippets/advanced-care.liquid') {
                $asset_not_find = false;
            }
        }
        if ($asset_not_find) {
            $create_snippet_file = $this->getShopify()->call(['METHOD' => 'PUT', 'URL' => '/admin/themes/' . $theme_id . '/assets.json', 'DATA' => ["asset" => ["key" => "snippets/advanced-care.liquid", "value" => $content]]]);
        }
        $asset = $this->getShopify()->call(['METHOD' => 'GET', 'URL' => '/admin/themes/' . $theme_id . '/assets.json?asset[key]=layout/theme.liquid&theme_id=' . $theme_id,]);
        $theme = $asset->asset->value;
        if (stripos($theme, "advanced-care") == true) {
        } else {
            $head = explode('</body>', $theme);
            $content = $head[0] . "\n {% include 'advanced-care' %} \n </body>" . $head[1];
            $update_theme_file = $this->getShopify()->call(['METHOD' => 'PUT', 'URL' => '/admin/themes/' . $theme_id . '/assets.json', 'DATA' => ["asset" => ["key" => "layout/theme.liquid", "value" => $content]]]);
        }
        return redirect()->back();
    }
}
