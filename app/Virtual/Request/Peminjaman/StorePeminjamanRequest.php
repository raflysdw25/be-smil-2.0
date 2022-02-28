<?php

    namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Peminjaman Request",
 *      description="Store Peminjaman Request body data",
 *      type="object",
 * )
 */

class StorePeminjamanRequest
{
    /**
     * @OA\Property(
     *      title="nim_mahasiswa",
     *      description="NIM Mahasiswa",
     * )
     *
     * @var string
     */
    public $nim_mahasiswa;
    
    /**
     * @OA\Property(
     *      title="nip_staff",
     *      description="NIP Staff",
     * )
     *
     * @var string
     */
    public $nip_staff;
    
    /**
     * @OA\Property(
     *      title="nip_staff_in_charge",
     *      description="NIP Staff In Charge",
     * )
     *
     * @var string
     */
    public $nip_staff_in_charge;
    
    /**
     * @OA\Property(
     *      title="pjm_purpose",
     *      description="Tujuan Peminjaman",
     * )
     *
     * @var string
     */
    public $pjm_purpose;
   
    /**
     * @OA\Property(
     *      title="ruangan_id",
     *      description="Ruangan ID",
     * )
     *
     * @var integer
     */
    public $ruangan_id;
    
    /**
     * @OA\Property(
     *      title="expected_return_date",
     *      description="Waktu Pengembalian yang ditentukan",
     *      format="string"
     * )
     *
     * @var \DateTime
     */
    public $expected_return_date;
    
    /**
     * @OA\Property(
     *      title="pjm_type",
     *      description="Tipe Peminjaman",
     * )
     *
     * @var string
     */
    public $pjm_type;
    
    /**
     * @OA\Property(
     *      title="pjm_status",
     *      description="Status Peminjaman",
     * )
     *
     * @var integer
     */
    public $pjm_status;

    /**
     * @OA\Property(
     *      title="list_alat",
     *      description="Image Alat List",
     *      @OA\Items(
     *          
     *      )
     * )
     *
     * @var array
     */
    public $list_alat; 

    

    
}