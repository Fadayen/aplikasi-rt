<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Warga</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: #e9eef4;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .frame {
            background: white;
            width: 900px;
            height: 580px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            position: relative;
        }

        .inner-box {
            background: #f6f7f9;
            width: 100%;
            height: 100%;
            border-radius: 15px;
            padding: 40px 60px;
            overflow-y: auto;
        }

        .form-title {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-control {
            height: 42px;
        }

        /* Eye icon di tengah dan di kanan */
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
            font-size: 18px;
            color: #666;
        }

        .eye-icon:hover {
            color: #000;
        }
    </style>
</head>

<body>

<div class="frame">
    <div class="inner-box">

        <h2 class="form-title">Register Warga</h2>

        <form action="/register" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>

                <!-- Password -->
                <div class="col-md-6">
                    <label>Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <i class="bi bi-eye-fill eye-icon" onclick="togglePassword('password', this)"></i>
                    </div>
                </div>

                <!-- Password Konfirmasi -->
                <div class="col-md-6">
                    <label>Password Konfirmasi</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password2" name="password_confirmation" placeholder="Password Konfirmasi">
                        <i class="bi bi-eye-fill eye-icon" onclick="togglePassword('password2', this)"></i>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Nomor Kartu Keluarga</label>
                    <input type="text" class="form-control" name="no_kk" placeholder="Nomor Kartu Keluarga">
                </div>

                <div class="col-md-6">
                    <label>NIK</label>
                    <input type="text" class="form-control" name="nik" placeholder="NIK">
                </div>

                <div class="col-md-12">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                </div>

                <div class="col-md-6">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                </div>

                <div class="col-md-6">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir">
                </div>

                <div class="col-md-6">
                    <label>Agama</label>
                    <select class="form-control" name="agama">
                        <option value="">-- Pilih Agama --</option>
                        <option>Islam</option>
                        <option>Kristen</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Konghucu</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option value="">-- Pilih --</option>
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Nomor HP</label>
                    <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP">
                </div>

                <div class="col-md-12">
                    <label>Alamat Lengkap</label>
                    <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap"></textarea>
                </div>

            </div>

            <button class="btn btn-primary w-100 mt-4">Register</button>

        </form>
    </div>
</div>

<!-- JAVASCRIPT SHOW / HIDE PASSWORD -->
<script>
function togglePassword(id, icon) {
    const field = document.getElementById(id);

    if (field.type === "password") {
        field.type = "text";
        icon.classList.remove("bi-eye-fill");
        icon.classList.add("bi-eye-slash-fill");
    } else {
        field.type = "password";
        icon.classList.remove("bi-eye-slash-fill");
        icon.classList.add("bi-eye-fill");
    }
}
</script>

</body>
</html>
