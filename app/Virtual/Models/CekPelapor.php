<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="CekPelapor",
     *      description="CekPelapor Model",
     *      @OA\Xml(
     *          name="CekPelapor" 
     *      )
     * 
     * )
     * 
     */

     class CekPelapor{
        /**
         * @OA\Property(
         *     title="Valid",
         *     description="Valid",     
         *     example=true
         * )
         *
         * @var Boolean
         */
        private $valid;
        
        /**
         * @OA\Property(
         *     title="Pelapor",
         *     description="Pelapor",     
         *     example="mahasiswa"
         * )
         *
         * @var string
         */
        private $pelapor;

    }
?>