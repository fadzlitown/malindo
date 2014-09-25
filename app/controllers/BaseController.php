<?php

class BaseController extends Controller
{

    public $siteInfo         = array();
    public $manageViewConfig = array();
    public $model            = null;

    public function __construct()
    {
        $this->siteInfo['siteName']  = 'sites.name';
        $this->siteInfo['pageTitle'] = '';
        $this->siteInfo['metaDesc']  = 'sites.description';
        $this->siteInfo['metaKeys']  = 'sites.keys';
        $this->siteInfo['styles']    = array();
        $this->siteInfo['scripts']   = array();
        $this->siteInfo['ca']        = '';

        \View::share($this->siteInfo);

        $this->manageViewConfig['manage']         = true;
        $this->manageViewConfig['create']         = true;
        $this->manageViewConfig['edit']           = true;
        $this->manageViewConfig['view']           = true;
        $this->manageViewConfig['delete']         = true;
        $this->manageViewConfig['custom_action']  = false;
        $this->manageViewConfig['limit_per_page'] = 10;

        \View::share($this->manageViewConfig);
    }

    /*     * a
     * Setup the layout used by the controller.
     *
     * @return void
     */

    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function customShare($data)
    {
        foreach ($data as $key => $value) {
            $this->siteInfo[$key] = $value;
        }
        View::share($this->siteInfo);
    }

    /**
     * Get results by page
     *
     * @param int $page
     * @param int $limit
     * @return StdClass
     */
    public function getByPage($page = 1, $limit = 10, $column = false, $operator = "=", $value = false, $orderbyprimary = false, $orderbyasc = 'ASC')
    {
        $results             = new stdClass;
        $results->page       = $page;
        $results->limit      = $limit;
        $results->totalItems = 0;
        $results->items      = array();

        if ($column && $value) {
            if (!$orderbyprimary) {
                $rows = $this->model->where($column, $operator, $value)->skip($limit * ($page - 1))
                        ->take($limit)
                        ->get();
            }
            else {
                $rows = $this->model->where($column, $operator, $value)->skip($limit * ($page - 1))
                        ->take($limit)
                        ->orderBy($orderbyprimary, $orderbyasc)
                        ->get();
            }

            $results->totalItems = $this->model->where($column, $value)->count();
        }
        else {
            if (!$orderbyprimary) {
                $rows = $this->model->skip($limit * ($page - 1))
                        ->take($limit)
                        ->get();
            }
            else {
                $rows = $this->model->skip($limit * ($page - 1))
                        ->take($limit)
                        ->orderBy($orderbyprimary, $orderbyasc)
                        ->get();
            }

            $results->totalItems = $this->model->count();
        }

        foreach ($rows as $row) {
            array_push($results->items, $row);
        }

        if (count($results->items) === 0) {
            return "No records found.";
        }

        return $results;
    }

}
