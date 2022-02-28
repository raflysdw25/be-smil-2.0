<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Satuan Request",
 *      description="Store Satuan Request body data",
 *      type="object",
 *      required={"satuan_jumlah"}
 * )
 */

class StoreSatuanRequest
{
    /**
     * @OA\Property(
     *      title="satuan_jumlah",
     *      description="Satuan Name",
     *      example=""
     * )
     *
     * @var string
     */
    public $satuan_jumlah;

    

    
}