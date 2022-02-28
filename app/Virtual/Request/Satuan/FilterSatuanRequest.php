<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Satuan request",
 *      description="Filter Satuan request body data",
 *      type="object",
 * )
 */

class FilterSatuanRequest
{
    /**
     * @OA\Property(
     *      title="page_size",
     *      description="Page Size of Filter",
     *      example=5
     * )
     *
     * @var integer
     */
    public $page_size;

    /**
     * @OA\Property(
     *      title="sort_by",
     *      description="Sort Filter By Attributes",
     *      example="id"
     * )
     *
     * @var string
     */
    public $sort_by;
    
    /**
     * @OA\Property(
     *      title="sort_direction",
     *      description="Sort Direction of Filter",
     *      example="ASC"
     * )
     *
     * @var string
     */
    public $sort_direction;

     /**
     * @OA\Property(
     *      title="id",
     *      description="Filter Satuan ID",
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *      title="satuan_name",
     *      description="Filter Satuan Name",
     * )
     *
     * @var string
     */
    public $satuan_jumlah_name;

    
}