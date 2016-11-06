<?php
    include 'database/dbconfig.php';	
    if(isset($_POST['finish'])){
        $name = '"'.$dbConnection->real_escape_string($_POST['name']).'"';
        $email = '"'.$dbConnection->real_escape_string($_POST['email']).'"';
        $password = '"'.password_hash($dbConnection->real_escape_string($_POST['password']), PASSWORD_DEFAULT).'"';
        $gender = '"'.$dbConnection->real_escape_string($_POST['gender']).'"';
		
        $sqlInsertUser = $dbConnection->query("INSERT INTO users (name, password, email, gender) VALUES($name, $password, $email, $gender)");
 
        if($sqlInsertUser === false){
        trigger_error('Error: ' . $dbConnection->error, E_USER_ERROR);
        }else{
            echo 'Last inserted record is : ' .$dbConnection->insert_id ; 
        }
    }
?>
<html>
    <head>
        <title>Multi step registration form PHP, JQuery, MySQLi</title>
        <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
<body>
<div class="container">

    <ul id="signup-step">
        <li id="personal" class="active">Personal Detail</li>
        <li id="password">Password</li>
        <li id="general">General</li>
    </ul>
<form name="frmRegistration" id="signup-form" method="post" class="form-control">
    <div id="personal-field">
        <label>Name</label>
        <div><input type="text" name="name" id="name" class="demoInputBox"/>
        <span id="name-error"></span>
        </div>
        <label>Email</label>
        <div><input type="text" name="email" id="email" class="demoInputBox" />
        <span id="email-error"></span>
        </div>
    </div>
        <div id="password-field" style="display:none;">
            <label>Enter Password</label><span id="password-error" class="signup-error"></span>
            <div><input type="password" name="password" id="user-password" class="demoInputBox" /></div>
            <label>Re-enter Password</label><span id="confirm-password-error" class="signup-error"></span>
            <div><input type="password" name="confirm-password" id="confirm-password" class="demoInputBox" /></div>
        </div>
        <div id="general-field" style="display:none;">
            <label>Gender</label>
            <div>
                <select name="gender" id="gender" class="demoInputBox">
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
            </div>
        </div>
    <div>
        <input class="btn btn-primary" type="button" name="back" id="back" value="Back" style="display:none;">
        <input class="btn btn-primary" type="button" name="next" id="next" value="Next" >
        <input class="btn btn-primary" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
    </div>
</form>
    
</div>


    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
function validate() {
    $("#name-error").hide;
    var output = true;
    $(".signup-error").html('');
    if($("#personal-field").css('display') != 'none') {
        if(!($("#name").val())) {
            output = false;
            $("#name-error").addClass("alert alert-danger");
            $("#name-error").html("Name required!");
        }
        if(!($("#email").val())) {
            output = false;
            $("#email-error").addClass("alert alert-danger");
            $("#email-error").html("Email required!");

        }
        if(!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            $("#email-error").html("Invalid Email!");
            output = false;
        }
    }
 
    if($("#password-field").css('display') != 'none') {
        if(!($("#user-password").val())) {
            output = false;
            $("#password-error").html("Password required!");
        }   
        if(!($("#confirm-password").val())) {
            output = false;
            $("#confirm-password-error").html("Confirm password required!");
        }   
        if($("#user-password").val() != $("#confirm-password").val()) {
            output = false;
            $("#confirm-password-error").html("Password not matched!");
        }   
    }
    return output;
}
 
$(document).ready(function() {
    $("#next").click(function(){
        var output = validate();
        if(output) {
            var current = $(".active");
            var next = $(".active").next("li");
                if(next.length>0) {
                    $("#"+current.attr("id")+"-field").hide();
                    $("#"+next.attr("id")+"-field").show();
                    $("#back").show();
                    $("#finish").hide();
                    $(".active").removeClass("active");
                    next.addClass("active");
                    if($(".active").attr("id") == $("li").last().attr("id")) {
                        $("#next").hide();
                        $("#finish").show();                
                    }
                }
            }
        });
    $("#back").click(function(){ 
        var current = $(".active");
        var prev = $(".active").prev("li");
        if(prev.length>0) {
            $("#"+current.attr("id")+"-field").hide();
            $("#"+prev.attr("id")+"-field").show();
            $("#next").show();
            $("#finish").hide();
            $(".active").removeClass("active");
            prev.addClass("active");
            if($(".active").attr("id") == $("li").first().attr("id")) {
                $("#back").hide();          
            }
        }
    });
});
</script>
</body>
</html>