<?php

use \FunctionalTester;

class SearchFilterCest
{

    protected $ajax_search_uri        = "search";
    protected $ajax_search_result_uri = "listing/search";

    // tests
    public function trySearchFilter(FunctionalTester $I)
    {
        $I->wantTo("try search list by using filter through form filter");
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

        $I->sendAjaxPostRequest($this->ajax_search_uri, $queries);
    }

}
