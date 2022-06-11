<!-- TAB HEAD OFFICE -->
<?php
if($tab=='' || $tab=='office')
{
    if($tab!="office")
    {
        $action_office="";
    }
    else
    {
        $action_office=$action;
    }   
    if(empty($action_office))
    {
        $status_form = "disabled";
    }
    else
    {
        $status_form = "";
        if($action=='4')
        {
            $update     = mysqli_query($con,"UPDATE contact_mng set address='',email='',phone='',office_hours='',logo='',maps='',update_by='$username',update_date='$now' WHERE id='1' AND code='1'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=office">';
            }
        }
    }
    if(isset($_POST['submit']))
    {
        $address            = $_POST['address'];
        $email              = $_POST['email'];
        $phone              = $_POST['phone'];
        $office_hours       = $_POST['office_hours'];
        $maps               = $_POST['maps'];
        if($_FILES['logo']['name']!='')
        {
            $ekstensi_diperbolehkan = array('png','jpg','jpeg');
            $nama_logo              = $_FILES['logo']['name'];
            $x_logo                 = explode('.', $nama_logo);
            $ekstensi_logo          = strtolower(end($x_logo));
            $ukuran_logo            = $_FILES['logo']['size'];
            $file_tmp_logo          = $_FILES['logo']['tmp_name'];
            $file_directory_logo    = "../assets/header, footer _ menu/".$nama_logo;
            $file_db_logo           = "assets/header, footer _ menu/".$nama_logo;
            if(in_array($ekstensi_logo, $ekstensi_diperbolehkan) === true)
            {
                if($ukuran_logo < 104857600)
                {          
                    move_uploaded_file($file_tmp_logo, $file_directory_logo);
                    $name_logo      = $file_db_logo;
                }
                else
                {
                    $error          = 1;
                    $msg_logo       = "UKURAN FILE TERLALU BESAR";
                }
            }    
            else
            {
                $error              = 1;
                $msg_logo           = "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
            }    
        }
        else
        {
            $name_logo              = "";
        }
        if($action=='3')
        {
            $update     = mysqli_query($con,"UPDATE contact_mng set address='$address',email='$email',phone='$phone',office_hours='$office_hours',logo='$name_logo',maps='$maps',update_by='$username',update_date='$now' WHERE id='1' AND code='1'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=office">';
            }
        }
    }
    else
    {
        $query_contact      = mysqli_query($con,"SELECT * from contact_mng WHERE id='1'");
        $data_contact       = mysqli_fetch_array($query_contact);
        $address            = $data_contact['address'];
        $email              = $data_contact['email'];
        $phone              = $data_contact['phone'];
        $office_hours       = $data_contact['office_hours'];
        $logo               = $data_contact['logo'];
        $maps               = $data_contact['maps'];
    }
    ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Address</b></label>
                        <textarea name="address" style="margin-top: 0px; margin-bottom: 0px; height: 70px;" <?php echo $status_form ?>><?php echo $address ?></textarea>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Email</b></label><br>
                        <input name="email" type="text" value="<?php echo $email ?>" <?php echo $status_form ?>/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Phone</b></label><br>
                        <input name="phone" type="text" value="<?php echo $phone ?>" <?php echo $status_form ?>/>
                    </div>
                    <?php
                    if($username=='developer')
                    {
                    ?>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Office Hours</b></label><br>
                        <input name="office_hours" type="text" value="<?php echo $office_hours ?>" <?php echo $status_form ?>/>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Logo</b></label><br>
                        <?php
                        if($logo!="")
                        {
                        ?>    
                            <img src="<?php echo $base_url.''.$logo ?>" width="25%" style="background: rgb(41, 41, 43);"> 
                        <?php
                        }
                        ?>
                        <br><br>
                        <input name="logo" type="file" multiple <?php echo $status_form ?>>
                    </div>
                    <?php
                    if($username=='developer')
                    {
                    ?>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Google Maps Link</b></label><br>
                        <input name="maps" type="text" value="<?php echo $maps ?>" <?php echo $status_form ?>/><br><br>
                        <?php
                        if($maps!="")
                        {
                        ?>        
                            <iframe width="100%" height="500" id="gmap_canvas"
                            src="<?php echo $maps ?>"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    }
                    if($tab=='office' &&  $action!="" && $sty=="")
                    {
                    ?>    
                        <button class="btn btn-primary waves-effect" type="submit" name="submit" value="submit">SUBMIT</button>
                    <?php
                    }
                    else
                    {    
                        if (in_array("3", $access_admin))
                        {
                    ?>    
                            <a href="?p=contact_mng&t=office&a=3&id=1">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=contact_mng&t=office&a=4&id=1" onclick="return confirm('Are you sure want to delete ?')">  
                                <button type="button" class="btn btn-danger">
                                    <i class='fas fa-trash'></i>
                                </button>
                            </a>
                    <?php
                        }
                    }
                    ?>    
                </form>
            </div>
        </div>
    </div>
<?php
}
?>