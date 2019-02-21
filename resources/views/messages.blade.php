<script>
setTimeout(function() {
    $('#div').fadeOut('fast');
}, 5000);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php
if(count($errors)>0){
    foreach($errors->all() as $error){
        ?>
    <div class="alert-danger" id="div">
          {{$error}}
        </div>
<?php        
    }
}
if(session('success')){
    ?>
    <div class="alert-success" id="div">
        {{session('success')}}
        </div>
<?php
}
if(session('error')){
    ?>
    <div class="alert-danger" id="div">
         {{session('error')}}
        </div>
<?php } ?>
