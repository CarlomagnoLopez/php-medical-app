<?php if (!defined('s7V9pz')) {
    die();
} ?><?php
    fnc('grupo');
    $usr = usr('Grupo');
   // var_dump($usr);
    if (!$usr['active']) {
        rt('signin');
    }
    grupofns();
    gr_unverified();
    gr_profile('ustatus', 'online');
    gr_usip('add');
    $org = db('Grupo', 'q', 'SELECT * FROM gr_organizations WHERE id_organization=' . $usr['id_organization']);
    $globalDataUser = db('Grupo', 'q', 'SELECT * FROM gr_users WHERE id=' .$usr['id'])[0];
   // var_dump($globalDataUser);


    ?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta charset="utf-8">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no shrink-to-fit=no">
    <title><?php pr(gr_default('get', 'sitename') . ' - ' . gr_default('get', 'siteslogan')); ?></title>
    <meta name="description" content="<?php pr(gr_default('get', 'sitedesc')); ?>">
    <meta name="author" content="BaeVox">
    <meta name="generator" content="Grupo - Powered by BaeVox">
    <link rel="shortcut icon" type="image/png" href="<?php pr(mf("grupo/global/favicon.png")); ?>" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600,700,700i,800" rel="stylesheet">
    <link href="https://weloveiconfonts.com/api/?family=entypo" rel="stylesheet">
    <link rel="stylesheet" href="dist/view-bigimg-master/lib/view-bigimg.css">

    <?php
    cdn("npm/bootstrap@4.3.1/dist/css/bootstrap.min.css");
    cdn("npm/cd-themify-icons@0.0.1/index.css");
    cdn("libs/emojionearea/3.4.1/emojionearea.min.css");
    cdn("npm/animate.css@3.7.0/animate.min.css");
    css("grupo");
    gr_cbg();
    gr_core('hf', 'header');
    ?>
</head>
<input type="hidden" id="global_role" value="<?php pr($usr['role']); ?>">
<input type="hidden" id="global_id_user" value="<?php pr($usr['id']); ?>">
<input type="hidden" id="global_id_organization" value="<?php pr($usr['id_organization']); ?>">

