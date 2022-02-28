<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Update User Request",
 *      description="Update User Request body data",
 *      type="object"
 * )
 */

class UpdateUserRequest
{
    /**
     * @OA\Property(
     *      title="User Email",
     *      description="Email",
     *      example="example@gmail.com"
     * )
     *
     * @var string
     */
    public $email;
    
    


    /**
     * @OA\Property(
     *      title="User Fullname",
     *      description="User Fullname",
     *      example="Example Lengkap",
     * )
     *
     * @var string
     */
    private $fullname;
    /**
     * @OA\Property(
     *      title="User Phone Number",
     *      description="User Phone Number",
     *      example="0812188678120938",
     * )
     *
     * @var string
     */
    private $phone_number;

    /**
     * @OA\Property(
     *      title="User Address",
     *      description="User Address",
     *      example="Jl. Example",
     * )
     *
     * @var string
     */
    private $address;
    
    /**
     * @OA\Property(
     *      title="Prodi Id",
     *      description="ID Program Studi",
     * )
     *
     * @var integer
     */
    public $prodi_id;

    /**
     * @OA\Property(
     *      title="User Image",
     *      description="User Image",
     *      example="",
     * )
     *
     * @var string
     */
    private $image_data;

    

    
}