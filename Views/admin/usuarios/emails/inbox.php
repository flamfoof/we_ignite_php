<link href="<?= base_url("assets_admin/assets/css/apps/mailbox.css") ?>" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="row">

                <div class="col-xl-12  col-md-12">

                    <div class="mail-box-container">
                        <div class="mail-overlay"></div>

                        <div class="tab-title">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 text-center mail-btn-container">
                                    <a id="btn-compose-mail" class="btn btn-block" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12 mail-categories-container">

                                    <div class="mail-sidebar-scroll">

                                        <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
                                            <?php if ($carpetas == false): ?>
                                                Error de conexión
                                            <?php else: ?>
                                                <?php foreach ($carpetas as $title): ?>
                                                    <div class="p-2 border rounded">
                                                        <li class="nav-item">
                                                            <a class="nav-link list-actions active" id="mailInbox">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
                                                                <span class="nav-names"><?= $title ?></span>
                                                                <span class="mail-badge badge"></span>
                                                            </a>
                                                        </li>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>

                                        <p class="group-section"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg> Groups</p>

                                        <ul class="nav nav-pills d-block group-list" id="pills-tab2" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions active g-dot-primary" id="personal"><span>Personal</span></a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="mailbox-inbox" class="accordion mailbox-inbox">

                            <div class="search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                <input type="text" class="form-control input-search" placeholder="Search Here...">
                            </div>

                            <div class="action-center">
                                <div class="">
                                    <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-primary">
                                          <input type="checkbox" class="new-control-input" id="inboxAll">
                                          <span class="new-control-indicator"></span><span>Check All</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle d-icon label-group" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" data-toggle="tooltip" data-placement="top" data-original-title="Label" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
                                    <div class="dropdown-menu dropdown-menu-right d-icon-menu">
                                        <a class="label-group-item label-personal dropdown-item position-relative g-dot-primary" href="javascript:void(0);"> Personal</a>
                                        <a class="label-group-item label-work dropdown-item position-relative g-dot-warning" href="javascript:void(0);"> Work</a>
                                        <a class="label-group-item label-social dropdown-item position-relative g-dot-success" href="javascript:void(0);"> Social</a>
                                        <a class="label-group-item label-private dropdown-item position-relative g-dot-danger" href="javascript:void(0);"> Private</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" data-toggle="tooltip" data-placement="top" data-original-title="Important" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star action-important"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Spam" class="feather feather-alert-circle action-spam"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" data-toggle="tooltip" data-placement="top" data-original-title="Revive Mail" stroke-linejoin="round" class="feather feather-activity revive-mail"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete Permanently" class="feather feather-trash permanent-delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    <div class="dropdown d-inline-block more-actions">
                                        <a class="nav-link dropdown-toggle" id="more-actions-btns-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="more-actions-btns-dropdown">
                                            <a class="dropdown-item action-mark_as_read" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg> Mark as Read
                                            </a>
                                            <a class="dropdown-item action-mark_as_unRead" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg> Mark as Unread
                                            </a>
                                            <a class="dropdown-item action-delete" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Trash
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="message-box">

                                <div class="message-box-scroll" id="ct">

                                    <div class="mail-item draft">
                                        <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingOne">
                                            <?php if ($cabeceras == false): ?>
                                                Error de conexión
                                            <?php else: ?>
                                                <?php foreach ($cabeceras as $key => $info): ?>
                                                    <a href="<?= base_url("admin/email/$key/read") ?>" class="mb-0">
                                                        <div class="mail-item-heading personal collapsed"  data-toggle="collapse" role="navigation" data-target="#mailCollapseOne" aria-expanded="false">
                                                            <div class="mail-item-inner">

                                                                <div class="d-flex">
                                                                    <div class="n-chk text-center">
                                                                        <label class="new-control new-checkbox checkbox-primary">
                                                                          <input type="checkbox" class="new-control-input inbox-chkbox">
                                                                          <span class="new-control-indicator"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="f-body" data-mailfrom="info@mail.com" data-mailto="kf@mail.com" data-mailcc="">
                                                                        <div class="meta-mail-time">
                                                                            <p class="user-email" data-mailTo="kf@mail.com"><?= $info["from"] ?></p>
                                                                        </div>
                                                                        <div class="meta-title-tag">
                                                                            <?= $info["titulo"] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

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
</div>
<div class="text-white">
    <pre style="color: white;">
        CABECERAS: <br>
        <?=
            var_dump($cabeceras[0]["unfilter"][0])
         ?>
    </pre>
    <pre style="color: white;">
        BODY: <br>
        <?=
            var_dump($bodies)
         ?>
    </pre>
</div>
