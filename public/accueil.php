<?php 
/**
 * @author Omid Amini bcs.omid@gmail.com 
 * */
$success_message = $error_message = null;
if(isset($_POST["editdatabase"]))
{
    unlink(CONFIG_DIR."db.php");
    header("location:".URL_BASE."public/?page=dbinfo");
    exit();
}
if(isset($_POST["submit"]))
{
   if(isset($_POST['submit']))
   {
       if($_POST['selectmode'] == "table")
       {
            header("location:".URL_BASE."public/?page=table");
            exit();
       }
       else
       {
            header("location:".URL_BASE."public/?page=db");
            exit();
       }
       
   } 
}
?>
<body>
    <div class="container align-items-center  vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-sm-4 rounded  border">
                <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="row align-items-center h-100">
                        <div class="col-12 p-5">
                            <?php echo $appname; ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectmode" id="selectmode" value="db">
                                <label class="form-check-label" for="selectmode">
                                    Base de données
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectmode" id="selectmode2" value="table" checked>
                                <label class="form-check-label" for="selectmode2">
                                    Table
                                </label>
                            </div>
                            <p>
                                <button type="submit" name="submit" class="btn btn-success mt-3">Valider</button>
                            
                            </p>
                            <small >msg: <span class="text-success"> <?php echo ($success_message); ?></span><span class="text-danger"><?php echo ($error_message); ?></span></small>
                        </div>
                        <div class="col-12 align-self-en">
                            <p class="align-bottom text-end">
                            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                <button type="submit" name="editdatabase" class="btn btn-sm btn-warning">modifier la bdd <i class="bi bi-pencil"></i></button>
                            </form>
                            </p>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>