<body>

    <div class='gr-preloader'>
        <div>
            <span></span>
        </div>
    </div>
    <section class="swr-grupo baevox-powered">
        <div class='window fh'>
            <div class="container-fluid fh">
                <div class="row fh">
                    <div class="col-md-3 aside lside">
                        <div class='head'>
                            <span class='menu'>
                                <i class="ti-menu mmenu subnav">
                                    <div class='swr-menu'>
                                        <ul>
                                            <li class='formpop' title='<?php pr(gr_lang('get', 'edit_profile')) ?>' do='edit' btn='<?php pr(gr_lang('get', 'update')) ?>' act='profile'><?php pr(gr_lang('get', 'edit_profile')) ?></li>
                                            <li class='formpop' title='<?php pr(gr_lang('get', 'change_avatar')) ?>' do='edit' btn='<?php pr(gr_lang('get', 'update')) ?>' act='avatar'><?php pr(gr_lang('get', 'change_avatar')) ?></li>
                                            <?php
                                            if (gr_role('access', 'fields', '4')) {
                                            ?>
                                                <li class='loadside' act='ufields' zero='0' zval='<?php pr(gr_lang('get', 'zero_fields')) ?>' side='lside'><?php pr(gr_lang('get', 'fields')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'users', '4')) {
                                            ?>
                                                <li class='loadside' act='users' side='lside' zero='0' zval='<?php pr(gr_lang('get', 'zero_users')) ?>'><?php pr(gr_lang('get', 'users')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'roles', '3')) {
                                            ?>
                                                <li class='loadside' act='roles' zero='0' zval='<?php pr(gr_lang('get', 'zero_roles')) ?>' side='lside'><?php pr(gr_lang('get', 'roles')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'users', '5')) {
                                            ?>
                                                <li class='loadside' act='online' zero='0' zval='<?php pr(gr_lang('get', 'zero_online')) ?>' side='lside'><?php pr(gr_lang('get', 'online')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'languages', '4')) {
                                            ?>
                                                <li class='loadside' act='languages' zero='0' zval='<?php pr(gr_lang('get', 'zero_languages')) ?>' side='lside'><?php pr(gr_lang('get', 'languages')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'sys', '2')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'appearance')) ?>' do='system' btn='<?php pr(gr_lang('get', 'update')) ?>' act='appearance'><?php pr(gr_lang('get', 'appearance')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'sys', '5')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'header_footer')) ?>' do='system' btn='<?php pr(gr_lang('get', 'update')) ?>' act='hf'><?php pr(gr_lang('get', 'header_footer')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'sys', '3')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'banip')) ?>' do='system' btn='<?php pr(gr_lang('get', 'update')) ?>' act='banip'><?php pr(gr_lang('get', 'banip')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'sys', '4')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'filterwords')) ?>' do='system' btn='<?php pr(gr_lang('get', 'update')) ?>' act='filterwords'><?php pr(gr_lang('get', 'filterwords')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'sys', '1')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'settings')) ?>' do='system' btn='<?php pr(gr_lang('get', 'update')) ?>' act='settings'><?php pr(gr_lang('get', 'settings')) ?></li>
                                            <?php
                                            }
                                            ?>
                                            <li class='ajx switchmode' data-act=1 data-do='profile' data-type='mode'><?php gr_profile('mode'); ?></li>
                                            <li class='standby'><?php pr(gr_lang('get', 'stand_by')); ?></li>
                                            <li class='ajx' data-act=1 data-do='logout'><?php pr(gr_lang('get', 'logout')) ?></li>
                                        </ul>
                                    </div>
                                </i>
                            </span>
                            <span class='logo'><?php pr($org[0]['organization']); ?></span>
                            <span class='icons'>
                                <i class='ti-bell malert goright d-md-none' data-block='alerts'><?php gr_alerts('count', 1); ?></i>
                                <i class="ti-plus subnav">
                                    <div class='swr-menu r-end'>
                                        <ul>
                                            <?php
                                            // if (gr_role('access', 'groups', '1')) {
                                            ?>
                                            <li class='formpop' title='<?php pr(gr_lang('get', 'create_group')) ?>' do='create' btn='<?php pr(gr_lang('get', 'create')) ?>' act='group'><?php pr(gr_lang('get', 'create_group')) ?></li>
                                            <?php
                                            //}
                                            if (gr_role('access', 'users', '1')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'create_user')) ?>' do='create' btn='<?php pr(gr_lang('get', 'create')) ?>' act='user'><?php pr(gr_lang('get', 'create_user')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'roles', '1')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'create_role')) ?>' do='create' btn='<?php pr(gr_lang('get', 'create')) ?>' act='role'><?php pr(gr_lang('get', 'create_role')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'languages', '1')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'add_language')) ?>' do='create' btn='<?php pr(gr_lang('get', 'add')) ?>' act='language'><?php pr(gr_lang('get', 'add_language')) ?></li>
                                            <?php
                                            }
                                            if (gr_role('access', 'fields', '1')) {
                                            ?>
                                                <li class='formpop' title='<?php pr(gr_lang('get', 'add_custom_field')) ?>' do='create' btn='<?php pr(gr_lang('get', 'add')) ?>' act='customfield'><?php pr(gr_lang('get', 'add_custom_field')) ?></li>
                                            <?php
                                            } ?>
                                        </ul>
                                    </div>
                                </i>
                            </span>
                        </div>
                        <div class="search">
                            <i class="ti-search"></i>
                            <input type="text" placeholder='<?php pr(gr_lang('get', 'search_here')) ?>' />
                        </div>
                        <div class="tabs">
                            <ul>
                                <li id="liGroups" class='active' act='groups' side='lside' zero='0' unseen='<?php pr(gr_group('unseen')) ?>' zval='<?php pr(gr_lang('get', 'zero_groups')) ?>'><?php pr(gr_lang('get', 'groups')) ?> <i></i></li>
                                <?php
                                if (gr_role('access', 'privatemsg', '2')) {
                                ?>
                                    <li act='pm' side='lside' zero='0' unread='0' zval='<?php pr(gr_lang('get', 'zero_pm')) ?>'><?php pr(gr_lang('get', 'pm')) ?> <i></i></li>
                                <?php
                                } ?>
                                <?php
                                if (gr_role('access', 'files', '5')) {
                                ?>
                                    <li act='files' side='lside' zero='0KB' zval='<?php pr(gr_lang('get', 'zero_files')) ?>'><?php pr(gr_lang('get', 'files')) ?></li>
                                <?php
                                } ?>

                                <li id="liOptions" side='lside' class='xtra'></li>
                            </ul>
                        </div>
                        <div class="content">
                            <ul class='list fh scroller'>

                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 nomob panel" no=0>
                        <div class='head groupnav d-none'>
                            <i class='icon ti-angle-double-left goback d-md-none'></i>
                            <span class='left'>
                                <span class="nameGroup">
                                    <img src="<?php pr(url()); ?>gem/ore/grupo/groups/default.png">
                                    <span></span>
                                </span></span>
                            <span class='right'>
                                <?php
                                if (gr_role('access', 'files', '6')) {
                                ?>
                                    <i class='icon ti-folder goback d-md-none' data-block="files"></i>
                                <?php
                                } ?>
                                <i class='ti-view-grid goright d-md-none' data-block='crew'></i>
                                <i class="ti-more-alt subnav">
                                    <div class='swr-menu r-end'>
                                        <ul></ul>
                                    </div>
                                </i></span>
                        </div>
                        <div class='room fh'>
                            <span class='groupreload'><i class='turnchat' do='on'><i class='ti-reload'></i><?php pr(gr_lang('get', 'reload')) ?></i></span>
                            <ul class='msgs fh scroller'>
                                <div class='zeroelem fh'>
                                    <div>
                                        <span>
                                            <i>0M</i>
                                            <span><?php pr(gr_lang('get', 'no_group_selected')) ?></span>
                                        </span>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div class='textbox d-none disabled'>
                            <div class="mentstore"></div>
                            <div class="mentions">
                                <ul>
                                </ul>
                                <input type='hidden' />
                            </div>
                            <span class='box'>
                                <span class='icon'>
                                    <i class='gr-response d-none'></i>
                                    <?php
                                    if (gr_role('access', 'files', '4')) {
                                    ?>
                                        <i class='gr-attach'>
                                            <form class='atchmsg' enctype="multipart/form-data">
                                                <input type="hidden" name="act" value="1">
                                                <input type="hidden" name="do" value="group">
                                                <input type="hidden" name="id" class='gid'>
                                                <input type="hidden" name="type" value="attachmsg">
                                                <input type='file' name='attachfile' class='attachfile' />
                                            </form>
                                        </i>
                                    <?php
                                    } ?>
                                    <i class='gr-emoji'></i>
                                </span>
                                <textarea></textarea>
                                <input type='hidden' value=0 class='replyid' />
                                <i class='sendbtn'><i></i></i>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3 nomob aside rside">
                        <div class='top'>
                            <span class='left'>
                                <i class='icon ti-angle-double-left goback d-md-none'></i>
                                <!-- diego -->
                                <span class="vwp" no="<?php pr($usr['id']); ?>">
                                    <img src="<?php pr(gr_img('users', $usr['id'])); ?>">
                                    <span><?php pr(usr('Grupo', 'select', $usr['id'])['name']) ?>
                                        <span>@<?php pr(usr('Grupo', 'select', $usr['id'])['username']) ?></span>
                                    </span>
                                </span></span>
                            <span class='right'>
                                <?php pr(gr_lang('list')) ?>
                            </span>
                        </div>
                        <div class="search">
                            <i class="ti-search"></i>
                            <input type="text" placeholder='<?php pr(gr_lang('get', 'search_messages')) ?>' />
                        </div>
                        <div class="tabs">
                            <ul>
                                <li act='alerts' zero='0' zval='<?php pr(gr_lang('get', 'zero_alerts')) ?>' side='rside'><?php pr(gr_lang('get', 'alerts')) ?> <i></i></li>
                                <li act='crew' class='grtab d-none' zero='0' zval='<?php pr(gr_lang('get', 'zero_crew')) ?>' side='rside'><?php pr(gr_lang('get', 'crew')) ?></li>
                                <li act='complaints' comp=0 class='grtab d-none' zero='0' zval='<?php pr(gr_lang('get', 'zero_complaints')) ?>' side='rside'><?php pr(gr_lang('get', 'complaints')) ?> <i></i></li>
                                <li side='rside' class='xtra'></li>
                            </ul>
                        </div>
                        <div class="content">
                            <ul class='list fh groups scroller'>

                            </ul>
                            <div class="profile">
                                <div class="top">
                                    <?php
                                    if ($usr['role'] == 3) {
                                    ?>
                                        <span class="edit"><i class='formpop' title='<?php pr(gr_lang('get', 'edit_profile')) ?>' data-side="profile" do='edit' btn='<?php pr(gr_lang('get', 'update')) ?>' xtid="" act='profile'><?php pr(gr_lang('get', 'edit_profile')) ?></i></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="edit"><i class='formpop' style="color: transparent !important;border: 1px solid transparent !important;" title='<?php pr(gr_lang('get', 'edit_profile')) ?>' data-side="profile" do='edit' btn='<?php pr(gr_lang('get', 'update')) ?>' xtid="" act='profile'><?php pr(gr_lang('get', 'edit_profile')) ?></i></span>
                                    <?php
                                    }
                                    ?>
                                    <span class="dp"><img src="" /></span>
                                    <span class="name"></span>
                                    <span class="role"></span>
                                    <span class="refresh vwp d-none">refresh</span>
                                   
                                </div>
                                <div class="middle">
                                    <span class="pm loadgroup" ldt="user" no=""><?php pr(gr_lang('get', 'message')) ?></span>
                                    <span class="stats">
                                        <span><span>0</span><i><?php pr(gr_lang('get', 'hearts')) ?></i></span>
                                        <span><span>0</span><i><?php pr(gr_lang('get', 'shares')) ?></i></span>
                                        <span><span>0</span><i><?php pr(gr_lang('get', 'last_login')) ?></i></span>
                                    </span>
                                </div>
                                <div class="bottom">
                                    <div>
                                        <ul class="scroller">
                                        </ul>
                                        <div>
                                            <div>
                                                <span>
                                                    0
                                                    <span><?php pr(gr_lang('get', 'empty_profile')) ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <section class="grupo-standby">
        <div>
            <span><img src="<?php pr(mf("grupo/global/logo.png")); ?>" /></span>
        </div>
    </section>

    <section class="grupo-pop">
        <div>
            <form method='post' autocomplete="off" class='grform'>
                <span class="head"></span>
                <div class="fields scroller">

                </div>

                <input type="hidden" name="act" value="1">
                <input type="hidden" name="do" class="grdo">
                <input type="hidden" name="type" class="grtype">
                <input type="hidden" name="global_group_selected" id="global_group_selected">
                <input type="hidden" name="global_role" value="<?php pr($usr['role']); ?>">
                <input type="hidden" name="global_id_user" value="<?php pr($usr['id']); ?>">
                <input type="hidden" name="global_id_organization" value="<?php pr($usr['id_organization']); ?>">

                <input type="submit" class='ajx grsub' form='.grform'>
                <span class="cancel"><?php pr(gr_lang('get', 'cancel')) ?></span>
            </form>
        </div>
    </section>

    <section class="grupo-video">
        <div>
            <div>
                <span> <i class="ti-close"></i></span>
            </div>
        </div>
    </section>
    <div class="out d-none"></div>
    <span class='autodelmsgz d-none'><?php pr(vc(gr_default('get', 'autodeletemsg'), 'num')) ?></span>
    <div class="dumb d-none">
        <span class='liveupdate'><?php pr(gr_lang('get', 'refresh')) ?></span>
        <span class="loadgroup"></span>
        <audio id='gralert'>
            <source src="gem/ore/grupo/global/alert.mp3" />
        </audio>
        <input type='hidden' class='hidid' value=1 />
        <li class='loadside ruserz' act='rusers' zero='0' zval='<?php pr(gr_lang('get', 'zero_users')) ?>' side='rside'><?php pr(gr_lang('get', 'users')) ?></li>
    </div>


    <section id="modalCreateUser" class="grupo-pop-modal" style="display: none;">
        <div>
            <form autocomplete="off" style="height: 500px !important;">
                <span class="head">Create User</span>
                <div class="fields scroller" tabindex="5">
                    <label class="color-label">Name *</label>
                    <input type="text" name="fName" id="txtName" class="margin-input">
                    <!-- <label class="color-label">Last Name</label>
                    <input type="text" name="fLastName" id="txtLastName" class="margin-input"> -->
                    <!-- <label class="color-label">Address</label>
                    <input type="text" name="fAddress" id="txtAddress" class="margin-input">
                    <label class="color-label">ZipCode</label>
                    <input type="text" name="fZipCode" id="txtZipCode" class="margin-input only-numbers zipCodeLimit"> -->
                    <div style="margin-top: 30px;position: absolute;">
                        <select name="fcomplementPhone" id="selComplementPhone">
                            <option value="1" selected>+1</option>
                            <option value="86">+86</option>
                            <option value="87">+87</option>
                            <option value="91">+91</option>
                            <option value="55">+55</option>
                            <option value="52">+52</option>
                        </select>
                    </div>
                    <label class="color-label">Phone Number *</label>
                    <input type="text" name="fPhoneNumber" id="txtPhoneNumber" class="margin-input only-numbers phoneNumberLimit" style="margin-left: 60px;width: 178px;">
                    <label class="color-label">Email</label>
                    <input type="text" name="fEmail" id="txtEmail" class="margin-input">
                    <!-- <label class="color-label">Password</label>
                    <input type="password" name="fPassword" id="txtPassword" class="margin-input">
                    <label class="color-label">Repeat Password</label>
                    <input type="password" name="fRepeatPass" id="txtRepeatPassword" class="margin-input"> -->
                    <label class="color-label">Role *</label>
                    <select name="sent" class="margin-input color-label" id="selRole">
                        <option value="0">-----</option>
                        <option value="6">User</option>
                        <option value="5">Approver</option>
                        <option value="3">Org Admin</option>
                    </select>

                    <input type="hidden" autocomplete='off' id="txtUsername" name="fUsername" />
                    <input type="hidden" autocomplete='off' id="txtIdOrganization" name="fIdOrganization" />
                    <input type="hidden" autocomplete='off' id="txtStatusUser" name="fStatusUser" />

                </div>
                <input type="hidden" name="act" value="1">
                <input type="hidden" name="do" class="grdo" value="create">
                <input type="hidden" name="type" class="grtype" value="user">
                <input type="button" onclick="onClickFormCreateUser(this)" class="button-submit-form ajx grsub" value="Create User">
                <span class="cancel" onclick="onClickCancelCreateUser()">Cancel</span>
            </form>
        </div>
    </section>


    <section id="modalCreateGroup" class="grupo-pop-modal" style="display: none;">
        <div>
            <form autocomplete="off" style="height: 420px !important;">
                <span class="head">Create Group</span>
                <div class="fields scroller" tabindex="5" style="overflow-y: hidden; outline: none;">
                    <label>Group Name *</label>
                    <input type="text" name="name" id="txtGroupName">
                    <label>Password *</label>
                    <input type="password" name="password" id="txtGroupPassword">
                    <label>Repeat Password *</label>
                    <input type="password" name="password" id="txtGroupRepeatPassword">
                    <!-- <label>Icon</label>
                    <span class="fileup"> -->
                    <!-- <input type="file" name="img" class=" "  style="display: none;">
                    <span>Choose a file</span>
                    </span> -->
                </div>
                <input type="hidden" name="act" value="1">
                <input type="hidden" name="do" class="grdo" value="create">
                <input type="hidden" name="type" class="grtype" value="group">
                <input type="button" onclick="onClickFormCreateGroup(this)" class="button-submit-form ajx grsub" value="Create Group">
                <span class="cancel" onclick="onClickCancelCreateGroup()">Cancel</span>
            </form>


        </div>
    </section>


    <section id="modalTakeAction" class="grupo-pop-modal" style="display: none;">
        <div>
            <form autocomplete="off" style="height: 250px !important;">
                <span class="head">Take Action</span>
                <div class="fields scroller" tabindex="5" style="overflow-y: hidden; outline: none;">
                    <label>Select Option from Dropdown</label>
                    <select name="opted" class="" id="selActionUser">
                        <option value="">-----</option>
                        <option value="0">Disable</option>
                        <option value="1">Enable</option>
                    </select>
                </div>
                <button type="button" onclick="onClickStatusUser(this)" class="button-submit-form  ajx grsub">Confirm Change</button>
                <span class="cancel" onclick="onClickCancelTakeAction()">Cancel</span>
            </form>
        </div>
    </section>

    <section id="modalEditProfile" class="grupo-pop-modal" style="display: none;overflow: auto;">
        <div>
            <form autocomplete="off" style="height: 750px !important;">
                <span class="head">Edit Profile</span>
                <div class="fields scroller" tabindex="5">
                    <label class="color-label">Name *</label>
                    <input type="text" name="fName" id="txtProfileName" class="margin-input">
                    <label class="color-label">Last Name *</label>
                    <input type="text" name="fLastName" id="txtProfileLastName" class="margin-input">
                    <label class="color-label">Address *</label>
                    <input type="text" name="fAddress" id="txtProfileAddress" class="margin-input">
                    <label class="color-label">ZipCode</label>
                    <input type="text" name="fZipCode" id="txtProfileZipCode" class="margin-input only-numbers zipCodeLimit">
                    <div style="margin-top: 30px;position: absolute;">
                        <select name="fcomplementPhone" id="selProfileComplementPhone">
                            <option value="+1" selected>+1</option>
                            <option value="+86">+86</option>
                            <option value="+87">+87</option>
                            <option value="+91">+91</option>
                            <option value="+55">+55</option>
                            <option value="+52">+52</option>
                        </select>
                    </div>
                    <label class="color-label">Phone Number *</label>
                    <input type="text" name="fPhoneNumber" id="txtProfilePhoneNumber" class="margin-input only-numbers phoneNumberLimit" style="margin-left: 60px;width: 178px;">
                    <label class="color-label">Email</label>
                    <input type="text" name="fEmail" id="txtProfileEmail" class="margin-input">
                    <label class="color-label">Username *</label>
                    <input type="text" name="fUsername" id="txtProfileUsername" class="margin-input">
                    <label class="color-label">Password *</label>
                    <input type="password" name="fPassword" id="txtProfilePassword" class="margin-input">
                    <label class="color-label">Repeat Password *</label>
                    <input type="password" name="fRepeatPass" id="txtProfileRepeatPassword" class="margin-input">

                    <input type="hidden" autocomplete='off' id="txtProfileIdUser" />
                </div>
                <input type="hidden" name="act" value="1">
                <input type="hidden" name="do" class="grdo" value="create">
                <input type="hidden" name="type" class="grtype" value="user">
                <input type="button" onclick="onClickFormUpdateUserProfile(this)" class="button-submit-form ajx grsub" value="Update Profile">
                <span class="cancel" onclick="onClickCancelProfileUser()">Cancel</span>
            </form>
        </div>
    </section>


    <section id="modalInvite" class="grupo-pop-modal" style="display: none;overflow: auto;">>
        <div>
            <form autocomplete="off" id="formModalInvite" class="sizeModalInviteByPhone">
                <span class="head" id="titleInvite">Invite</span>
                <div class="fields scroller" tabindex="5" style="overflow-y: hidden; outline: none;">
                    <div style="position: relative;">
                        <label>Invite by phone</label>
                    </div>
                    <div style="position: relative;float: right;">
                        <label class="switch">
                            <input id="chkFilterModalInvite" type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <label>Invite by phone</label>


                    <div class="divByPhone">
                        <div style="margin-top: 30px;position: absolute;">
                            <select name="fcomplementPhoneInvite" id="selProfileComplementPhoneInvite">
                                <option value="+1" selected>+1</option>
                                <option value="+86">+86</option>
                                <option value="+87">+87</option>
                                <option value="+91">+91</option>
                                <option value="+55">+55</option>
                                <option value="+52">+52</option>
                            </select>
                        </div>
                        <label class="color-label">Phone Number</label>
                        <input type="text" name="fPhoneNumberInvite" id="txtProfilePhoneNumberInvite" class="margin-input only-numbers phoneNumberLimit" style="margin-left: 60px;width: 178px;">
                    </div>
                    <div class="divByUser">
                        <label style="color: black;" id="totalUsers"></label>
                        <div>
                            <ul id="ulListUsers" class="list-group">

                            </ul>
                        </div>

                    </div>


                </div>
                <button type="button" onclick="onClickInvite(this)" class="button-submit-form  ajx grsub">Invite</button>
                <span class="cancel" onclick="onClickCancelInvite()">Cancel</span>
            </form>
        </div>
    </section>


    <section id="modalViewer" class="grupo-pop-modal" style="display: none;">
        <!-- <div style="position: absolute;margin-top: -64%; content: url(dist/close.png);cursor:pointer;" onclick="onClickCloseModalViewer(this)">
        </div> -->
        <div class="previewPDF">
            <button type="button" onclick="onClickCloseModalViewer(this)" class="closeFrame"></button>
            <div>
                <iframe id="iframeViewer" src="" width='800' height='600' allowfullscreen></iframe>
            </div>
        </div>
        <div id='wrap'>
            <button type="button" onclick="onClickCloseModalViewer(this)" class="closeFrameD"></button>

            <!-- <img src="images/demo.jpg" alt="image">    -->
        </div>
    </section>



