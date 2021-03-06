<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title"><font color="rgb(41, 41, 43)">Home Management</font></h4>
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
                                    <a href="index.php?p=home_mng&t=highlight" <?php if($tab=='' || $tab=='highlight'){ echo 'class="active show"';} ?>>Highlight</a>
                                </li>
                                <li>
                                    <a href="index.php?p=home_mng&t=banner" <?php if($tab=='banner'){ echo 'class="active show"';} ?>>Banner</a>
                                </li>
                                <li>
                                    <a href="index.php?p=home_mng&t=tagging" <?php if($tab=='tagging'){ echo 'class="active show"';} ?>>Tagging</a>
                                </li>
                                <li>
                                    <a href="index.php?p=home_mng&t=individual" <?php if($tab=='individual'){ echo 'class="active show"';} ?>>Individual Series</a>
                                </li>
                            </ul>
                            <?php
                            if($tab=='')
                            {
                                $tab    = 'highlight';
                            }
                            include('home_'.$tab.'.php');
                            ?>      
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</section>