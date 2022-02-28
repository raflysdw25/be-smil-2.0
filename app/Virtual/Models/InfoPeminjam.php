<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="InfoPeminjam",
     *      description="InfoPeminjam Model",
     *      @OA\Xml(
     *          name="InfoPeminjam" 
     *      )
     * 
     * )
     * 
     */

     class InfoPeminjam{
        /**
         * @OA\Property(
         *     title="NIM Mahasiswa",
         *     description="NIM Mahasiswa",     
         *     example="1231415123"
         * )
         *
         * @var string
         */
        private $nim_mahasiswa;
        
        /**
         * @OA\Property(
         *     title="NIP Staff",
         *     description="NIP Staff",     
         *     example="1231415123"
         * )
         *
         * @var string
         */
        private $nip_staff;
        
        /**
         * @OA\Property(
         *     title="Staff Fullname",
         *     description="Staff Fullname",     
         *     example="Staff Fullname 1"
         * )
         *
         * @var string
         */
        private $staff_fullname;
        
        /**
         * @OA\Property(
         *     title="Mahasiswa Fullname",
         *     description="Mahasiswa Fullname",     
         *     example="Mahasiswa Fullname 1"
         * )
         *
         * @var string
         */
        private $mahasiswa_fullname;

    }
?>