</body>

<?php
css("custom");
cdn("npm/jquery@3.3.1/dist/jquery.min.js");
cdn("npm/jquery-migrate@3.0.1/dist/jquery-migrate.min.js");
cdn("npm/popper.js@1.14.7/dist/umd/popper.min.js");
cdn("npm/bootstrap@4.3.1/dist/js/bootstrap.min.js");
cdn("npm/bootstrap-colorpicker@3.1.1/dist/js/bootstrap-colorpicker.min.js");
cdn("npm/bootstrap-colorpicker@3.1.1/dist/css/bootstrap-colorpicker.min.css");
cdn("npm/jquery.nicescroll@3.7.6/jquery.nicescroll.min.js");
cdn("libs/emojionearea/3.4.1/emojionearea.min.js");
cdn("npm/js-video-url-parser@0.3.1/dist/jsVideoUrlParser.min.js");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script src="./dist/jquery.loading.block.js"></script>
<script src="./dist/view-bigimg-master/lib/view-bigimg.js"></script>
<script src="./dist/viewtiff/tiff.min.js"></script>
<script type="text/javascript">
    var idleTime = 0;
    $(document).ready(function() {
        //Increment the idle time counter every minute.
        var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
        console.log(document.cookie.split(";"))
        console.log("init timer")
        //Zero the idle timer on mouse movement.
        $(this).mousemove(function(e) {
            idleTime = 0;
        });
        $(this).keypress(function(e) {
            idleTime = 0;
        });
    });

    function timerIncrement() {
        idleTime = idleTime + 1;
        // console.log("otro")
        // console.log(idleTime)
        if (idleTime > 5) { // 20 minutes
            var cookies = document.cookie.split("; ");
            for (var c = 0; c < cookies.length; c++) {
                var d = window.location.hostname.split(".");
                while (d.length > 0) {
                    var cookieBase = encodeURIComponent(cookies[c].split(";")[0].split("=")[0]) + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; domain=' + d.join('.') + ' ;path=';
                    var p = location.pathname.split('/');
                    document.cookie = cookieBase + '/';
                    while (p.length > 0) {
                        document.cookie = cookieBase + p.join('/');
                        p.pop();
                    };
                    d.shift();
                }
            }
            setTimeout(window.location.reload(), 1000)

        }
    }
</script>

<?php
js("ajx", "caret", "grupo");
gr_core('hf', 'footer');
gr_reactprof();
?>


<!-- 
<script src="./gem/mine/ajx.js"></script>
<script src="./gem/mine/caret.js"></script>

-->
<script src="./gem/mine/grupo.js"></script>

</html>