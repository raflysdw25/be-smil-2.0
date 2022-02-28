<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="JabatanListDefaultResource",
     *      description="Jabatan Resource",
     *      @OA\Xml(
     *          name="JabatanListDefaultResource"
     *      ),
     * )
     * 
     */

    class JabatanListDefaultResource{        
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="data",
         *      description="List Data Staff Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\Jabatan[]
         * 
         */
        private $data;
    }
?>