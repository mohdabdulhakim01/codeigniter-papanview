<?php
$_this = &get_instance();

$navData = [
    [
        "name" => "Statistik",
        "icon" => "fas fa-pie-chart text-danger",
        "childs" => [
            ["url" => base_url() . 'pentadbir/Statistik', "name" => "Statistik Utama", "icon" => "fa fa-arrow-right"],
        ]
    ],
    [
        "name" => "Program",
        "icon" => "fas fa-copy text-success",
        "childs" => [
            ["url" => base_url() . 'pentadbir/Program/newprogram', "name" => "Daftar Program", "icon" => "fa fa-arrow-right"],
            ["url" => base_url() . 'pentadbir/Program', "name" => "Senarai Program", "icon" => "fa fa-arrow-right"]
        ]
    ],
    [
        "name" => "Responden",
        "icon" => "fas fa-users text-primary",
        "childs" => [
            ["url" => base_url() . 'pentadbir/SenaraiResponden', "name" => "Senarai Responden", "icon" => "fa fa-arrow-right"],
        ]
    ],
    [
        "name" => "Pengurus Ujian",
        "icon" => "text-secondary",
        "iconCustom" => "<span class='material-icons'>article</span>",
        "url" => base_url() . 'pentadbir/ExamManager'
    ],
    [
        "name" => "Tetapan",
        "icon" => "fas fa-cog text-dark",
        "childs" => [
            ["url" => base_url() . 'pentadbir/Settings/urusAgensi', "name" => "Urus Agensi", "icon" => "fa fa-arrow-right"],
            ["url" => base_url() . 'pentadbir/Settings/urusTujuan', "name" => "Urus Tujuan", "icon" => "fa fa-arrow-right"],
            ["url" => base_url() . 'pentadbir/UrusStaff', "name" => "Urus Staf", "icon" => "fa fa-arrow-right",'show'=>(isSAdmin() ? '' : 'd-none')]
            ,
            ["url" => base_url() . 'pentadbir/Settings/developerBox', "name" => "Developer Box", "icon" => "fa fa-arrow-right"],
        ]
    ]
    
   
    // [
    //     "name" => "Laporan",
    //     "icon" => "fas fa-chart-bar",
    //     "childs" => [
    //         ["url" => base_url() . 'pentadbir/LaporanIndividu', "name" => "Individu", "icon" => "fa fa-arrow-right"]
    //     ]
    // ],
    // [
    //     "name" => "Logout",
    //     "icon" => "fas fa-power-off",
    //     "action" => "logoutPrompt()",
    //     "class"=> "border border-4 border-danger rounded "
    // ]
];


?>
<style>
    .navbar-link:hover{
        background: #2196f3;
        color: white!important;
    }

</style>
<hr class="bg-dark h-1">
<div class="col-lg-2 col-md-3 position-relative " style="width: 100%;height:95%">
    <ul class="nav flex-column position-relative ">
        <?php foreach ($navData as $navItem) : ?>
            <?php if (isset($navItem['childs'])) : ?>
                <li class="nav-item  ">

                    <a class="nav-link  navbar-link <?= (isset($navItem['show'])) ? $navItem['show'] : '' ?> " href="#" data-bs-toggle="collapse" data-bs-target="#<?= $navItem['name'] ?>SubMenu"
                    <?php (isset($navItem['action'])) ? ' onclick="'.$navItem['action'].'" ' : '' ?>
                    
                    >
                        <div class="d-flex justify-content-between text-dark">
                            <div class=" d-flex align-items-center gap-2">
                                <i class="<?= $navItem['icon'] ?>"> <?= (isset($navItem['iconCustom']) ? $navItem['iconCustom'] : '') ?> </i><div> <?= $navItem['name'] ?></div>
                            </div>
                            <i class="fas fa-plus"></i>
                        </div>
                    </a>
                    <div id="<?= $navItem['name'] ?>SubMenu" class="collapse">
                        <ul class="nav flex-column">
                            <?php foreach ($navItem['childs'] as $child) : ?>
                                <li class="nav-item navbar-link <?= (isset($child['show'])) ? $child['show'] : '' ?>">
                                    <a class="nav-link flex-row d-flex align-items-center  gap-2" href="<?= $child['url'] ?>" style="flex-wrap: nowrap;">
                                        <i class="<?= $child['icon'] ?> "> <?= (isset($navItem['iconCustom']) ? $navItem['iconCustom'] : '') ?></i><div> <?= $child['name'] ?></div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item <?php echo ( (isset($navItem['class'])) ?  $navItem['class'].'" ' : '') ?>" >
                    <a class="nav-link navbar-link  text-dark  d-flex align-items-center  gap-2  <?php (isset($navItem['show'])) ? $navItem['show'] : 'cc' ?>" 
                    href="<?php echo ( (isset($navItem['url'])) ?  $navItem['url'] : '#') ?>" 
                    <?php echo ( (isset($navItem['action'])) ?  ' onclick="'.$navItem['action'].'" ' : '') ?>
                    >
                        <i class="<?= $navItem['icon'] ?>"> <?= (isset($navItem['iconCustom']) ? $navItem['iconCustom'] : '') ?></i><div> <?= $navItem['name'] ?></div>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <div class="position-absolute  w-100" style="bottom:3rem">
        <a class="nav-link navbar-link border border-4 border-dark bg-danger rounded  text-white p-2" onclick="logoutPrompt()" ><i class="fas fa-power-off"></i>&nbsp;Logout</a>
    </div>
</div>

<script>
    let base_url_ = '<?php out(base_url()) ?>';

    function logoutPrompt() {
        const title = 'Log Keluar Sistem';
        let action = " location.href = base_url_ + 'pentadbir/Verify/logout';";
        let actionTitle = 'Log Keluar&nbsp;<span class="fas fa-power-off"></span>';
        let btnColor = 'btn-danger';
        confirmBox(title, action, actionTitle, btnColor, "Anda pasti untuk log keluar sistem ? ");


    }
</script>