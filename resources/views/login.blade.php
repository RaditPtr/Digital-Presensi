<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <style>
        .spacer {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .tengah {
            margin-left: 25%;
            margin-top: 10%;
            width: 50%;
            padding: 10px;
        }

        body{
            background-color: #80B3FF;
        }
        .card{
            padding: 25px 0;
        }
        .cuy{
            margin: auto;
        }
        .nih{
            margin: auto;
        }
        .logsy{
            text-align: center;
            padding-bottom: 30px;
        }
        .label{
            padding-bottom: 5px;
        }
        .cet {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .gambar {
            padding: 0px 20px;
        }
       img{
        display: block;
        margin: 20px auto; 
       } 
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-4 tengah">
                    <form method="POST">
                        <div class="card bg-white">
                            <div class="container cuy">
                                <div class="row">
                                    <div class="col-sm gambar">
                                        <img src={{ asset('img/loginpict.png') }} alt="description of myimage" width="200">
                                    </div>
                                    <div class="col-sm nih">
                                        <div>
                                            <h2 class="logsy">LOGIN</h2>
                                        </div>
                                        <div class="form-group">
                                            <label class="label">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Masukkan Username" />
                                        </div>
                                        <div class="form-group cet">
                                            <label class="label">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" />
                                            @csrf
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success">LOGIN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script type='module'>
        $('.btnLogin').on('click', function(a){
            axios.post('auth/check', {
                username : $('#userName').val(),
                password : $('#passWord').val(),
                _token : '{{csrf_token()}}'
            }).then(function(response){

                if(response.data.success){
                    window.location.href = response.data.redirect_url;   
                }else{
                    swal.fire('Gagal login, username atau password salah', '', 'error');
                }
            }).catch(function(error){
                if(error.response.status === 422){
                    swal.fire(error.response.data.message, '', 'error')
                }else{
                    swal.fire('gagal login, username/password salah')
                }
            });
        });
    </script>
</footer>

</html>