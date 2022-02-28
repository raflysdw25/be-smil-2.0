<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Manajemen Inventaris Laboratorium Teknik Informatika dan Komputer</title>
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap/dist//css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ url('assets/images/Logo_PNJ.png') }}" type="image/x-icon">  
    
</head>
<body>
    <section id="data-user-verified" class="container">
        @if ($user["isVerified"])
            <div id="" class="verified">
                <svg class="mb-2" width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.3829 8.27344H15.2836C15.0446 8.27344 14.8172 8.38828 14.6766 8.58516L10.9922 13.6945L9.32349 11.3789C9.18287 11.1844 8.95787 11.0672 8.71646 11.0672H7.61724C7.4649 11.0672 7.37583 11.2406 7.4649 11.3648L10.3852 15.4148C10.4542 15.5111 10.5451 15.5896 10.6505 15.6437C10.7559 15.6978 10.8726 15.7261 10.9911 15.7261C11.1095 15.7261 11.2263 15.6978 11.3316 15.6437C11.437 15.5896 11.5279 15.5111 11.5969 15.4148L16.5329 8.57109C16.6243 8.44688 16.5352 8.27344 16.3829 8.27344Z" fill="#28a745"/>
                    <path d="M12 1.5C6.20156 1.5 1.5 6.20156 1.5 12C1.5 17.7984 6.20156 22.5 12 22.5C17.7984 22.5 22.5 17.7984 22.5 12C22.5 6.20156 17.7984 1.5 12 1.5ZM12 20.7188C7.18594 20.7188 3.28125 16.8141 3.28125 12C3.28125 7.18594 7.18594 3.28125 12 3.28125C16.8141 3.28125 20.7188 7.18594 20.7188 12C20.7188 16.8141 16.8141 20.7188 12 20.7188Z" fill="#28a745" />
                </svg>
                <h2>Email anda telah diverifikasi</h2>
                @if ($user["type"] == 'peminjam')
                    <p>
                        Anda sudah dapat melakukan peminjaman Alat
                    </p>
                @else
                    <p>
                        Anda sudah dapat mengakses portal admin
                    </p>      
                @endif
            </div>
        @else
           
           <div id="" class="verified">
                <svg class="mb-2" width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.3829 8.27344H15.2836C15.0446 8.27344 14.8172 8.38828 14.6766 8.58516L10.9922 13.6945L9.32349 11.3789C9.18287 11.1844 8.95787 11.0672 8.71646 11.0672H7.61724C7.4649 11.0672 7.37583 11.2406 7.4649 11.3648L10.3852 15.4148C10.4542 15.5111 10.5451 15.5896 10.6505 15.6437C10.7559 15.6978 10.8726 15.7261 10.9911 15.7261C11.1095 15.7261 11.2263 15.6978 11.3316 15.6437C11.437 15.5896 11.5279 15.5111 11.5969 15.4148L16.5329 8.57109C16.6243 8.44688 16.5352 8.27344 16.3829 8.27344Z" fill="#28a745"/>
                    <path d="M12 1.5C6.20156 1.5 1.5 6.20156 1.5 12C1.5 17.7984 6.20156 22.5 12 22.5C17.7984 22.5 22.5 17.7984 22.5 12C22.5 6.20156 17.7984 1.5 12 1.5ZM12 20.7188C7.18594 20.7188 3.28125 16.8141 3.28125 12C3.28125 7.18594 7.18594 3.28125 12 3.28125C16.8141 3.28125 20.7188 7.18594 20.7188 12C20.7188 16.8141 16.8141 20.7188 12 20.7188Z" fill="#28a745" />
                </svg>
                <h2>Verifikasi Email Berhasil Dilakukan</h2>
                @if ($user["type"] == 'peminjam')
                <p>
                    Anda sudah dapat melakukan peminjaman Alat
                </p>
            @else
                <p>
                    Anda sudah dapat mengakses portal admin
                </p>      
            @endif
            </div> 
        @endif
    </section>
</body>

</html>