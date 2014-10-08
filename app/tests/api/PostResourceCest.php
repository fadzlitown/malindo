<?php

use \ApiTester;

class PostResourceCest
{

    protected $search_submit_uri = 'search'; //POST
    protected $search_result_uri = 'listing/search'; //GET 

    public function tryToSearch(ApiTester $I)
    {
        $I->wantTo("search filters");

        //queries data
        $queries = [
            'keyword'           => 'android 4.4.4',
            'category'          => 'smartphones',
            'brand'             => 'apple',
            'model'             => '',
            'order_by'          => 'price',
            'order_type'        => 'desc', //ASC or DESC
            'price_range_start' => 100,
            'price_range_end'   => 500,
            'specs'             => ''
        ];


        $I->sendPOST($this->search_submit_uri, $queries);
        $I->seeResponseIsJson();

        $I->seeResponseContains('redirect_uri');
        $redirect_uri = $I->grabDataFromJsonResponse('redirect_uri');
        \Log::info($redirect_uri);

        $I->sendGET($redirect_uri);
        $I->seeResponseIsJson();

        $I->seeResponseContains('input');
//        $input = $I->grabDataFromJsonResponse('input');
//        \Log::info($input);
    }

}
