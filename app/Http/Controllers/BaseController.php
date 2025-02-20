<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BaseController extends Controller
{
    public $seachParams = [];

    public $limitPage = LIMIT;

    public $seachValue = '';

    public function __construct(Request $request)
    {
        $this->seachParams = $request->query->all();
        $this->limitPage = Arr::get($this->seachParams, 'limit', LIMIT);
        $this->seachValue = Arr::get($this->seachParams, 'q', '');
    }

    /**
     * Get all data filtered with search
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function getData(mixed $model, string $fieldSearch = 'name'): Collection
    {
        return $this->queryBuilder($model, $fieldSearch)->get();

    }

    /**
     * Get all data paginate filtered with search.
     *
     * @return IIlluminate\\Pagination\\LengthAwarePaginator
     */
    public function getDataPagninate(mixed $model, string $fieldSearch = 'name')
    {
        return $this->queryBuilder($model, $fieldSearch)->paginate($this->limitPage);
    }

    /**
     * Builds the necessary query.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function queryBuilder(mixed $model, string $fieldSearch): Builder
    {
        $query = $model::baseGetQuery();
        if (empty($this->seachValue)) {
            return $query;
        }

        return $query->whereRaw('LOWER('.$fieldSearch.') LIKE ?', ['%'.mb_strtolower($this->seachValue).'%']);
    }
}
