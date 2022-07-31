<div class="main-menu menu-fixed menu-accordion menu-shadow menu-dark" data-scroll-to-active="true" data-img="<?= BASE_THEME ?>adm/app-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="<?= BASE_URL ?>">
                    <img class="brand-logo" alt="Simlakah admin logo" src="<?= BASE_THEME ?>adm/app-assets/images/logo/sipeka-icon-v2.png" />
                    <img class="brand-logo-custom" alt="Simlakah admin logo" src="<?= BASE_THEME ?>adm/app-assets/images/logo/sipeka-label.png" />
                </a>
            </li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="font-family: Calibri !important; font-size: 1.3em;">
            <li class=" nav-item">
                <a href="#"><i class="ft-user"></i><span class="menu-title" data-i18n="">Profil</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="ft-server"></i><span class="menu-title" data-i18n="">Daftar Pengajuan</span></a>
                <ul class="menu-content" style="font-family: Calibri !important; font-size: 1.1rem;">
                    <?php if (strtolower($userLogin) == 'pusat') { ?>
                        <li class="active"><a class="menu-item" href="<?= BASE_URL ?>pengajuan/list/<?= strtolower($bagian) ?>"><?= $bagian ?></a></li>
                    <?php } else { ?>
                        <li class="<?= $menu['perpipaan'] ?>"><a class="menu-item" href="<?= BASE_URL ?>pengajuan/list/perpipaan">Perpipaan</a></li>
                        <li class="<?= $menu['perpompaan'] ?>"><a class="menu-item" href="<?= BASE_URL ?>pengajuan/list/perpompaan">Perpompaan</a></li>
                        <li class="<?= $menu['embung'] ?>"><a class="menu-item" href="<?= BASE_URL ?>pengajuan/list/embung">Embung</a></li>
                        <li class="<?= $menu['air-tanah'] ?>"><a class="menu-item" href="<?= BASE_URL ?>pengajuan/list/air-tanah">Air Tanah</a></li>
                    <?php } ?>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="<?= BASE_URL ?>pengajuan/dokumen/"><i class="ft-folder"></i><span class="menu-title" data-i18n="">Dokumen</span></a>
            </li>
        </ul>
    </div>
    <div class="navigation-background"></div>
</div>