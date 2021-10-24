<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Exceptions\ClientErrorException;
use App\Models\MediaFileMasters;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class ProductUpdateTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/:uuid:/update-product";

    }

    public function insertTestRepImage() {
        return MediaFileMasters::factory()->create([
            'media_name' => 'products',
            'media_category' => 'rep',
            'dest_path' => '/storage/products/'.'/rep/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
    }

    public function insertTestDetailImage() {
        return MediaFileMasters::factory()->create([
            'media_name' => 'products',
            'media_category' => 'detail',
            'dest_path' => '/storage/products/'.'/rep/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
    }

    public function test_admin_front_v1_product_update_uuid_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', '', $this->apiURL));
    }

    public function test_admin_front_v1_product_update_uuid_존재_하지_않은_uuid_요청()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', 'asdasdasdasd', $this->apiURL));
    }

    public function test_admin_front_v1_product_update_상품명_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.name.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "",
            "category" => "",
            "barcode" => "",
            "color" => "",
            "wireless" => "",
            "original_price" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_카테고리_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.category.required'));
        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => "",
            "barcode" => "",
            "color" => "",
            "wireless" => "",
            "original_price" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_존재_하지_않은_카테고리_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.category.exists'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 100000,
            "barcode" => "",
            "color" => "",
            "wireless" => "",
            "original_price" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_금액_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.price.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_수량_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.quantity.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_판매_상태_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.sale.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_정확하지_않은_판매_상태_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.sale.in'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "asdasd",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_상품_상태_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.active.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_정확하지_않은_상품_상태_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.active.in'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "AA",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_옵션_색상_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.color.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => "",
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_존재_하지_않은_옵션_색상_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.color.exists'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $rep_mfm = $this->insertTestRepImage();
        $detail_mfm = $this->insertTestDetailImage();

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => [10000],
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$rep_mfm->id],
            "detail_image" => [$detail_mfm->id],
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_대표_사진_과_상세_사진_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.rep_image.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_정상적이지_않은_대표_사진_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.rep_image.integer'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => "1",
            "barcode" => "13231231",
            "color" => "1",
            "wireless" => "",
            "original_price" => "3000",
            "price" => "3000",
            "quantity" => "12",
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => ['asdasd'],
            "detail_image" => [1]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_존재하지_않은_대표_사진_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.rep_image.exists'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [123123],
            "detail_image" => [1]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_상세_사진_없이_요청()
    {
        $mfm = $this->insertTestRepImage();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.detail_image.required'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$mfm->id],
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_정상_적이지_않은_대표_사진_요청()
    {
        $mfm = $this->insertTestRepImage();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.detail_image.integer'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$mfm->id],
            "detail_image" => ['asdasd']
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_존재_하지_않은_대표_사진_요청()
    {
        $mfm = $this->insertTestRepImage();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.detail_image.exists'));

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$mfm->id],
            "detail_image" => [1000000]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
    }

    public function test_admin_front_v1_product_update_무선_옵션_있을때_요청()
    {
        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $rep_mfm = $this->insertTestRepImage();
        $detail_mfm = $this->insertTestDetailImage();

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => [1],
            "wireless" => 1,
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$rep_mfm->id],
            "detail_image" => [$detail_mfm->id],
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_admin_front_v1_product_update_정상_요청()
    {
        $rep_mfm = $this->insertTestRepImage();
        $detail_mfm = $this->insertTestDetailImage();

        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => [1],
            "wireless" => 1,
            "original_price" => 3000,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "테스트 메모 입니다.",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$rep_mfm->id],
            "detail_image" => [$detail_mfm->id],
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $uuid, $this->apiURL), $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
