<?php
$formData = $_SESSION['data_form'] ?? [];
unset($_SESSION['data_form']);

?>
<section class="container">

    <h2 class="mb-1">Register your new account now!</h2>

    <p class="mb-1">Fill this registration form to create a new account.</p>

    <form action="actions/register-account.php" method="post" class="mb-2">
    <input type="hidden" id="user_role" name="user_role" value="3">
        <div class="m-3">
            <label for="nick_name">Nick Name</label>
            <input type="text" 
                    id="nick_name" 
                    name="nick_name" 
                    class="form-control">
        </div>
        <div class="m-3">
            <label for="name">First Name</label>
            <input type="text" 
                    id="name" 
                    name="name" 
                    class="form-control">
        </div>
        <div class="m-3">
            <label for="last_name">Last Name</label>
            <input type="text" 
                    id="last_name" 
                    name="last_name" 
                    class="form-control">
        </div>
        <div class="m-3">
            <label for="email">Email</label>
            <input type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    value="<?= $formData['email'] ?? null;?>">
        </div>
        <div class="m-3">
            <label for="password">Choose your password</label>
            <input type="password" 
                    id="password" 
                    name="password" 
                    class="form-control">
        </div>
        <div class="m-3">
            <label for="password-confirmation">Enter your password again</label>
            <input type="password" 
                    id="password-confirmation" 
                    name="password-confirmation" 
                    class="form-control">
        </div>
        <button type="submit" 
                class="btn text-light align-self-center main-dark-bg m-3">Register</button>
    </form>
    <p>Did you forgot your password? <a href="index.php?s=password-recovery">Request to retrive your password</a>.</p>
</section>
