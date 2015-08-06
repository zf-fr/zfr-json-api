<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Zfr\JsonApi;

use Psr\Http\Message\ServerRequestInterface;

/**
 * A Criteria is an immutable object that holds various data used to filter, sort and include associated data
 *
 * Currently, the JSON API supports the following criteria:
 *
 *      - fields: allow to return spared fieldsets (eg.: fields[articles]=title,body&fields[people]=name
 *      - sort: allow to sort by given properties (eg.: sort=-created,age)
 *      - page: used for pagination
 *      - filter: used for filtering
 *      - include: used to include additional, related resources (eg.: include=comments.author,comments.location
 *
 * @author Michaël Gallego
 */
final class Criteria
{
    const SORT_ASC  = 'asc';
    const SORT_DESC = 'desc';

    /**
     * An associative array that map a resource type to an array of field
     *
     * @var array
     */
    private $fields = [];

    /**
     * An associative array that map a field to a direction. Order is preserved from request order
     *
     * @var array
     */
    private $sort = [];

    /**
     * An associative array that contains data for pagination. The spec does not specify anything to this regards
     *
     * @var array
     */
    private $page = [];

    /**
     * @var array
     */
    private $filters = [];

    /**
     * An array of resources to include
     *
     * @var array
     */
    private $include = [];

    /**
     * @param array  $fields
     * @param string $sort
     * @param array  $page
     * @param array  $filters
     * @param string $include
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->setFields($fields);
        $this->setSort($sort);
        $this->setPage($page);
        $this->setFilters($filters);
        $this->setInclude($include);
    }

    /**
     * @param array $fields
     */
    private function setFields(array $fields)
    {
        foreach ($fields as $type => $fieldsAsString) {
            $this->fields[$type] = explode(',', $fieldsAsString);
        }
    }

    /**
     * @param string $sort
     */
    private function setSort($sort)
    {
        $sort = explode(',', $sort);

        foreach ($sort as $sortAsString) {
            if ($sortAsString[0] === '-') {
                $this->sort[substr($sortAsString, 1)] = self::SORT_DESC;
            } else {
                $this->sort[$sortAsString] = self::SORT_ASC;
            }
        }
    }

    /**
     * @param array $page
     */
    private function setPage(array $page)
    {
        $this->page = $page;
    }

    /**
     * @param array $filters
     */
    private function setFilters(array $filters)
    {

    }

    /**
     * @param array $include
     */
    private function setInclude(array $include)
    {
        $include = explode(',', $include);

        foreach ($include as $includeAsString) {
            // Is there sub-resource to include?
            if (strstr($includeAsString, '.')) {

            } else {

            }
        }
    }
}