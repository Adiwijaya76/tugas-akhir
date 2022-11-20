<?php
	if(is_array($datalogin)){
        foreach($datalogin as $x){
			$iduser = $x->id;
            $usrnama = $x->username;
			if(file_exists("dist/profil/".$iduser.".jpg")){
				$gbrprofil = base_url("dist/profil/".$iduser.".jpg");
			}else{
				$gbrprofil = base_url("dist/profil/guest.png");
			}
			$namauser = $x->nama;
			$lvluser = $x->level;
        }
	}else{
		$iduser = "guest";
		$gbrprofil = base_url("dist/profil/".$iduser.".png");
		$namauser = "Guest";
		$lvluser = "Public";
	}
?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Sistem Informasi Manajemen Administrasi">
        <meta name="author" content="Kecamatan Jogoroto Kabupaten Jombang">
        <title>Dashboard | SiMA</title>
        <link rel="apple-touch-icon" href="<?= base_url('assets/images/apple-touch-icon.png'); ?>">
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/css/bootstrap-extend.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/site.min.css'); ?>">
        <style>
            .jedaobyek {margin-top: -10px;}
        </style>
        <!-- Plugins -->
        <link rel="stylesheet" href="<?= base_url('global/vendor/animsition/animsition.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/asscrollable/asScrollable.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/switchery/switchery.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/intro-js/introjs.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/slidepanel/slidePanel.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/flag-icon-css/flag-icon.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/chartist/chartist.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/aspieprogress/asPieProgress.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/jquery-selective/jquery-selective.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/bootstrap-datepicker/bootstrap-datepicker.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/asscrollable/asScrollable.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/examples/css/dashboard/team.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/vendor/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
        <!-- Fonts -->
        <link rel="stylesheet" href="<?= base_url('global/fonts/web-icons/web-icons.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/fonts/brand-icons/brand-icons.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/fonts/material-design/material-design.css'); ?>">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
        <script src="<?= base_url('global/vendor/breakpoints/breakpoints.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/jquery/jquery-3.4.1.min.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/sweetalert.min.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/datatables.net/jquery.dataTables.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>
        <script>Breakpoints();</script>
    </head>
    <body class="animsition site-navbar-small dashboard">
        <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="hamburger-bar"></span>
                </button>
                <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
                    <i class="icon wb-more-horizontal" aria-hidden="true"></i>
                </button>
                <a class="navbar-brand navbar-brand-center" href="index.html">
                    <img class="navbar-brand-logo navbar-brand-logo-normal" src="<?= base_url('assets/images/pemda.png'); ?>" title="SiMA">
                    <img class="navbar-brand-logo navbar-brand-logo-special" src="<?= base_url('assets/images/pemda.png'); ?>" title="SiMA">
                    <span class="navbar-brand-text hidden-xs-down"> SiMA</span>
                </a>
            </div>
    
            <div class="navbar-container container-fluid">
                <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                    <ul class="nav navbar-toolbar">
                        <li class="nav-item hidden-float" id="toggleMenubar">
                            <a class="nav-link" data-toggle="menubar" href="#" role="button">
                                <i class="icon hamburger hamburger-arrow-left">
                                    <span class="sr-only">Toggle menubar</span>
                                    <span class="hamburger-bar"></span>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                            <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button"><span class="sr-only">Toggle fullscreen</span></a>
                        </li>
                    </ul>
    
                    <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                        <li class="nav-item" id="mnrefresh">
                            <a class="nav-link" href="javascript:void(0)" title="Refresh Halaman" aria-expanded="false" data-animation="scale-up" role="button">
                                <i class="icon wb-reload" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                                data-animation="scale-up" role="button">
                                <span class="avatar avatar-online">
                                <img src="<?= base_url('assets/profil/'.$iduser.'.jpg'); ?>" alt="...">
                                <i></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><?= $namauser; ?></a>
                                <div class="dropdown-divider" role="presentation"></div>
                                <a class="dropdown-item" href="javascript:void(0)" role="menuitem" id="mnprofil"><i class="icon wb-user" aria-hidden="true"></i> Profil</a>
                                <a class="dropdown-item" href="javascript:void(0)" role="menuitem" id="mnpassword"><i class="icon wb-settings" aria-hidden="true"></i> Password</a>
                                <div class="dropdown-divider" role="presentation"></div>
                                <a class="dropdown-item" href="javascript:void(0)" role="menuitem" id="mnlogout"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="site-menubar site-menubar-light">
            <div class="site-menubar-body">
                <div>
                    <ul class="site-menu" data-plugin="menu">
                        <li class="dropdown site-menu-item active" id="mndashboard">
                            <a href="<?= base_url('Dashboard'); ?>">
                                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="page">
            <div class="page-content">
                <?php 
					if($fill == ""){include "b416k.php";}
					else{include $fill.".php";}
				?>
            </div>
        </div>

        <div class="modal fade modal-primary" id="modal-profil" aria-hidden="true" aria-labelledby="modal-profil" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Profil</h4>
                    </div>
                    <div class="modal-body">
                        <div class="card-block p-10">
                            <a class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                                <img src="<?= base_url('assets/profil/'.$iduser.'.jpg'); ?>" alt="...">
                            </a>
                            <div class="vertical-align h-100 text-truncate">
                                <div class="vertical-align-middle">
                                    <div class="font-size-20 mb-5 blue-600 text-truncate"><?= $namauser; ?></div>
                                    <div class="font-size-14 text-truncate">ID: <?= $iduser; ?></div>
                                    <div class="font-size-14 text-truncate">Username: <?= $usrnama; ?></div>
                                    <div class="font-size-14 text-truncate">Level: <?= $lvluser; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-info" id="modal-gantipassword" aria-hidden="true" aria-labelledby="modal-gantipassword" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Ganti Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12">
                            <label class="form-control-label">Password*</label>
                            <input type="password" class="form-control khusus_abjad jedaobyek" id="txtpl" placeholder="Password Lama Anda" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12 jedaobyek">
                            <label class="form-control-label">Password Baru*</label>
                            <input type="password" class="form-control khusus_abjad jedaobyek" id="txtpb" placeholder="Password Baru Anda" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12 jedaobyek">
                            <label class="form-control-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control khusus_abjad jedaobyek" id="txtpk" placeholder="Konfirmasi Password Baru Anda" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light" id="btngantipassword">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <footer class="site-footer">
            <div class="site-footer-legal">© 2021 <a href="javascript:void(0)">SiMA</a></div>
            <div class="site-footer-right">
                Crafted with <i class="red-600 wb wb-heart"></i> by <a href="javascript:void(0)">ChemickSoft</a>
            </div>
        </footer>
    
        <script src="<?= base_url('global/vendor/babel-external-helpers/babel-external-helpers.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/popper-js/umd/popper.min.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/bootstrap/bootstrap.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/animsition/animsition.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/mousewheel/jquery.mousewheel.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/asscrollbar/jquery-asScrollbar.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/asscrollable/jquery-asScrollable.js'); ?>"></script>
    
        <!-- Plugins -->
        <script src="<?= base_url('global/vendor/switchery/switchery.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/intro-js/intro.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/screenfull/screenfull.js'); ?>"></script>
        <script src="<?= base_url('global/vendor/slidepanel/jquery-slidePanel.js'); ?>"></script>
    
        <!-- Scripts -->
        <script src="<?= base_url('global/js/Component.js'); ?>"></script>
        <script src="<?= base_url('global/js/Plugin.js'); ?>"></script>
        <script src="<?= base_url('global/js/Base.js'); ?>"></script>
        <script src="<?= base_url('global/js/Config.js'); ?>"></script>
        
        <script src="<?= base_url('assets/js/Section/Menubar.js'); ?>"></script>
        <script src="<?= base_url('assets/js/Section/Sidebar.js'); ?>"></script>
        <script src="<?= base_url('assets/js/Section/PageAside.js'); ?>"></script>
        <script src="<?= base_url('assets/js/Plugin/menu.js'); ?>"></script>
        
        <!-- Config -->
        <script src="<?= base_url('global/js/config/colors.js'); ?>"></script>
        <script src="<?= base_url('assets/js/config/tour.js'); ?>"></script>
    
        <!-- Page -->
        <script src="<?= base_url('assets/js/Site.js'); ?>"></script>
        <script src="<?= base_url('global/js/Plugin/asscrollable.js'); ?>"></script>
        <script src="<?= base_url('global/js/Plugin/slidepanel.js'); ?>"></script>
        <script src="<?= base_url('global/js/Plugin/switchery.js'); ?>"></script>
            <script src="<?= base_url('global/js/Plugin/matchheight.js'); ?>"></script>
            <!-- <script src="<?= base_url('global/js/Plugin/aspieprogress.js'); ?>"></script> -->
            <!-- <script src="<?= base_url('global/js/Plugin/bootstrap-datepicker.js'); ?>"></script> -->
            <script src="<?= base_url('global/js/Plugin/asscrollable.js'); ?>"></script>
        
            <script src="<?= base_url('assets/examples/js/dashboard/team.js'); ?>"></script>
    
        <script>
            function ke(el){
                var linksistem = $(el).data("linksistem");
                if(linksistem == ""){
                    swal({title: 'Akses Gagal', text: 'Akses Sistem Tidak Tersedia', icon: 'error', confirmButtonClass: 'btn btn-confirm mt-2'});
                    return;
                }
                window.location = linksistem;
            }

            function profil(){$("#modal-profil").modal("show");}
            function gantipassword(){$("#modal-gantipassword").modal("show");}
            function updatepassword(){
                var lama = $("#txtpl").val();
                var baru = $("#txtpb").val();
                var konfirmasi = $("#txtpk").val();
                if(lama == "" || baru == "" || konfirmasi == ""){
                    swal({title: 'Update Gagal', text: 'Ada Isian yang Masih Kosong !', icon: 'error',});
                    return;
                }
                if(baru != konfirmasi){
                    swal({title: 'Update Gagal', text: 'Password Baru dan Konfirmasi Tidak Sesuai', icon: 'error',});
                    return;
                }
                swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
                $.ajax({
                    url: "<?= base_url('/Dashboard/gantipassword'); ?>",
                    method: "POST",
                    data: {lama: lama, baru: baru},
                    cache: "false",
                    success: function(x){
                        swal.close();
                        var y = atob(x);
                        if(y == 1){
                            swal({
                                title: 'Update Berhasil',
                                text: "Password Anda Berhasil di Ubah, Sistem Akan Logout !",
                                icon: 'info',
                                buttons:{
                                    confirm: {text : 'Ok', className : 'btn btn-primary'}
                                }
                            }).then((Okk)=>{
                                if(Okk){
                                    window.location = "";
                                }else{swal.close();}
                            });
                        }else{
                            if(y == 90){
                                swal({title: 'Update Gagal', text: 'Password Lama Anda Salah', icon: 'error',});
                            }else{
                                swal({title: 'Update Gagal', text: 'Periksa Kembali Isian Anda', icon: 'error',});
                            }
                        }
                    },
                    error: function(){
                        swal.close();
                        swal({title: 'Update Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
                    }
                })
            }

            function logout(){
                swal({
                    title: 'Logout Sistem',
                    text: "Anda Yakin Ingin Logout ?",
                    icon: 'warning',
                    buttons:{
                        confirm: {text : 'Yakin', className : 'btn btn-success'},
                        cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
                    }
                }).then((Logout)=>{
                    if(Logout){
                        swal("Memproses Akun.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
                        $.ajax({
                            url: "<?= base_url('Dashboard/logout'); ?>",
                            cache: "false",
                            success: function(x){
                                swal.close();
                                var y = atob(x);
                                if(y == 1){
                                    window.location = "<?= base_url(); ?>";
                                }else{
                                    swal({
                                        title: 'Logout Gagal',
                                        text: 'Coba Beberapa Saat Lagi',
                                        icon: 'error',
                                        confirmButtonClass: 'btn btn-confirm mt-2'
                                    });
                                }
                            },
                            error: function(){
                                swal.close();
                                swal({title: 'Logout Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
                            }
                        })
                    }else{swal.close();}
                });
            }

            $("#mnlogout").click(function(){logout();});
            $("#mnprofil").click(function(){profil();});
            $("#mnpassword").click(function(){gantipassword();});
            $("#btngantipassword").click(function(){updatepassword();});
            $("#mnrefresh").click(function(){window.location = "";});

            $('.cegahenter').keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                }
            });
            $(".khusus_angka").keypress(
                function(e){
                    var chr = String.fromCharCode(e.which);
                    if("1234567890".indexOf(chr) < 0) return false;
                }
            )
        </script>
    </body>
</html>