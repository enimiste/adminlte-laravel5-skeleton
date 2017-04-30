<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 07/04/17
 * Time: 15:37
 */

namespace App\Business\Support;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmptyLengthAwarePaginator implements LengthAwarePaginator
{

    /**
     * Determine the total number of items in the data store.
     *
     * @return int
     */
    public function total()
    {
        return 0;
    }

    /**
     * Get the page number of the last available page.
     *
     * @return int
     */
    public function lastPage()
    {
        return 0;
    }

    /**
     * Get the URL for a given page.
     *
     * @param  int $page
     * @return string
     */
    public function url($page)
    {
        return '';
    }

    /**
     * Add a set of query string values to the paginator.
     *
     * @param  array|string $key
     * @param  string|null $value
     * @return $this
     */
    public function appends($key, $value = null)
    {
    }

    /**
     * Get / set the URL fragment to be appended to URLs.
     *
     * @param  string|null $fragment
     * @return $this|string
     */
    public function fragment($fragment = null)
    {
    }

    /**
     * The the URL for the next page, or null.
     *
     * @return string|null
     */
    public function nextPageUrl()
    {
    }

    /**
     * Get the URL for the previous page, or null.
     *
     * @return string|null
     */
    public function previousPageUrl()
    {
    }

    /**
     * Get all of the items being paginated.
     *
     * @return array
     */
    public function items()
    {
        return [];
    }

    /**
     * Get the "index" of the first item being paginated.
     *
     * @return int
     */
    public function firstItem()
    {
    }

    /**
     * Get the "index" of the last item being paginated.
     *
     * @return int
     */
    public function lastItem()
    {
    }

    /**
     * Determine how many items are being shown per page.
     *
     * @return int
     */
    public function perPage()
    {
    }

    /**
     * Determine the current page being paginated.
     *
     * @return int
     */
    public function currentPage()
    {
    }

    /**
     * Determine if there are enough items to split into multiple pages.
     *
     * @return bool
     */
    public function hasPages()
    {
        return false;
    }

    /**
     * Determine if there is more items in the data store.
     *
     * @return bool
     */
    public function hasMorePages()
    {
        return false;
    }

    /**
     * Determine if the list of items is empty or not.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return true;
    }

    /**
     * Render the paginator using a given view.
     *
     * @param  string|null  $view
     * @return string
     */
    public function render($view = null)
    {
    }
}