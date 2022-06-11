<!-- TAB CAREER -->
<?php
if($tab=='career')
{
    if($tab!="career")
    {
        $action_career="";
    }
    else
    {
        $action_career=$action;
    }   
    if(empty($action_career))
    {
        $status_form = "disabled";
    }
    else
    {
        $status_form = "";
        if($action=='4')
        {
            $update     = mysqli_query($con,"UPDATE contact_mng set email='',update_by='$username',update_date='$now' WHERE id='7' AND code='4'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=career">';
            }
        }
    }
    if(isset($_POST['submit']))
    {
        $email              = $_POST['email'];
        if($action=='3')
        {
            $update     = mysqli_query($con,"UPDATE contact_mng set email='$email',update_by='$username',update_date='$now' WHERE id='7' AND code='4'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=contact_mng&t=career">';
            }
        }
    }
    else
    {
        $query_contact      = mysqli_query($con,"SELECT * from contact_mng WHERE id='7'");
        $data_contact       = mysqli_fetch_array($query_contact);
        $email              = $data_contact['email'];
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
                    <?php
                    if($tab=='career' &&  $action!="" && $sty=="")
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
                            <a href="?p=contact_mng&t=career&a=3&id=7">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=contact_mng&t=career&a=4&id=7" onclick="return confirm('Are you sure want to delete ?')">  
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