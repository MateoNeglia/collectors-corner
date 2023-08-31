<?php
$dataForm = $_SESSION['data_form'] ?? [];
?>
<section class="container">
    <h1 class="mb-1">Request Password Reset</h1>
    <p class="mb-1">Submit the form with your email address to receive instructions to reset your password.</p>

    <form action="actions/auth-email-retrieve-password.php" method="post">
        <div class="m-3">            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= $dataForm['email'] ?? null;?>"
            >
        </div>
        <button type="submit" class="btn text-light align-self-center main-dark-bg m-3">Request Reset</button>
    </form>
</section>