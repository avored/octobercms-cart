<?php namespace Mage2\Cart\Components;


use Illuminate\Support\Facades\Session;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Mage2\Cart\Models\Product;

class Products extends ComponentBase
{
    
    /**
     * A collection of products to display
     * @var Collection
     */
    public $products;

    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;
    
     /**
     * Reference to the page name for linking to products.
     * @var string
     */
    public $productPage;


    public function componentDetails()
    {
        return [
            'name'        => 'Product List',
            'description' => 'Display Product List'
        ];
    }

    public function defineProperties()
    {
          return [
            'pageNumber' => [
                'title'       => 'Page Number',
                'description' => 'This value is used to determine what page the user is on.',
                'type'        => 'string',
                'default'     => '{{ :page }}',
            ],
            'productsPerPage' => [
                'title'             => 'Product Per Page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Invalid format of the products per page value',
                'default'           => '10',
            ],
            'noProductsMessage' => [
                'title'        => 'No Products Message',
                'description'  => 'No Product Messages',
                'type'         => 'string',
                'default'      => 'No product found',
                'showExternalParam' => false
            ],
            'productPage' => [
                'title'       => 'Product Page',
                'description' => 'Product Page',
                'type'        => 'dropdown',
                'default'     => 'shop/product',
                'group'       => 'Links',
            ],
        ];
    }

    public function addToCart() {
        $id = post('id');
        $qty =  post('qty');

        $product = Product::findorfail($id);

        dd($product);
        $data[$product->id] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'qty' => $qty,
                        ];
        Session::put('items', $data);

    }
    public function onRun()
    {
        $data = Session::get('items');

        $this->page['cartItems']  = count($data);
        //dd($data);
        $this->prepareVars();

        $this->products = $this->page['products'] = $this->listProducts();

        /*
         * If the page number is not valid, redirect
         */
        if ($pageNumberParam = $this->paramName('pageNumber')) {
            $currentPage = $this->property('pageNumber');

            if ($currentPage > ($lastPage = $this->products->lastPage()) && $currentPage > 1)
                return Redirect::to($this->currentPageUrl([$pageNumberParam => $lastPage]));
        }
    }
    
    
    
    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        $this->noProductsMessage = $this->page['noProductsMessage'] = $this->property('noProductsMessage');

        $this->productPage = $this->page['productPage'] = $this->property('productPage');
    }
    
    protected function listProducts()
    {

        /*
         * List all the products, eager load their categories
         */
        $products = Product::paginate(10);

        /*
         * Add a "url" helper attribute for linking to each product and category
         */
        $products->each(function($product) {
            $product->setUrl($this->productPage, $this->controller);

        });

        return $products;
    }
    
    
     public function getProductPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }


}