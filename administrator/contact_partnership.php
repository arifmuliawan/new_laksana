<!-- TAB PARTNERSHIP & COLLABORATION -->
<?php
if($tab=='partnership')
{
    if($tab!="partnership")
    {
        $action_partnership="";
    }
    else
    {
        $action_partnership=$action;
    }   
    if(empty($action_partnership))
    {
        $status_form = "disabled";
    }
    else
    {
        $status_form = "";
        if($action=='4')
        {
            $update     = mysqli_query($con,"UPDATE contact_mng set email='',phone='',update_by='$username',update_date='$now' WHERE id='6' AND code='3'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=partnership">';
            }
        }
    }
    if(isset($_POST['submit']))
    {
        $email              = $_POST['email'];
        $phone              = $_POST['phone'];
        if($action=='3')
        {
            $update     = mysqli_query($con,"UPDATE contact_mng set email='$email',phone='$phone',update_by='$username',update_date='$now' WHERE id='6' AND code='3'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=partnership">';
            }
        }
    }
    else
    {
        $query_contact      = mysqli_query($con,"SELECT * from contact_mng WHERE id='6'");
        $data_contact       = mysqli_fetch_array($query_contact);
        $email              = $data_contact['email'];
        $phone              = $data_contact['phone'];
    }
    ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Email</b></label><br>
                        <input name="email" type="text" value="<?php echo $email ?>" <?php echo $status_form ?>/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Phone</b></label><br>
                        <input name="phone" type="text" value="<?php echo $phone ?>" <?php echo $status_form ?>/>
                    </div>
                    <?php
                    if($tab=='partnership' &&  $action!="" && $sty=="")
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
                            <a href="?p=contact_mng&t=partnership&a=3&id=6">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=contact_mng&t=partnership&a=4&id=6" onclick="return confirm('Are you sure want to delete ?')">  
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