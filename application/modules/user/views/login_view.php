<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Valley Billing System</title>
   <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="<?=base_url()?>assets/css/login_view.css" rel="stylesheet" type="text/css">
       
       
   <script src="<?=base_url()?>assets/js/jquery.min.js"></script>    
   <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>    
 </head>
 <body>
   <section id="login">
    <div class="container">
    	<div class="row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap">
                    <h1>We need to know who you are...</h1>
   
                    <?php echo form_open('user/verifylogin'); ?>
                      <div class="form-group">
                            <label for="username" class="sr-only">Username:</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <?php if(validation_errors() != false) { ?> 
                            <div class="alert alert-danger"> 
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>    
                      <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                    
                    <hr>
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
    </section>
    
    <footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>&copy; Valley Institute  <?php echo date("Y") ?></p>
                
            </div>
        </div>
    </div> 
 </body>
</html>