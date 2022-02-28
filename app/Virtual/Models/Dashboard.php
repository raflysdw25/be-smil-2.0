<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Dashboard",
     *      description="Dashboard Model",
     *      @OA\Xml(
     *          name="Dashboard" 
     *      )
     * 
     * )
     * 
     */

     class Dashboard{
        /**
         * @OA\Property(
         *     title="TotalAlat",
         *     description="Total Alat",
         *     format="int64",
         *     example=100
         * )
         *
         * @var integer
         */
        private $total_alat;
         
        /**
         * @OA\Property(
         *     title="Total Alat Kondisi Baik",
         *     description="Total Alat yang dalam Kondisi Baik",
         *     format="int64",
         *     example=100
         * )
         *
         * @var integer
         */
        private $count_good;
        
        /**
         * @OA\Property(
         *     title="Total Alat Kondisi Rusak",
         *     description="Total Alat yang dalam Kondisi Rusak",
         *     format="int64",
         *     example=100
         * )
         *
         * @var integer
         */
        private $count_damaged;
        
        /**
         * @OA\Property(
         *     title="Total Alat Kondisi Habis",
         *     description="Total Alat yang dalam Kondisi Habis",
         *     format="int64",
         *     example=100
         * )
         *
         * @var integer
         */
        private $count_empty;
        
        /**
         * @OA\Property(
         *     title="Total Alat Kondisi Diperbaiki",
         *     description="Total Alat yang dalam Kondisi Diperbaiki",
         *     format="int64",
         *     example=100
         * )
         *
         * @var integer
         */
        private $count_fix;

        /**
         *  @OA\Property(
         *      title="Recent Damaged Report",
         *      description="Model of Laporan Kerusakan",
         *  )
         *
         *  @var \App\Virtual\Models\LaporanKerusakan[]
         */
        private $recent_report;
        
        /**
         *  @OA\Property(
         *      title="Recent Peminjaman",
         *      description="Model of Peminjaman",
         *  )
         *
         *  @var \App\Virtual\Models\Peminjaman[]
         */
        private $recent_peminjaman;

     }


?>