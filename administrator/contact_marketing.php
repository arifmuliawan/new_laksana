<!-- TAB MARKETING -->
<?php
if($tab=='marketing')
{
    if($tab!="marketing")
    {
        $action_marketing="";
    }
    else
    {
        $action_marketing=$action;
    }
    if(isset($_POST['submit']))
    {
        $email              = $_POST['email'];
        $phone              = $_POST['phone'];
        if($action=='3')
        {
            $update     = mysqli_query($con,"UPDATE contact_mng set email='$email',phone='$phone',update_by='$username',update_date='$now' WHERE id='$id' AND code='2'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=marketing">';
            }
        }
    }
    if($action=='4')
    {
        $update     = mysqli_query($con,"UPDATE contact_mng set address='',email='',phone='',office_hours='',update_by='$username',update_date='$now' WHERE id='$id' AND code='2'");
        if($update==1)
        {
            echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=marketing">';
        }
    }
    ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <h5> Indonesia Marketing </h5>
            <?php
            if($id!='4')
            {
                $status_form_ind = "disabled";
            }
            else
            {
                $status_form_ind = "";
                
            }
            $query_contact      = mysqli_query($con,"SELECT * from contact_mng WHERE id='4'");
            $data_contact       = mysqli_fetch_array($query_contact);
            $email              = $data_contact['email'];
            $phone              = $data_contact['phone'];
            ?>
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Email</b></label><br>
                        <input name="email" type="text" value="<?php echo $email ?>" <?php echo $status_form_ind ?>/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Phone</b></label><br>
                        <input name="phone" type="text" value="<?php echo $phone ?>" <?php echo $status_form_ind ?>/>
                    </div>
                    <?php
                    if($tab=='marketing' &&  $action!="" && $id=="4")
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
                            <a href="?p=contact_mng&t=marketing&a=3&id=4">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=contact_mng&t=marketing&a=4&id=4" onclick="return confirm('Are you sure want to delete ?')">  
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
            <h5> International Marketing </h5>
            <?php
            if($id!='5')
            {
                $status_form_int = "disabled";
            }
            else
            {
                $status_form_int = "";
                
            }
            $query_contact      = mysqli_query($con,"SELECT * from contact_mng WHERE id='5'");
            $data_contact       = mysqli_fetch_array($query_contact);
            $email              = $data_contact['email'];
            $phone              = $data_contact['phone'];
            ?>
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Email</b></label><br>
                        <input name="email" type="text" value="<?php echo $email ?>" <?php echo $status_form_int ?>/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Phone</b></label><br>
                        <input name="phone" type="text" value="<?php echo $phone ?>" <?php echo $status_form_int ?>/>
                    </div>
                    <?php
                    if($tab=='marketing' &&  $action!="" && $id=="5")
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
                            <a href="?p=contact_mng&t=marketing&a=3&id=5">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=contact_mng&t=marketing&a=4&id=5" onclick="return confirm('Are you sure want to delete ?')">  
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