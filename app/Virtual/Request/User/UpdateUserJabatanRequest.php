<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Update User Jabatan Request",
 *      description="Update User Jabatan Request body data",
 *      type="object",
 *      required={"start_active_period", "end_active_period", "jabatan_id" },
 * )
 */

class UpdateUserJabatanRequest
{

    /**
     * @OA\Property(
     *      title="Start Active Period",
     *      description="User been activated",
     *      example="2020-01-27",
     *      format="datetime",
     *      type="string"
     * )
     *
     * @var \DateTime
     */
    private $start_active_period;
    /**
     * @OA\Property(
     *      title="End Active Period",
     *      description="User been activated",
     *      example="2020-01-27",
     *      format="datetime",
     *      type="string"
     * )
     *
     * @var \DateTime
     */
    private $end_active_period;
    
    
    /**
     * @OA\Property(
     *      title="jabatan_id",
     *      description="Jabatan ID User",
     * )
     *
     * @var integer
     */
    public $jabatan_id;

    

    
}