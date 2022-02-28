<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Authorization",
     *      description="Authorization Model",
     *      @OA\Xml(
     *          name="Authorization" 
     *      )
     * 
     * )
     * 
     */

     class Authorization{
        /**
         * @OA\Property(
         *     title="Token Type",
         *     description="Access Token",
         *     example="123129abcdefg"
         * )
         *
         * @var string
         */
        private $access_token;
        
        /**
         * @OA\Property(
         *     title="Token Type",
         *     description="Token Type",
         *     example="bearer"
         * )
         *
         * @var string
         */
        private $token_type;

        /**
         * @OA\Property(
         *     title="Token Expire",
         *     description="Token Expire in Minutes",
         *     format="int64",
         *     example=1440
         * )
         *
         * @var integer
         */
        private $expires_in;

        /**
         * @OA\Property(
         *     title="ID",
         *     description="ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $id;

        /**
         * @OA\Property(
         *      title="User Active Date",
         *      description="Date of active user",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $user_active_period;
        
        /**
         * @OA\Property(
         *      title="User expire Date",
         *      description="Date of expire user",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $user_expire_period;


        /**
         * @OA\Property(
         *      title="Staff Model",
         *      description="Model of the Staff",
         * )
         *
         * @var \App\Virtual\Models\Staff
         */
        private $staff_model;

        /**
         * @OA\Property(
         *      title="Jabatan Model",
         *      description="Model of the Jabatan",
         * )
         *
         * @var \App\Virtual\Models\Jabatan
         */
        private $jabatan_model;
        
        /**
         * @OA\Property(
         *      title="User First Login",
         *      description="User First Login",
         *      example=true
         * )
         *
         * @var Boolean
         */
        private $first_login;

       
     }


?>
<!-- {
  "response": {
    "code": 200,
    "status": "success",
    "message": "User berhasil login"
  },
  "data": {
    "access_token": "",
    "token_type": "bearer",
    "expires_in": 1440,
    "id": 1,
    "user_active_period": "2021-07-03",
    "user_expire_period": "2022-07-03",
    "staff_model": {
      "nip": "admin",
      "staff_fullname": "Super Admin",
      "email": "admintest@gmail.com",
      "phone_number": "025100090000",
      "address": "",
      "prodi_id": null,
      "deleted_at": null,
      "created_at": "2021-07-03T08:45:54.000000Z",
      "updated_at": "2021-07-03T08:45:54.000000Z",
      "is_verified": true
    },
    "jabatan_model": {
      "id": 1,
      "jabatan_name": "Super Admin",
      "deleted_at": null,
      "created_at": "2021-07-03T08:45:53.000000Z",
      "updated_at": "2021-07-03T08:45:53.000000Z"
    },
    "first_login": true
  }
} -->

