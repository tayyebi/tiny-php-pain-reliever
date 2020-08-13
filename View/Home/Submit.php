<link rel="stylesheet" href="<?php echo _Root ?>static/css/submit.css">

<!-- <form class="submit-form submit-text">
   <h1>ارسال پست</h1>
   
   <label>* نام و نام خانوادگی :</label>
   <input type="text" name="" value="" placeholder="نام و نام خانوادگی" >
   
   <label>* ایمیل :</label>
   <input type="email" name="" value="" placeholder="ایمیل" >
   
   <label>وب سایت :</label>
   <input type="site" name="" value="" placeholder="وب سایت" >
   
   <label>* متن یا لینک :</label>
   <textarea rows="10"></textarea>
   
   <a href="#" class="border-radius background-gold color-dark button-medium" >ارسال</a>
   
   </form> -->


<form
   class="submit-form"
   method="post">

   <div class="form-group"><label for="Title">عنوان</label><input class="form-control" type="text" name="Title" value="" ></div>
   <div class="form-group"><label for="Abstract">خلاصه</label><textarea class="form-control html-editor" type="text" name="Abstract" ></textarea></div>
   <div class="form-group"><label for="Canonical">لینک</label><input class="form-control" type="text" name="Canonical" value="" ></div>
   <div class="form-group"><label for="Publisher">نشر دهنده</label><input class="form-control" type="text" name="Publisher" value="" ></div>

   <input name="insert" type="submit" value="ارسال" class="background-gold">
</form>

<?php
if (isset($Data['Message']) )
{
?>
<div id="snackbar" class="show"><?php echo $Data['Message'] ?></div>
<script>
// Get the snackbar DIV
var x = document.getElementById("snackbar");

// Add the "show" class to DIV
// x.className = "show";

// After 3 seconds, remove the show class from DIV
setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
</script>
<?php
}
?>