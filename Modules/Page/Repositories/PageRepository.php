<?php

namespace Modules\Page\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Modules\Core\Repositories\BaseRepository;

interface PageRepository extends BaseRepository
{
    /**
     * Find the page set as homepage
     * @return object
     */
    public function findHomepage();

    /**
     * Count all records
     * @return int
     */
    public function countAll();

    /**
     * @param $slug
     * @param $locale
     * @return object
     */
    public function findBySlugInLocale($slug, $locale);

    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(Request $request) : LengthAwarePaginator;
}