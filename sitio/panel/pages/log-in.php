<?php
$formData = $_SESSION['data_form'] ?? [];
unset($_SESSION['data_form']);

?>
<section class="container">

    <h2 class="mb-1">Log in to your account:</h2>   

    <form action="actions/auth-log-in.php" method="post" class="mb-2">
        <div class="m-3">
            <label for="email">Email</label>
            <input type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    value="<?= $formData['email'] ?? null;?>">
        </div>
        <div class="m-3">
            <label for="password">Password</label>
            <input type="password" 
                    id="password" 
                    name="password" 
                    class="form-control">
        </div>
        <button type="submit" 
                class="btn text-light align-self-center main-dark-bg m-3">Log In</button>
    </form>
    <p>Did you forgot your password? <a href="index.php?s=retrieve-password">Request to retrive your password</a>.</p>
</section>
