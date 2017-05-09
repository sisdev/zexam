



<h1><center>Assesement App - Question Paper Upload </center></h1>
<div class="container" style="margin-top:50px">
<div class="row">
<div class="col-sm-10">
 <form action='qp_upload.php' method='post' id='upload' enctype='multipart/form-data'  class="form-horizontal">



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="coursename">Course name</label>  
  <div class="col-md-4">
  <input id="coursename" name="coursename" placeholder="Android/iphone" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="user_name">Uploaded By Person/Agency</label>  
  <div class="col-md-4">
  <input id="user_name" name="user_name" placeholder="Faculty/Company/admin" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="userfile">Upload Question Papers</label>
  <div class="col-md-4">
    <input id="userfile" name="userfile" class="input-file" type="file">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="upload"></label>
  <div class="col-md-4">
    <button id="upload" name="upload" class="btn btn-primary">Upload</button>
  </div>
</div>

</fieldset>

</form>
</div>
</div>
</div>
