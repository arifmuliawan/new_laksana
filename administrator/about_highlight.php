<!-- TAB HIGHLIGHT -->
<?php
if($tab=='' || $tab=='highlight')
{
    if($tab!="highlight")
    {
        $action_highlight="";
    }
    else
    {
        $action_highlight=$action;
    }   
    if(empty($action_highlight))
    {
        $status_form = "disabled";
    }
    else
    {
        $status_form = "";
        if($action_highlight=='4')
        {
            $update     = mysqli_query($con,"UPDATE about_mng set title='',description='',update_by='$username',update_date='$now' WHERE id='1'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('deleted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=highlight">';
            }
        }
    }
    if(isset($_POST['submit']))
    {
        $highlight1         = $_POST['highlight1'];
        $desc_highlight     = $_POST['desc'];
        $highlight2         = $_POST['highlight2'];
        $title_highlight    = $highlight1.'|'.$highlight2;
        if($action_highlight=='3')
        {
            $update     = mysqli_query($con,"UPDATE about_mng set title='$title_highlight',description='$desc_highlight',update_by='$username',update_date='$now' WHERE id='1'");
            if($update==1)
            {
                echo "<script type='text/javascript'> alert('submitted successfully!');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=about_mng&t=highlight">';
            }
        }
    }
    else
    {
        $query_highlight    = mysqli_query($con,"SELECT * from about_mng WHERE id='1' LIMIT 1");
        $data_highlight     = mysqli_fetch_array($query_highlight);
        $title_highlight    = explode('|',$data_highlight['title']);
        $highlight1         = $title_highlight[1];
        $highlight2         = $title_highlight[2];
        $desc_highlight     = $data_highlight['description'];
                        
    }
    ?>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form id="form_validation" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <label class="form-label"><b>Highlight 1</b></label>
                        <input name="highlight1" type="text" value="<?php echo $highlight1 ?>" <?php echo $status_form ?>/>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Description</b></label>
                        <textarea <?php if($status_form==""){ echo 'class="ckeditor" id="ckedtor"'; } ?> name="desc" style="margin-top: 0px; margin-bottom: 0px; height: 200px;" <?php echo $status_form ?>><?php echo $desc_highlight ?></textarea>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label"><b>Highlight 2</b></label>
                        <input name="highlight2" type="text" value="<?php echo $highlight2 ?>" <?php echo $status_form ?>/>
                    </div>
                    <?php
                    if($tab=='highlight' &&  $action!="")
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
                            <a href="?p=about_mng&t=highlight&a=3&id=1">
                                <button type="button" class="btn btn-warning">
                                    <i class='fas fa-pen'></i>
                                </button>
                            </a>
                    <?php
                        }
                        if (in_array("4", $access_admin))
                        {
                    ?>        
                            <a href="?p=about_mng&t=highlight&a=4&id=1" onclick="return confirm('Are you sure want to delete ?')">  
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