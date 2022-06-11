<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title"><font color="rgb(41, 41, 43)">Contact Management</font></h4>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li>
                                    <a href="index.php?p=contact_mng&t=office" <?php if($tab=='' || $tab=='office'){ echo 'class="active show"';} ?>>Head Office</a>
                                </li>
                                <li>
                                    <a href="index.php?p=contact_mng&t=branch" <?php if($tab=='branch'){ echo 'class="active show"';} ?>>Branch Office</a>
                                </li>
                                <li>
                                    <a href="index.php?p=contact_mng&t=marketing" <?php if($tab=='marketing'){ echo 'class="active show"';} ?>>Marketing</a>
                                </li>
                                <li>
                                    <a href="index.php?p=contact_mng&t=partnership" <?php if($tab=='partnership'){ echo 'class="active show"';} ?>>Partnership & Collaboration</a>
                                </li>
                                <li>
                                    <a href="index.php?p=contact_mng&t=career" <?php if($tab=='career'){ echo 'class="active show"';} ?>>Career</a>
                                </li>
                                <li>
                                    <a href="index.php?p=contact_mng&t=socmed" <?php if($tab=='socmed'){ echo 'class="active show"';} ?>>Social Media</a>
                                </li>
                            </ul>
                            <?php
                            if($tab=='')
                            {
                                $tab    = 'office';
                            }
                            include('contact_'.$tab.'.php');
                            ?>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</section>