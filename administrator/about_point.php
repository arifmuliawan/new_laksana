<!-- TAB ABOUT point -->
<style>
   .box
   {
    width:100%;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
   #page_list li
   {
    padding:16px;
    background-color:#f9f9f9;
    border:1px dotted #ccc;
    margin-top:12px;
   }
   #page_list li.ui-state-highlight
   {
    padding:24px;
    background-color:#ffffcc;
    border:1px dotted #ccc;
    cursor:move;
    margin-top:12px;
   }
</style>
<?php
if($tab=='point')
{
    if($tab!="point")
    {
        $action_point="";
    }
    else
    {
        $action_point=$action;
    }
    if($action_point=='')
    {
?>    
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <?php
                if($username=='developer')
                {
                    if (in_array("2", $access_admin))
                    {
                ?>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group m-l-15">
                                    <a href="?p=about_mng&t=point&a=2">
                                        <button id="addRow" class="btn btn-info">
                                            Add New
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }    
                ?>    
                <div class="box">
                    <ul class="list-unstyled" id="page_list">
                <?php 
                        $query_point  = mysqli_query($con,"SELECT * from about_mng WHERE visible!='D' AND code='3' order by id ASC");
                        while($data_point=mysqli_fetch_array($query_point))
                        {
                            $id_point        = $data_point['id'];
                            $exp_point       = explode('|',$data_point['title']);   
                            $title_point     = $exp_point[0];
                            $highlight_point = $exp_point[1];
                            $desc_point      = stripslashes($data_point['description']);
                ?>    
                            <li>
                                <h3><?php echo $title_point ?></h3><br><br>
                                <?php echo $highlight_point ?><br><br>
                <?php
                                if (in_array("3", $access_admin))
                                {
                ?>    
                                    <a href="?p=about_mng&t=point&a=1&id=<?php echo $id_point ?>">
                                        <button type="button" class="btn btn-success">
                                            <i class='fas fa-search'></i>
                                        </button>
                                    </a>
                <?php
                                }
                ?>
                            </li>
                <?php   
                        }
                ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    if(isset($action_point))
    {
        $query_dpoint       = mysqli_query($con,"SELECT * from about_mng WHERE id='$id' AND code='3'");
        $data_dpoint        = mysqli_fetch_array($query_dpoint);
        $exp_dpoint         = explode('|',$data_dpoint['title']);   
        $title_dpoint       = $exp_dpoint[0];
        $highlight_dpoint   = $exp_dpoint[1];
        $desc_dpoint        = $data_dpoint['description'];
        $url_dpoint         = $data_dpoint['url'];
        if($action_point=='1')
        {
            $status_form = "disabled";
        }
        else
        {
            $status_form = "";
            if($action_point=='4')
            {   
                $imp_dpoint         = $title_dpoint.'|';
                $update             = mysqli_query($con,"UPDATE about_mng set title='$imp_dpoint',description='',update_by='$username',update_date='$now' WHERE id='$id' AND code='3'");
                if($update==1)
                {
                    echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=point">';
                }
            }
        }
        if(isset($_POST['submit']))
        {
            $highlight_point    = $_POST['highlight'];
            $desc_point         = $_POST['desc'];
            $imp_point          = $title_dpoint.'|'.$highlight_point;
            if($link=="")
            {
                if($_FILES['banner']['name']!='')
                {
                    $ekstensi_diperbolehkan = array('mp4','mov','png','jpg','jpeg');
                    $nama_banner            = $_FILES['banner']['name'];
                    $x_banner               = explode('.', $nama_banner);
                    $ekstensi_banner        = strtolower(end($x_banner));
                    $ukuran_banner          = $_FILES['banner']['size'];
                    $file_tmp_banner        = $_FILES['banner']['tmp_name'];
                    $file_directory_banner  = "../assets/about us/".$nama_banner;
                    $file_db_banner         = "assets/about us/".$nama_banner;
                    if(in_array($ekstensi_banner, $ekstensi_diperbolehkan) === true)
                    {
                        if($ukuran_banner < 104857600)
                        {          
                            move_uploaded_file($file_tmp_banner, $file_directory_banner);
                            $name_banner    = $file_db_banner;
                        }
                        else
                        {
                            $error          = 1;
                            $msg_banner     = "UKURAN FILE TERLALU BESAR";
                        }
                    }    
                    else
                    {
                        $error              = 1;
                        $msg_banner         = "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
                    }    
                }
                else
                {
                    $name_banner            = "";
                }
                $url_point = $name_banner;
            } 
            else
            {
                $url_point = $link_individual;
            }
            if($action_point=='3')
            {
                $update     = mysqli_query($con,"UPDATE about_mng set title='$imp_point',description='$desc_point',url='$url_point',update_by='$username',update_date='$now' WHERE id='$id' AND code='3'");
                if($update==1)
                {
                    echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=point">';
                }
            }
        }
?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2><strong><?php echo $title_dpoint ?></strong></h2>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body">
                        <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label"><b>Highlight</b></label>
                                <input name="highlight" type="text" value="<?php echo $highlight_dpoint ?>" <?php echo $status_form ?>/>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label"><b>Description</b></label>
                                <textarea <?php if($status_form==""){ echo 'class="ckeditor" id="ckedtor"'; } ?> name="desc" style="margin-top: 0px; margin-bottom: 0px; height: 200px;" <?php echo $status_form ?>><?php echo $desc_dpoint ?></textarea>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label"><b>Image / Video</b></label><br>
                                <?php
                                if($url_dpoint!="")
                                {
                                    if(strpos($url_dpoint, "youtube") !== false)
                                    {
                                        echo "1";
                                ?>        
                                        <iframe width="500" height="300" src="<?php echo $url_dpoint ?>"></iframe>
                                <?php
                                    }
                                    else
                                    {
                                        $y_point               = explode('.', $url_dpoint);
                                        $cariekstensi_point    = strtolower(end($y_point));
                                        if($url_dpoint!="" && ($cariekstensi_point=="mp4" || $cariekstensi_point=="mov"))
                                        {
                                ?>    
                                            <video width="500" height="300" controls>
                                                <source src="<?php echo $base_url.''.$url_dpoint ?>" type="video/mp4">
                                            </video> 
                                <?php
                                        }
                                        if($url_dpoint!="" && ($cariekstensi_point=="jpeg" || $cariekstensi_point=="jpg" || $cariekstensi_point=="png"))
                                        {
                                ?>    
                                            <img src="<?php echo $base_url.''.$url_dpoint ?>" width="25%"> 
                                <?php
                                        }
                                    } 
                                }   
                                ?>
                                <!--<p style="font-size: 10px;font-style: italic;"> Image logo size: 110x110px </p>-->
                                <?php
                                if($tab=='point' &&  $action>"1")
                                {
                                ?>
                                    <br>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation">
                                            <a href="#upload" data-toggle="tab" class="active show">Upload Image / Video</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#link" data-toggle="tab">Link Youtube</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active show" id="upload">
                                            <input name="banner" type="file" multiple <?php echo $status_form ?>>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="link">
                                            <label class="form-label"><b>URL Youtube</b></label><br>
                                            <input name="link" type="text" value="<?php echo $link_point ?>" <?php echo $status_form ?>/>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            if($tab=='point' &&  $action>'1')
                            {
                            ?>    
                                <button class="btn btn-primary waves-effect" type="submit" name="submit" value="submit">SUBMIT</button>
                            <?php
                            }
                            else
                            {    
                            ?>
                                <a href="?p=about_mng&t=point">
                                    <button type="button" class="btn btn-success">
                                        <i class='fas fa-arrow-left'></i>
                                    </button>
                                </a>
                            <?php
                                if (in_array("3", $access_admin))
                                {
                            ?>    
                                    <a href="?p=about_mng&t=point&a=3&id=<?php echo $id ?>">
                                        <button type="button" class="btn btn-warning">
                                            <i class='fas fa-pen'></i>
                                        </button>
                                    </a>
                            <?php
                                }
                                if (in_array("4", $access_admin))
                                {
                            ?>        
                                    <a href="?p=about_mng&t=point&a=4&id=<?php echo $id ?>" onclick="return confirm('Are you sure want to delete ?')">  
                                        <button type="button" class="btn btn-danger">
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </a>
                            <?php
                                }
                            }
                            ?>    
                        </form>
                        <br><br>
                        <?php include ('poin_gallery.php'); ?>
                    </div>
                </div>
            </div>        
        </div>
        
<?php
    }
}
?>         