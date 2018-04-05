
<style>

/*
.main-nav {
    margin-bottom: 0;
} */

.user-los { 
    padding: 100px 0;
    background-color: #f9f9f9;
}

.user-los .form-control {
    height: 42px;
    font-size: 16px;
    box-shadow: inset 0px 0px 15px 3px #eee;
    border-radius: 10px 0px 10px 0px;
    border: solid 1px #ccc;
}

.user-los input[type='checkbox'] {
    position: relative;
    top: 4px;
    height: 20px;
    width: 25px;
    line-height: 29px;    
}

.user-los .panel-body {
    padding: 40px 30px 35px;
    background: #fff;                 
}

.user-los .panel-heading {
    background: #6091ba;
    color: #fff;
    padding: 16px;
}

.user-los h3.panel-title {
    text-align: center;
    font-weight: 600 !important;
}

.user-los .form-group {
    margin-bottom: 20px;
}

.user-los .panel-default {
    border-color: #6091ba;
    border-radius: 25px 0px 25px 0px;
    overflow: hidden;
}

.user-los .checkbox label { 
    font-size: 15px;
    font-weight: 600;
}

</style>


<div class="user-los">

    <div class="container">
    <div class="row">
		<div class="col-md-5 col-md-offset-3"> 
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">STUDENT LOGIN</h3> 
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" method="post" action="">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="E-mail" name="email" type="text" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    	    <div class="clearfix"></div>
			    	    <br>
			    		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>	

</div>