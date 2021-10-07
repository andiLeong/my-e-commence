<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\FileUploadServiceStub;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $category;
    private $product;
    private $paths;

    public function setUp() :void
    {
        parent::setUp();
        $this->category = \App\Models\Category::factory()->create();
        $this->paths = $this->UploadFiles();
        $this->product = Product::store([
            'name' => 'iphone 11',
            'description' => 'description xxxx',
            'cover' =>  $this->UploadFiles()[0],
            'stocks' => '100',
            'price' => '5000',
            'category_id' => $this->category->id,
            'on_sale' => true,
        ], $this->paths );
    }

    /** @test */
    public function a_product_can_be_created()
    {
        $this->assertDatabaseCount($this->product->getTable(),1);
    }

    /** @test */
    public function once_a_product_is_created_product_must_have_its_images()
    {
        $count = $this->product->images->count();
        $this->assertEquals( sizeof($this->paths) , $count);
    }


    /** @test */
    public function product_price_store_in_cent_retrieve_with_real_value()
    {
        $price = $this->product->price;
        $mutedPrice = $this->product->getRawOriginal()['price'];
        $this->assertEquals( 5000 , $price);
        $this->assertEquals( 5000*100 , $mutedPrice);
    }

    private function UploadFiles()
    {
        return (new FileUploadServiceStub)->uploadMultipleFiles()->getPaths();
    }

}
